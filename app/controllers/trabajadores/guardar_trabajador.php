<?php 
// Ensure no output before JSON
ob_start();

include('../../../app/config.php');  

// Set proper JSON header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    try {         
        // Iniciar transacción para asegurar la consistencia de los datos         
        $pdo->beginTransaction();          

        // Obtener datos del trabajador
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

        // Validar campos requeridos
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

        // Insertar trabajador         
        $sql_trabajador = "INSERT INTO trabajadores (
            codigo_tr, dni_tr, nombre_tr, sexo_tr, fechanac_tr, 
            inicio_tr, formacionpdt_tr, informacion_tr, 
            centro_tr, categoria_tr, anotaciones_tr, fyh_creacion, fyh_actualizacion
        ) VALUES (
            :codigo, :dni, :nombre, :sexo, :fechanac, 
            :inicio, :formacionpdt, :informacion, 
            :centro, :categoria, :anotaciones, :fyh_creacion, :fyh_actualizacion
        )";
        
        $stmt = $pdo->prepare($sql_trabajador);
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
            ':fyh_creacion' => $fechahora,
            ':fyh_actualizacion' => $fechahora
        ]);          

        // Obtener el ID del trabajador recién insertado         
        $id_trabajador = $pdo->lastInsertId();          

        // Guardar Formaciones         
        if (!empty($_POST['formaciones'])) {             
            $sql_formacion = "INSERT INTO formacion_trabajador (id_trabajador, id_tipoformacion, fecha_asignacion) VALUES (:id_trabajador, :id_tipoformacion, :fecha_asignacion)";             
            $stmt_formacion = $pdo->prepare($sql_formacion);             
            foreach ($_POST['formaciones'] as $id_tipoformacion) {                 
                $stmt_formacion->execute([
                    ':id_trabajador' => $id_trabajador, 
                    ':id_tipoformacion' => $id_tipoformacion,
                    ':fecha_asignacion' => $fecha
                ]);             
            }         
        }          

        // Guardar Información PRL         
        if (!empty($_POST['info_prl'])) {             
            $sql_info = "INSERT INTO informacion_trabajador (id_trabajador, id_infodoc, fecha_asignacion) VALUES (:id_trabajador, :id_infodoc, :fecha_asignacion)";             
            $stmt_info = $pdo->prepare($sql_info);             
            foreach ($_POST['info_prl'] as $id_infodoc) {                 
                $stmt_info->execute([
                    ':id_trabajador' => $id_trabajador, 
                    ':id_infodoc' => $id_infodoc,
                    ':fecha_asignacion' => $fecha
                ]);             
            }         
        }          

        // Confirmar transacción         
        $pdo->commit();                  
        
        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Trabajador registrado correctamente',
            'id_trabajador' => $id_trabajador
        ]);     
    } catch (Exception $e) {         
        $pdo->rollBack();         
        
        // Clear any previous output
        ob_end_clean();
        
        echo json_encode([
            'status' => 'error', 
            'message' => 'Error al registrar: ' . $e->getMessage()
        ]);     
    } 
} else {     
    // Clear any previous output
    ob_end_clean();
    
    echo json_encode([
        'status' => 'error', 
        'message' => 'Método no permitido'
    ]); 
} 
?>