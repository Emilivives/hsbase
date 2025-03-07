<?php


include('../../../config.php');

$id_departamento = $_POST['id_departamento'];


    $sentencia = $pdo->prepare("DELETE FROM departamentos WHERE id_departamento = '$id_departamento'");


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Departamento eliminado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Departamento no eliminado correctamente";
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/admin/maestros/categorias');
    }
