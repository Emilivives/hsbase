<?php
require_once('../../../app/config.php');
header('Content-Type: application/json');

$response = ['success' => false, 'error' => ''];

try {
    $id_trabajador = $_POST['id_trabajador'] ?? null;
    $id_infodoc = $_POST['id_infodoc'] ?? null;
    $fecha_completado = $_POST['fecha_completado'] ?? null;

    // Validación básica
    if (empty($id_trabajador) || empty($id_infodoc) || empty($fecha_completado)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    $pdo->beginTransaction();

    // Verificar si existe el documento con ese ID
    $stmtCheck = $pdo->prepare("
        SELECT id_infoprl_tr 
        FROM informacion_trabajador 
        WHERE id_trabajador = ? AND id_infodoc = ?
    ");
    $stmtCheck->execute([$id_trabajador, $id_infodoc]);
    $existe = $stmtCheck->fetch();

    // Verificar el valor de tipoinfo_ifd en la tabla info_documentos
    $stmtTipoinfo = $pdo->prepare("
        SELECT tipoinfo_ifd 
        FROM info_documentos 
        WHERE id_infodoc = ?
    ");
    $stmtTipoinfo->execute([$id_infodoc]);
    $tipoinfo = $stmtTipoinfo->fetch(PDO::FETCH_ASSOC);

    // Comprobar si el valor de tipoinfo_ifd contiene 'puesto de trabajo'
    $debeActualizarTrabajadores = ($tipoinfo && isset($tipoinfo['tipoinfo_ifd']) && 
                                  stripos($tipoinfo['tipoinfo_ifd'], 'puesto de trabajo') !== false);

    if ($existe) {
        // Actualizar fecha_completado
        $stmt = $pdo->prepare("
            UPDATE informacion_trabajador 
            SET fecha_completado = ?, estado = 'Completado'
            WHERE id_infoprl_tr = ?
        ");
        $stmt->execute([$fecha_completado, $existe['id_infoprl_tr']]);

        // Si tipoinfo_ifd contiene 'puesto de trabajo', actualizar la tabla trabajadores
        if ($debeActualizarTrabajadores) {
            $stmt = $pdo->prepare("
                UPDATE trabajadores 
                SET informacion_tr = 'Si' 
                WHERE id_trabajador = ?
            ");
            $stmt->execute([$id_trabajador]);
        }
    } else {
        // Insertar nuevo registro
        $stmt = $pdo->prepare("
            INSERT INTO informacion_trabajador 
            (id_trabajador, id_infodoc, fecha_asignacion, fecha_completado, estado) 
            VALUES (?, ?, ?, ?, 'Completado')
        ");
        $stmt->execute([
            $id_trabajador,
            $id_infodoc,
            $fecha_completado, // Fecha asignación = fecha entrega en este caso
            $fecha_completado
        ]);

        // Si tipoinfo_ifd contiene 'puesto de trabajo', actualizar la tabla trabajadores
        if ($debeActualizarTrabajadores) {
            $stmt = $pdo->prepare("
                UPDATE trabajadores 
                SET informacion_tr = 'Si' 
                WHERE id_trabajador = ?
            ");
            $stmt->execute([$id_trabajador]);
        }
    }

    $pdo->commit();
    $response['success'] = true;
    $response['message'] = "Entrega registrada correctamente";
} catch (PDOException $e) {
    $pdo->rollBack();
    $response['error'] = "Error en base de datos: " . $e->getMessage();
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);