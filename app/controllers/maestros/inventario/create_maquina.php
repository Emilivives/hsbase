<?php
session_start();
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Función para manejar la carga de archivos de imagen
    function uploadImage($file) {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $nombreDelArchivo = date("Y-m-d-H-i-s");
            $filename = $nombreDelArchivo . "__" . basename($file['name']);
            $location = "../../../admin/inventario/img/" . $filename;
            if (move_uploaded_file($file['tmp_name'], $location)) {
                return $filename; // Retorna el nombre del archivo
            }
        }
        return ""; // Retorna vacío si no hay archivo o hubo un error
    }

    // Manejo de archivos de imagen
    $filename = uploadImage($_FILES['img1_maq']);
    $filename2 = uploadImage($_FILES['img2_maq']);
    $filename3 = uploadImage($_FILES['imgmto1_maq']);
    $filename4 = uploadImage($_FILES['imgmto2_maq']);

    // Insertar en la base de datos
    try {
        $sentencia = $pdo->prepare("INSERT INTO inv_maquinaria (tipo_maq, marca_maq, modelo_maq, numserie_maq, proveedor_maq, manual_maq, marcace_maq, aniofab_maq, centro_maq, estado_maq, observaciones_maq, img1_maq, img2_maq, imgmto1_maq, imgmto2_maq) VALUES (:tipo_maq, :marca_maq, :modelo_maq, :numserie_maq, :proveedor_maq, :manual_maq, :marcace_maq, :aniofab_maq, :centro_maq, :estado_maq, :observaciones_maq, :img1_maq, :img2_maq, :imgmto1_maq, :imgmto2_maq)");

        // Vincular parámetros
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
        $sentencia->bindParam(':img1_maq', $filename);
        $sentencia->bindParam(':img2_maq', $filename2);
        $sentencia->bindParam(':imgmto1_maq', $filename3);
        $sentencia->bindParam(':imgmto2_maq', $filename4);

        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "Máquina registrada exitosamente.";
        } else {
            $_SESSION['mensaje'] = "Error al registrar la máquina.";
        }
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    }

    header('Location: ' . $URL . '/admin/inventario/controlmaquinas.php');
    exit();
}
?>
