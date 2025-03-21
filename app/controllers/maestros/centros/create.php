<?php

include('../../../../app/config.php');

$nombre_cen = $_POST['nombre_cen'];
$empresa_cen = $_POST['empresa_cen'];
$tipo_cen = $_POST['tipo_cen'];
$direccion_cen = $_POST['direccion_cen'];
$estado_cen = 1;



    $sentencia = $pdo->prepare("INSERT INTO centros (nombre_cen, empresa_cen, tipo_cen, estado_cen, direccion_cen) 
                         VALUES(:nombre_cen, :empresa_cen, :tipo_cen, :estado_cen, :direccion_cen)");

    $sentencia->bindParam('nombre_cen', $nombre_cen);    
    $sentencia->bindParam('empresa_cen', $empresa_cen);
    $sentencia->bindParam('tipo_cen', $tipo_cen);
    $sentencia->bindParam('estado_cen', $estado_cen);
    $sentencia->bindParam('direccion_cen', $direccion_cen);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Centro registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/admin/maestros/centros');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Centro NO creado";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . '/admin/maestros/centros');
    }

       
?>

    