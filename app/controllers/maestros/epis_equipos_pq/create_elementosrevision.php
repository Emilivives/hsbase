<?php

// Incluir la configuración de la base de datos
include('../../../../app/config.php');

// Recuperar los datos del formulario
$grupo = $_POST['grupo'];
$descripcion = $_POST['descripcion'];
$tipo = $_POST['tipo'];

// Preparar la sentencia SQL para insertar los datos
$sentencia = $pdo->prepare("INSERT INTO er_elementos_revisionmaq (grupo, descripcion, tipo) 
                            VALUES(:grupo, :descripcion, :tipo)");

// Vincular los parámetros
$sentencia->bindParam('grupo', $grupo);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('tipo', $tipo);

// Iniciar la sesión para manejar los mensajes
session_start();

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "Elemento registrado correctamente";
  $_SESSION['icono'] = 'success';
  header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq');
} else {
  session_start();
  $_SESSION['mensaje'] = "Elemento NO creado";
  $_SESSION['icono'] = 'warning';
  header('Location: ' . $URL . '/admin/maestros/epis_equipos_pq');
}

 
?>
