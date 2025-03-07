<?php
include('../../../app/config.php');

// Al inicio del archivo después de los includes
error_log('POST data: ' . print_r($_POST, true));

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    $requiredFields = ['id_trabajador', 'codigo_tr', 'dni_tr', 'nombre_tr'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            throw new Exception("El campo $field es requerido");
        }
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_trabajador = filter_var($_POST['id_trabajador'], FILTER_SANITIZE_NUMBER_INT);
    $codigo_tr = filter_var($_POST['codigo_tr'], FILTER_SANITIZE_STRING);
    $dni_tr = filter_var($_POST['dni_tr'], FILTER_SANITIZE_STRING);
    $nombre_tr = filter_var($_POST['nombre_tr'], FILTER_SANITIZE_STRING);
    $sexo_tr = isset($_POST['sexo_tr']) ? filter_var($_POST['sexo_tr'], FILTER_SANITIZE_STRING) : null;
    $fechanac_tr = isset($_POST['fechanac_tr']) ? filter_var($_POST['fechanac_tr'], FILTER_SANITIZE_STRING) : null;
    $categoria_tr = isset($_POST['categoria_tr']) && $_POST['categoria_tr'] !== '' ? (int)$_POST['categoria_tr'] : null;
    $centro_tr = isset($_POST['centro_tr']) && $_POST['centro_tr'] !== '' ? (int)$_POST['centro_tr'] : null;
    $activo_tr = isset($_POST['activo_tr']) ? (int)$_POST['activo_tr'] : null;

    if (!$id_trabajador || $id_trabajador <= 0) {
        throw new Exception('ID de trabajador inválido');
    }

    if (!in_array($sexo_tr, ['Hombre', 'Mujer', null])) {
        throw new Exception('Valor de sexo no válido');
    }

    if ($fechanac_tr && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechanac_tr)) {
        throw new Exception('Formato de fecha incorrecto, use YYYY-MM-DD');
    }

    $fyh_actualizacion = date('Y-m-d H:i:s');

    $sql = "UPDATE trabajadores SET 
            codigo_tr = :codigo_tr,
            nombre_tr = :nombre_tr,
            dni_tr = :dni_tr,
            sexo_tr = :sexo_tr,
            fechanac_tr = :fechanac_tr,
            categoria_tr = :categoria_tr,
            centro_tr = :centro_tr,
            activo_tr = :activo_tr,
            fyh_actualizacion = :fyh_actualizacion
            WHERE id_trabajador = :id_trabajador";

    $stmt = $pdo->prepare($sql);

    // Asignar valores a la consulta
    $stmt->bindValue(':id_trabajador', $id_trabajador, PDO::PARAM_INT);
    $stmt->bindValue(':codigo_tr', $codigo_tr);
    $stmt->bindValue(':nombre_tr', $nombre_tr);
    $stmt->bindValue(':dni_tr', $dni_tr);
    $stmt->bindValue(':sexo_tr', $sexo_tr);
    $stmt->bindValue(':fechanac_tr', $fechanac_tr);
    $stmt->bindValue(':categoria_tr', $categoria_tr, $categoria_tr !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
    $stmt->bindValue(':centro_tr', $centro_tr, $centro_tr !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
    $stmt->bindValue(':activo_tr', $activo_tr, PDO::PARAM_INT);
    $stmt->bindValue(':fyh_actualizacion', $fyh_actualizacion);

    // Ejecutar la consulta
    $result = $stmt->execute();

    if (!$result) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error en la consulta: " . $errorInfo[2]);
    }

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Trabajador actualizado correctamente']);
    } else {
        throw new Exception('No se realizaron cambios o el ID no existe');
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
