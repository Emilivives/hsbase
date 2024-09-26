<?php

include('../../../app/config.php');

// Sanitizar y validar datos
$evaluacion_pc = htmlspecialchars($_POST['evaluacion_pc']);
$puestoarea_pc = htmlspecialchars($_POST['puestoarea_pc']);
$descripcion_pc = htmlspecialchars($_POST['descripcion_pc']);
$factoresriesgo_pc = htmlspecialchars($_POST['factoresriesgo_pc']);
$sensible_pc = htmlspecialchars($_POST['sensible_pc']);
$siniestralidad_pc = htmlspecialchars($_POST['siniestralidad_pc']);
$epis_pc = isset($_POST['epis_pc']) ? $_POST['epis_pc'] : [];  // Array de medidas
$equipos_pc = htmlspecialchars($_POST['equipos_pc']);
$prodquim_pc = htmlspecialchars($_POST['prodquim_pc']);
$metodos_pc = isset($_POST['metodos_pc']) ? $_POST['metodos_pc'] : [];  // Array de medidas
$factorpsico_pc = isset($_POST['factorpsico_pc']) ? $_POST['factorpsico_pc'] : [];  // Array de medidas

$epis_pc_str = implode(',', $epis_pc); // Convertir el array a una cadena separada por comas
$metodos_pc_str = implode(',', $metodos_pc); // Convertir el array a una cadena separada por comas
$factorpsico_pc_str = implode(',', $factorpsico_pc); // Convertir el array a una cadena separada por comas


try {
$sentencia = $pdo->prepare("INSERT INTO er_puestocentro (evaluacion_pc, puestoarea_pc, descripcion_pc, factoresriesgo_pc, 
sensible_pc, siniestralidad_pc, epis_pc, equipos_pc, prodquim_pc, metodos_pc, factorpsico_pc) 
VALUES(:evaluacion_pc, :puestoarea_pc, :descripcion_pc, :factoresriesgo_pc, :sensible_pc, :siniestralidad_pc, :epis_pc, 
:equipos_pc, :prodquim_pc, :metodos_pc, :factorpsico_pc) ");

$sentencia->bindParam('evaluacion_pc', $evaluacion_pc);
$sentencia->bindParam('puestoarea_pc', $puestoarea_pc);
$sentencia->bindParam('descripcion_pc', $descripcion_pc);
$sentencia->bindParam('factoresriesgo_pc', $factoresriesgo_pc);
$sentencia->bindParam('sensible_pc', $sensible_pc);
$sentencia->bindParam('siniestralidad_pc', $siniestralidad_pc);
$sentencia->bindParam('epis_pc', $epis_pc_str);
$sentencia->bindParam('equipos_pc', $equipos_pc);
$sentencia->bindParam('prodquim_pc', $prodquim_pc);
$sentencia->bindParam('metodos_pc', $metodos_pc_str);
$sentencia->bindParam('factorpsico_pc', $factorpsico_pc_str);


if ($sentencia->execute()) {
session_start();
$ultimotr = $pdo->lastInsertId();
$_SESSION['mensaje'] = "Puesto/area registrado correctamente";
$_SESSION['icono'] = 'success';
header('Location: ' . $URL . "/admin/evaluacion/show_er.php?id_evaluacion=$evaluacion_pc");
} else {
session_start();
$_SESSION['mensaje'] = "Evaluacion NO registrado";
$_SESSION['icono'] = 'warning';
header('Location: ' . $URL . "/admin/evaluacion/show_er.php?id_evaluacion=$evaluacion_pc");
}

} catch (PDOException $e) {
    // Manejo de errores
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'danger';
    header('Location: ' . $URL . "/admin/evaluacion/show_er.php?id_evaluacion=$evaluacion_pc");
}

?>