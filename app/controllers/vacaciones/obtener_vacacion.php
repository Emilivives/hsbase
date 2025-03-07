<?php

include('../../../app/config.php');

$id_vac_generada = $_GET['id'];

$sentencia = $pdo->prepare("SELECT * FROM vacacion_gen WHERE id_vac_generada = :id_vac_generada");
$sentencia->bindParam(':id_vac_generada', $id_vac_generada);
$sentencia->execute();

$vacacion = $sentencia->fetch(PDO::FETCH_ASSOC);

echo json_encode($vacacion);
?>
