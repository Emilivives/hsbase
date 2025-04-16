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

        // Validaciones y actualización de datos básicos (sin cambios)
        // [...]

        // Actualizar datos básicos del trabajador
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

        // Procesar formaciones si se indica
        if (isset($_POST['procesar_formaciones'])) {
            // Preparar array de formaciones seleccionadas (o vacío si no hay)
            $formaciones_seleccionadas = isset($_POST['formaciones']) && is_array($_POST['formaciones']) ? 
                                        $_POST['formaciones'] : [];
            
            if (empty($formaciones_seleccionadas)) {
                // Si no hay formaciones seleccionadas, eliminar todas
                $pdo->prepare("DELETE FROM formacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);
            } else {
                // Obtener las formaciones actuales del trabajador
                $stmt = $pdo->prepare("SELECT id_tipoformacion, fecha_completado, estado FROM formacion_trabajador WHERE id_trabajador = ?");
                $stmt->execute([$id_trabajador]);
                $formaciones_actuales = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Crear un array de las formaciones actuales para fácil acceso
                $formaciones_actuales_map = [];
                foreach ($formaciones_actuales as $fa) {
                    $formaciones_actuales_map[$fa['id_tipoformacion']] = [
                        'fecha_completado' => $fa['fecha_completado'],
                        'estado' => $fa['estado']
                    ];
                }
                
                // Eliminar las formaciones que ya no están seleccionadas
                $placeholders = implode(',', array_fill(0, count($formaciones_seleccionadas), '?'));
                if (!empty($placeholders)) {
                    $params = array_merge([$id_trabajador], $formaciones_seleccionadas);
                    $pdo->prepare("DELETE FROM formacion_trabajador WHERE id_trabajador = ? AND id_tipoformacion NOT IN ($placeholders)")->execute($params);
                }
                
                // Insertar o mantener las formaciones seleccionadas
                $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM formacion_trabajador WHERE id_trabajador = ? AND id_tipoformacion = ?");
                $stmt_insert = $pdo->prepare("INSERT INTO formacion_trabajador (id_trabajador, id_tipoformacion, fecha_asignacion, fecha_completado, estado) VALUES (?, ?, NOW(), ?, ?)");
                
                foreach ($formaciones_seleccionadas as $id_formacion) {
                    $stmt_check->execute([$id_trabajador, $id_formacion]);
                    $existe = $stmt_check->fetchColumn();
                    
                    if (!$existe) {
                        // Si no existe, insertar con valores por defecto
                        $fecha_completado = isset($formaciones_actuales_map[$id_formacion]) ? 
                                            $formaciones_actuales_map[$id_formacion]['fecha_completado'] : null;
                        $estado = isset($formaciones_actuales_map[$id_formacion]) ? 
                                 $formaciones_actuales_map[$id_formacion]['estado'] : 'Pendiente';
                        
                        $stmt_insert->execute([$id_trabajador, $id_formacion, $fecha_completado, $estado]);
                    }
                    // Si ya existe, lo dejamos como está
                }
            }
        }

        // Procesar información PRL si se indica
        if (isset($_POST['procesar_info_prl'])) {
            // Preparar array de info PRL seleccionada (o vacío si no hay)
            $info_prl_seleccionada = isset($_POST['info_prl']) && is_array($_POST['info_prl']) ? 
                                    $_POST['info_prl'] : [];
            
            if (empty($info_prl_seleccionada)) {
                // Si no hay info PRL seleccionada, eliminar todas
                $pdo->prepare("DELETE FROM informacion_trabajador WHERE id_trabajador = ?")->execute([$id_trabajador]);
            } else {
                // Obtener la info PRL actual del trabajador
                $stmt = $pdo->prepare("SELECT id_infodoc, fecha_completado, estado FROM informacion_trabajador WHERE id_trabajador = ?");
                $stmt->execute([$id_trabajador]);
                $info_prl_actual = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Crear un array de la info PRL actual para fácil acceso
                $info_prl_actual_map = [];
                foreach ($info_prl_actual as $ipa) {
                    $info_prl_actual_map[$ipa['id_infodoc']] = [
                        'fecha_completado' => $ipa['fecha_completado'],
                        'estado' => $ipa['estado']
                    ];
                }
                
                // Eliminar la info PRL que ya no está seleccionada
                $placeholders = implode(',', array_fill(0, count($info_prl_seleccionada), '?'));
                if (!empty($placeholders)) {
                    $params = array_merge([$id_trabajador], $info_prl_seleccionada);
                    $pdo->prepare("DELETE FROM informacion_trabajador WHERE id_trabajador = ? AND id_infodoc NOT IN ($placeholders)")->execute($params);
                }
                
                // Insertar o mantener la info PRL seleccionada
                $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM informacion_trabajador WHERE id_trabajador = ? AND id_infodoc = ?");
                $stmt_insert = $pdo->prepare("INSERT INTO informacion_trabajador (id_trabajador, id_infodoc, fecha_asignacion, fecha_completado, estado) VALUES (?, ?, NOW(), ?, ?)");
                
                foreach ($info_prl_seleccionada as $id_infodoc) {
                    $stmt_check->execute([$id_trabajador, $id_infodoc]);
                    $existe = $stmt_check->fetchColumn();
                    
                    if (!$existe) {
                        // Si no existe, insertar con valores por defecto
                        $fecha_completado = isset($info_prl_actual_map[$id_infodoc]) ? 
                                            $info_prl_actual_map[$id_infodoc]['fecha_completado'] : null;
                        $estado = isset($info_prl_actual_map[$id_infodoc]) ? 
                                $info_prl_actual_map[$id_infodoc]['estado'] : 'Pendiente';
                        
                        $stmt_insert->execute([$id_trabajador, $id_infodoc, $fecha_completado, $estado]);
                    }
                    // Si ya existe, lo dejamos como está
                }
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