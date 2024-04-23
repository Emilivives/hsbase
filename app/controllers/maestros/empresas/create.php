<?php

include('../../../../app/config.php');

$nombre_emp = $_POST['nombre_emp'];
$razonsocial_emp = $_POST['razonsocial_emp'];
$cif_emp = $_POST['cif_emp'];
$direccion_emp = $_POST['direccion_emp'];
$modalidadprl_emp = $_POST['modalidadprl_emp'];

$image = $_FILES['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo."__".$_FILES['image']['name'];
$location = "../../../../admin/maestros/centros/img/".$filename;

move_uploaded_file($_FILES['image']['tmp_name'],$location);



    $sentencia = $pdo->prepare("INSERT INTO empresa (nombre_emp, razonsocial_emp, cif_emp, direccion_emp, modalidadprl_emp, logo_emp) 
                         VALUES(:nombre_emp, :razonsocial_emp, :cif_emp, :direccion_emp, :modalidadprl_emp, :logo_emp)");

    $sentencia->bindParam('nombre_emp', $nombre_emp);
    $sentencia->bindParam('razonsocial_emp', $razonsocial_emp);
    $sentencia->bindParam('cif_emp', $cif_emp);
    $sentencia->bindParam('direccion_emp', $direccion_emp);
    $sentencia->bindParam('modalidadprl_emp', $modalidadprl_emp);
    $sentencia->bindParam('logo_emp',$filename);

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

    