<?php
// Ensure no output before JSON
ob_start();

include('../../app/config.php');

// Set proper JSON header
header('Content-Type: application/json');

// Verificar que el método sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

try {
    // Verificar que el ID del trabajador esté presente y no esté vacío
    if (!isset($_POST['id_trabajador']) || empty($_POST['id_trabajador'])) {
        throw new Exception("ID de trabajador no válido");
    }

    // Obtener el ID del trabajador
    $id_trabajador = intval($_POST['id_trabajador']);

    // Consulta detallada para obtener información del trabajador con joins (corregida)
    // Reemplaza la consulta SQL con la versión que funciona
    $sql_trabajador = "SELECT t.*, c.nombre_cen AS centro_nombre, e.nombre_emp AS empresa_nombre, e.id_empresa, cat.nombre_cat AS categoria_nombre 
FROM trabajadores t 
LEFT JOIN centros c ON t.centro_tr = c.id_centro 
LEFT JOIN empresa e ON c.empresa_cen = e.id_empresa 
LEFT JOIN categorias cat ON t.categoria_tr = cat.id_categoria 
WHERE t.id_trabajador = :id";

    $stmt = $pdo->prepare($sql_trabajador);
    $stmt->execute([':id' => $id_trabajador]);
    $trabajador = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$trabajador) {
        throw new Exception("Trabajador no encontrado");
    }

    // Obtener TODOS los centros de la empresa del trabajador (corregido)
    // Obtener TODOS los centros de la empresa del trabajador
    $id_empresa = $trabajador['id_empresa'];

    $sql_centros = "SELECT id_centro, nombre_cen 
                FROM centros 
                WHERE empresa_cen = :id_empresa
                ORDER BY nombre_cen";
    $stmt_centros = $pdo->prepare($sql_centros);
    $stmt_centros->execute([':id_empresa' => $id_empresa]);
    $centros = $stmt_centros->fetchAll(PDO::FETCH_ASSOC);

    // Obtener empresas
    $sql_empresas = "SELECT id_empresa, nombre_emp FROM empresa ORDER BY nombre_emp";
    $stmt_empresas = $pdo->query($sql_empresas);
    $empresas = $stmt_empresas->fetchAll(PDO::FETCH_ASSOC);

    // Obtener categorías
    $sql_categorias = "SELECT id_categoria, nombre_cat FROM categorias ORDER BY nombre_cat";
    $stmt_categorias = $pdo->query($sql_categorias);
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

    // Obtener todas las formaciones disponibles
    $sql_formaciones_all = "SELECT id_tipoformacion, nombre_tf FROM tipoformacion ORDER BY nombre_tf";
    $stmt_formaciones_all = $pdo->query($sql_formaciones_all);
    $formaciones_all = $stmt_formaciones_all->fetchAll(PDO::FETCH_ASSOC);

    // Obtener formaciones del trabajador
    $sql_formaciones = "SELECT 
    f.id_tipoformacion, 
    tf.nombre_tf,
    f.estado,
    f.fecha_asignacion,
    f.fecha_completado
FROM formacion_trabajador f
JOIN tipoformacion tf ON f.id_tipoformacion = tf.id_tipoformacion
WHERE f.id_trabajador = :id";
    $stmt_formaciones = $pdo->prepare($sql_formaciones);
    $stmt_formaciones->execute([':id' => $id_trabajador]);
    $formaciones_trabajador = $stmt_formaciones->fetchAll(PDO::FETCH_ASSOC);

    // Obtener toda la información PRL disponible
    $sql_info_prl_all = "SELECT id_infodoc, nombre_ifd FROM info_documentos ORDER BY nombre_ifd";
    $stmt_info_prl_all = $pdo->query($sql_info_prl_all);
    $info_prl_all = $stmt_info_prl_all->fetchAll(PDO::FETCH_ASSOC);

    // Obtener información PRL del trabajador
    $sql_info_prl = "SELECT 
    it.id_infodoc, 
    ifd.nombre_ifd,
    it.estado,
    it.fecha_completado  -- Agregar este campo
    FROM informacion_trabajador it 
    JOIN info_documentos ifd ON it.id_infodoc = ifd.id_infodoc
    WHERE it.id_trabajador = :id";
    $stmt_info_prl = $pdo->prepare($sql_info_prl);
    $stmt_info_prl->execute([':id' => $id_trabajador]);
    $info_prl_trabajador = $stmt_info_prl->fetchAll(PDO::FETCH_ASSOC);

    // Limpiar cualquier salida previa
    ob_end_clean();

    // Enviar respuesta JSON con toda la información
    echo json_encode([
        'status' => 'success',
        'trabajador' => $trabajador,
        'formaciones' => [
            'todas' => $formaciones_all,
            'trabajador' => $formaciones_trabajador
        ],
        'info_prl' => [
            'todas' => $info_prl_all,
            'trabajador' => $info_prl_trabajador
        ],
        'centros' => $centros,
        'empresas' => $empresas,
        'categorias' => $categorias
    ]);
} catch (PDOException $e) {
    // Capturar errores de la base de datos
    ob_end_clean();
    error_log("Error en la base de datos: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Error en la base de datos',
        'error_details' => $e->getMessage() // Solo para desarrollo, quitar en producción
    ]);
} catch (Exception $e) {
    // Capturar cualquier otro tipo de error
    ob_end_clean();
    error_log("Error: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
