<?php
session_start();
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_maquina = $_POST['id_maquina'];

    // Obtener los datos del formulario
    $tipo_maq = $_POST['tipo_maq'];
    $marca_maq = $_POST['marca_maq'];
    $modelo_maq = $_POST['modelo_maq'];
    $numserie_maq = $_POST['numserie_maq'];
    $proveedor_maq = $_POST['proveedor_maq'];
    $manual_maq = $_POST['manual_maq'];
    $marcace_maq = $_POST['marcace_maq'];
    $aniofab_maq = $_POST['aniofab_maq'];
    $centro_maq = $_POST['centro_maq'];
    $estado_maq = $_POST['estado_maq'];
    $observaciones_maq = $_POST['observaciones_maq'];

    // Manejar imagen 1
    $filename = $_POST['img1_maq_actual']; // Mantener imagen actual por defecto
    if (isset($_FILES['img1_maq']) && $_FILES['img1_maq']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['img1_maq']['name'], PATHINFO_EXTENSION);
        $nombreDelArchivo = date("Y-m-d-H-i-s") . "_1." . $extension;
        $location = "../../../admin/inventario/img/" . $nombreDelArchivo;

        if (move_uploaded_file($_FILES['img1_maq']['tmp_name'], $location)) {
            $filename = $nombreDelArchivo;
            if ($_POST['img1_maq_actual'] && $_POST['img1_maq_actual'] != 'default.jpg') {
                $rutaAnterior = "../../../admin/inventario/img/" . $_POST['img1_maq_actual'];
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }
        }
    }

    // Manejar imagen 2
    $filename2 = $_POST['img2_maq_actual']; // Mantener imagen actual por defecto
    if (isset($_FILES['img2_maq']) && $_FILES['img2_maq']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['img2_maq']['name'], PATHINFO_EXTENSION);
        $nombreDelArchivo2 = date("Y-m-d-H-i-s") . "_2." . $extension;
        $location2 = "../../../admin/inventario/img/" . $nombreDelArchivo2;

        if (move_uploaded_file($_FILES['img2_maq']['tmp_name'], $location2)) {
            $filename2 = $nombreDelArchivo2;
            if ($_POST['img2_maq_actual'] && $_POST['img2_maq_actual'] != 'default.jpg') {
                $rutaAnterior = "../../../admin/inventario/img/" . $_POST['img2_maq_actual'];
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }
        }
    }
    // Manejar imagen 3
    $filename3 = $_POST['imgmto1_maq_actual']; // Mantener imagen actual por defecto
    if (isset($_FILES['imgmto1_maq']) && $_FILES['imgmto1_maq']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['imgmto1_maq']['name'], PATHINFO_EXTENSION);
        $nombreDelArchivo = date("Y-m-d-H-i-s") . "_1." . $extension;
        $location = "../../../admin/inventario/img/" . $nombreDelArchivo;

        if (move_uploaded_file($_FILES['imgmto1_maq']['tmp_name'], $location)) {
            $filename3 = $nombreDelArchivo;
            if ($_POST['imgmto1_maq_actual'] && $_POST['imgmto1_maq_actual'] != 'default.jpg') {
                $rutaAnterior = "../../../admin/inventario/img/" . $_POST['imgmto1_maq_actual'];
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }
        }
    }

    // Manejar imagen 4
    $filename4 = $_POST['imgmto2_maq_actual']; // Mantener imagen actual por defecto
    if (isset($_FILES['imgmto2_maq']) && $_FILES['imgmto2_maq']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['imgmto2_maq']['name'], PATHINFO_EXTENSION);
        $nombreDelArchivo2 = date("Y-m-d-H-i-s") . "_2." . $extension;
        $location2 = "../../../admin/inventario/img/" . $nombreDelArchivo2;

        if (move_uploaded_file($_FILES['imgmto2_maq']['tmp_name'], $location2)) {
            $filename4 = $nombreDelArchivo2;
            if ($_POST['img2_maq_actual'] && $_POST['imgmto2_maq_actual'] != 'default.jpg') {
                $rutaAnterior = "../../../admin/inventario/img/" . $_POST['imgmto2_maq_actual'];
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }
        }
    }

    try {
        // Construir la sentencia de actualización
        $sql = "UPDATE inv_maquinaria SET 
            tipo_maq = :tipo_maq,
            marca_maq = :marca_maq,
            modelo_maq = :modelo_maq,
            numserie_maq = :numserie_maq,
            proveedor_maq = :proveedor_maq,
            manual_maq = :manual_maq,
            marcace_maq = :marcace_maq,
            aniofab_maq = :aniofab_maq,
            centro_maq = :centro_maq,
            estado_maq = :estado_maq,
            observaciones_maq = :observaciones_maq";

        // Solo incluir img1_maq en la consulta si se ha actualizado
        if ($filename !== $_POST['img1_maq_actual']) {
            $sql .= ", img1_maq = :img1_maq";
        }

        // Solo incluir img2_maq en la consulta si se ha actualizado
        if ($filename2 !== $_POST['img2_maq_actual']) {
            $sql .= ", img2_maq = :img2_maq";
        }
        // Solo incluir img1_maq en la consulta si se ha actualizado
        if ($filename3 !== $_POST['imgmto1_maq_actual']) {
            $sql .= ", imgmto1_maq = :imgmto1_maq";
        }

        // Solo incluir img2_maq en la consulta si se ha actualizado
        if ($filename4 !== $_POST['imgmto2_maq_actual']) {
            $sql .= ", imgmto2_maq = :imgmto2_maq";
        }

        $sql .= " WHERE id_maquina = :id_maquina";

        $sentencia = $pdo->prepare($sql);

        // Vincular parámetros comunes
        $sentencia->bindParam(':tipo_maq', $tipo_maq);
        $sentencia->bindParam(':marca_maq', $marca_maq);
        $sentencia->bindParam(':modelo_maq', $modelo_maq);
        $sentencia->bindParam(':numserie_maq', $numserie_maq);
        $sentencia->bindParam(':proveedor_maq', $proveedor_maq);
        $sentencia->bindParam(':manual_maq', $manual_maq);
        $sentencia->bindParam(':marcace_maq', $marcace_maq);
        $sentencia->bindParam(':aniofab_maq', $aniofab_maq);
        $sentencia->bindParam(':centro_maq', $centro_maq);
        $sentencia->bindParam(':estado_maq', $estado_maq);
        $sentencia->bindParam(':observaciones_maq', $observaciones_maq);
        $sentencia->bindParam(':id_maquina', $id_maquina);

        // Solo vincular imágenes si se han actualizado
        if ($filename !== $_POST['img1_maq_actual']) {
            $sentencia->bindParam(':img1_maq', $filename);
        }
        if ($filename2 !== $_POST['img2_maq_actual']) {
            $sentencia->bindParam(':img2_maq', $filename2);
        }
        // Solo vincular imágenes si se han actualizado
        if ($filename3 !== $_POST['imgmto1_maq_actual']) {
            $sentencia->bindParam(':imgmto1_maq', $filename);
        }
        if ($filename4 !== $_POST['imgmto2_maq_actual']) {
            $sentencia->bindParam(':imgmto2_maq', $filename2);
        }


        $sentencia->execute();
        $_SESSION['mensaje'] = "Máquina actualizada exitosamente.";
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    }

    header('Location: ' . $URL . '/admin/inventario/controlmaquinas.php');
    exit();
}
