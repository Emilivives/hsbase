<?php
ob_start();
include('../../../app/config.php');  
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    try {         
        $pdo->beginTransaction(); 

        // Obtener datos del formulario
        $id_trabajador = $_POST['id_trabajador'] ?? null;
        $codigo_tr = $_POST['codigo_tr'] ?? '';
        $dni_tr = $_POST['dni_tr'] ?? '';
        $nombre_tr = $_POST['nombre_tr'] ?? '';
        $sexo_tr = $_POST['sexo_tr'] ?? '';
        $fechanac_tr = $_POST['fechanac_tr'] ?? '';
        $inicio_tr = $_POST['inicio_tr'] ?? '';
        $formacionpdt_tr = $_POST['formacionpdt_tr'] ?? '';
        $informacion_tr = $_POST['informacion_tr'] ?? '';
        $centro_tr = $_POST['centro_tr'] ?? '';
        $categoria_tr = $_POST['categoria_tr'] ?? '';
        $anotaciones_tr = $_POST['anotaciones_tr'] ?? '';

        // Validar que el ID y los campos requeridos existen
        if (!$id_trabajador) {
            throw new Exception("ID de trabajador no proporcionado");
        }

        // Validar formatos de datos
        if (!preg_match('/^[A-Za-z0-9]{8}[A-Za-z]$/', $dni_tr)) {
            throw new Exception("DNI/NIE no válido.");
        }

        if (!strtotime($fechanac_tr)) {
            throw new Exception("Fecha de nacimiento no válida.");
        }

        // Validar campos obligatorios
        $required_fields = [
            'codigo_tr' => $codigo_tr, 
            'dni_tr' => $dni_tr, 
            'nombre_tr' => $nombre_tr, 
            'centro_tr' => $centro_tr, 
            'categoria_tr' => $categoria_tr
        ];

        foreach ($required_fields as $field => $value) {
            if (empty(trim($value))) {
                throw new Exception("El campo $field es obligatorio");
            }
        }

        // Actualizar datos del trabajador
        $sql_update = "UPDATE trabajadores SET 
            codigo_tr = :codigo, 
            dni_tr = :dni, 
            nombre_tr = :nombre, 
            sexo_tr = :sexo, 
            fechanac_tr = :fechanac, 
            inicio_tr = :inicio, 
            formacionpdt_tr = :formacionpdt, 
            informacion_tr = :informacion, 
            centro_tr = :centro, 
            categoria_tr = :categoria, 
            anotaciones_tr = :anotaciones
            WHERE id_trabajador = :id_trabajador";

        $stmt = $pdo->prepare($sql_update);
        $stmt->execute([
            ':codigo' => $codigo_tr,
            ':dni' => $dni_tr,
            ':nombre' => $nombre_tr,
            ':sexo' => $sexo_tr,
            ':fechanac' => $fechanac_tr,
            ':inicio' => $inicio_tr,
            ':formacionpdt' => $formacionpdt_tr,
            ':informacion' => $informacion_tr,
            ':centro' => $centro_tr,
            ':categoria' => $categoria_tr,
            ':anotaciones' => $anotaciones_tr,
            ':id_trabajador' => $id_trabajador
        ]);

        // Eliminar formaciones anteriores si es necesario y agregar nuevas
        if (!empty($_POST['formaciones'])) {
            $pdo->prepare("DELETE FROM formacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);
            $sql_formacion = "INSERT INTO formacion_trabajador (id_trabajador, id_tipoformacion, fecha_asignacion) VALUES (:id_trabajador, :id_tipoformacion, NOW())";
            $stmt_formacion = $pdo->prepare($sql_formacion);

            foreach ($_POST['formaciones'] as $id_tipoformacion) {
                $stmt_formacion->execute([ 
                    ':id_trabajador' => $id_trabajador, 
                    ':id_tipoformacion' => $id_tipoformacion
                ]);
            }
        }

        // Eliminar información PRL anterior si es necesario y agregar nueva
        if (!empty($_POST['info_prl'])) {
            $pdo->prepare("DELETE FROM informacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);
            $sql_info = "INSERT INTO informacion_trabajador (id_trabajador, id_infodoc, fecha_asignacion) VALUES (:id_trabajador, :id_infodoc, NOW())";
            $stmt_info = $pdo->prepare($sql_info);

            foreach ($_POST['info_prl'] as $id_infodoc) {
                $stmt_info->execute([ 
                    ':id_trabajador' => $id_trabajador, 
                    ':id_infodoc' => $id_infodoc
                ]);
            }
        }

        // Confirmar transacción
        $pdo->commit();

        ob_end_clean();
        echo json_encode([ 
            'status' => 'success', 
            'message' => 'Trabajador actualizado correctamente' 
        ]);
    } catch (Exception $e) {         
        $pdo->rollBack();  
        ob_end_clean();
        echo json_encode([ 
            'status' => 'error', 
            'message' => 'Error al actualizar: ' . $e->getMessage() 
        ]);
    } 
} else {     
    ob_end_clean();
    echo json_encode([ 
        'status' => 'error', 
        'message' => 'Método no permitido' 
    ]);
}
?>
