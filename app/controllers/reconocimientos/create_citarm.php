<?php

include('../../../app/config.php');

$trabajador_crm = $_POST['trabajador_crm'];
$fecha_crm = $_POST['fecha_crm'];
$anotaciones_crm = $_POST['anotaciones_crm'];


$sentencia = $pdo->prepare(
    "INSERT INTO citas_rm 
       (trabajador_crm, fecha_crm, anotaciones_crm)
     VALUES
       (:trabajador_crm, :fecha_crm, :anotaciones_crm)"
  );
  
  $sentencia->bindParam(':trabajador_crm', $trabajador_crm);    
  $sentencia->bindParam(':fecha_crm', $fecha_crm);
  $sentencia->bindParam(':anotaciones_crm', $anotaciones_crm);


if ($sentencia->execute()) {
session_start();
$_SESSION['mensaje'] = "Reconocimiento registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . '/admin/reconocimientos');
} else {
session_start();
$_SESSION['mensaje'] = "Formacion NO creada";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . '/admin/reconocimientos');
}



?>
