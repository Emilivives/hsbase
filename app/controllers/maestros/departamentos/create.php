<?php

include('../../../../app/config.php');

$nombre_dpo = $_POST['nombre_dpo'];
$descripcion_dpo = $_POST['descripcion_dpo'];



    $sentencia = $pdo->prepare("INSERT INTO departamentos (nombre_dpo, descripcion_dpo) 
                         VALUES(:nombre_dpo, :descripcion_dpo)");

    $sentencia->bindParam('nombre_dpo', $nombre_dpo);
    $sentencia->bindParam('descripcion_dpo', $descripcion_dpo);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Categoria registrada correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Perfil NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    }

       
?>

    