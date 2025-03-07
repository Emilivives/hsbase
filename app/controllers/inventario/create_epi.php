<?php
include('../../../app/config.php');

try {
    // Verifica que los datos existan en $_POST antes de asignarlos
    $clase_epi = isset($_POST['clase_epi']) ? $_POST['clase_epi'] : null;
    $tipo_epi = isset($_POST['tipo_epi']) ? $_POST['tipo_epi'] : null;
    $marca_epi = isset($_POST['marca_epi']) ? $_POST['marca_epi'] : null;
    $modelo_epi = isset($_POST['modelo_epi']) ? $_POST['modelo_epi'] : null;
    $numserie_epi = isset($_POST['numserie_epi']) ? $_POST['numserie_epi'] : null;
    $centro_epi = isset($_POST['centro_epi']) ? $_POST['centro_epi'] : null;
    $manual_epi = isset($_POST['manual_epi']) ? $_POST['manual_epi'] : null;
    $marcace_epi = isset($_POST['marcace_epi']) ? $_POST['marcace_epi'] : null;  
    $aniofab_epi = isset($_POST['aniofab_epi']) ? $_POST['aniofab_epi'] : null;
    $vigencia_epi = isset($_POST['vigencia_epi']) ? $_POST['vigencia_epi'] : null;
    $estado_epi = isset($_POST['estado_epi']) ? $_POST['estado_epi'] : null;
    $observaciones_epi = isset($_POST['observaciones_epi']) ? $_POST['observaciones_epi'] : null;

    // Manejo de archivos
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . ($_FILES['img1_epi']['name'] ?? '');
    $location = "../../../admin/inventario/img/" . $filename;

    $filename2 = $nombreDelArchivo . "__" . ($_FILES['img2_epi']['name'] ?? '');
    $location2 = "../../../admin/inventario/img/" . $filename2;

    if (isset($_FILES['img1_epi']) && $_FILES['img1_epi']['error'] == 0) {
        if (!move_uploaded_file($_FILES['img1_epi']['tmp_name'], $location)) {
            throw new Exception("Error al mover la imagen 1");
        }
    }

    if (isset($_FILES['img2_epi']) && $_FILES['img2_epi']['error'] == 0) {
        if (!move_uploaded_file($_FILES['img2_epi']['tmp_name'], $location2)) {
            throw new Exception("Error al mover la imagen 2");
        }
    }

    // Comenzar la transacción
    $pdo->beginTransaction();

    // Preparar la consulta
    $sentencia = $pdo->prepare("INSERT INTO inv_epis (clase_epi, tipo_epi, marca_epi, modelo_epi, numserie_epi, 
    centro_epi, manual_epi, marcace_epi, aniofab_epi, vigencia_epi, estado_epi, observaciones_epi, img1_epi, img2_epi) 
    VALUES(:clase_epi, :tipo_epi, :marca_epi, :modelo_epi, :numserie_epi, :centro_epi, :manual_epi, 
    :marcace_epi, :aniofab_epi, :vigencia_epi, :estado_epi, :observaciones_epi, :img1_epi, :img2_epi)");

    // Enlazar parámetros
    $sentencia->bindParam(':clase_epi', $clase_epi);
    $sentencia->bindParam(':tipo_epi', $tipo_epi);
    $sentencia->bindParam(':marca_epi', $marca_epi);
    $sentencia->bindParam(':modelo_epi', $modelo_epi);
    $sentencia->bindParam(':numserie_epi', $numserie_epi);
    $sentencia->bindParam(':centro_epi', $centro_epi);
    $sentencia->bindParam(':manual_epi', $manual_epi);
    $sentencia->bindParam(':marcace_epi', $marcace_epi);
    $sentencia->bindParam(':aniofab_epi', $aniofab_epi);
    $sentencia->bindParam(':vigencia_epi', $vigencia_epi);
    $sentencia->bindParam(':estado_epi', $estado_epi);
    $sentencia->bindParam(':observaciones_epi', $observaciones_epi);
    $sentencia->bindParam(':img1_epi', $filename);
    $sentencia->bindParam(':img2_epi', $filename2);

    // Ejecutar la consulta
    if ($sentencia->execute()) {
        $pdo->commit();

        // Inicio de sesión para mensajes de éxito
        session_start();
        $_SESSION['mensaje'] = "Fila creada correctamente";
        $_SESSION['icono'] = 'success';
        header("Location: " . $URL . "/admin/inventario/controlepis.php");
        exit();
    } else {
        throw new PDOException("Error al insertar EPI");
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/inventario/controlepis.php");
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error inesperado: " . $e->getMessage();
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/inventario/controlepis.php");
    exit();
}
?>


