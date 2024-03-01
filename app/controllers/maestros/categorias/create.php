<?php

include('../../../../app/config.php');

$nombre_cat = $_POST['nombre_cat'];
$departamento_cat = $_POST['departamento_cat'];
$descripcion_cat = $_POST['descripcion_cat'];



    $sentencia = $pdo->prepare("INSERT INTO categorias (nombre_cat, departamento_cat, descripcion_cat) 
                         VALUES(:nombre_cat, :departamento_cat, :descripcion_cat)");

    $sentencia->bindParam('nombre_cat', $nombre_cat);
    $sentencia->bindParam('departamento_cat', $departamento_cat);
    $sentencia->bindParam('descripcion_cat', $descripcion_cat);

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

    