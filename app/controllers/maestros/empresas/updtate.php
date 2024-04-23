<?php


include('../../../config.php');

$id_empresa = $_POST['id_empresa'];
$nombre_emp = $_POST['nombre_emp'];
$razonsocial_emp = $_POST['razonsocial_emp'];
$cif_emp = $_POST['cif_emp'];
$direccion_emp = $_POST['direccion_emp'];
$modalidadprl_emp = $_POST['modalidadprl_emp'];
$logo_emp = $_POST['logo_emp'];



$sentencia = $pdo->prepare("UPDATE empresa
    SET id_empresa=:id_empresa, nombre_emp=:nombre_emp,
    razonsocial_emp=:razonsocial_emp,
    cif_emp=:cif_emp,
    direccion_emp=:direccion_emp,
    modalidadprl_emp=:modalidadprl_emp,
    logo_emp=:logo_emp
    WHERE id_empresa = :id_empresa ");

$sentencia->bindParam('id_empresa', $id_empresa);
$sentencia->bindParam('nombre_emp', $nombre_emp);
$sentencia->bindParam('razonsocial_emp', $razonsocial_emp);
$sentencia->bindParam('cif_emp', $cif_emp);
$sentencia->bindParam('direccion_emp', $direccion_emp);
$sentencia->bindParam('modalidadprl_emp', $modalidadprl_emp);
$sentencia->bindParam('logo_emp', $logo_emp);


if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la empresa de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/maestros/centros/index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/admin/maestros/centros/updateempresa.php?id=' . $id_empresa);
}
