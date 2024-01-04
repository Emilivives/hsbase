<?php

include('../../../../app/config.php');

$nombre_emp = $_POST['nombre_emp'];
$cif_emp = $_POST['cif_emp'];
$direccion_emp = $_POST['direccion_emp'];



    $sentencia = $pdo->prepare("INSERT INTO empresa (nombre_emp, cif_emp, direccion_emp) 
                         VALUES(:nombre_emp, :cif_emp, :direccion_emp)");

    $sentencia->bindParam('nombre_emp', $nombre_emp);
    $sentencia->bindParam('cif_emp', $cif_emp);
    $sentencia->bindParam('direccion_emp', $direccion_emp);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Empresa registrada correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/centros');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Empresa NO creada";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/centros');
    }

       
?>

    