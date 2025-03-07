<?php
include('../../../app/config.php');

// Sanitizar y validar datos
$evaluacion_eq = htmlspecialchars($_POST['evaluacion_eq']);
$area_eq = htmlspecialchars($_POST['area_eq']);
$descripcion_eq = htmlspecialchars($_POST['descripcion_eq']);
$factoresriesgo_eq = htmlspecialchars($_POST['factoresriesgo_eq']);

// Manejo de arrays de checkboxes
$epis_eq = isset($_POST['epis_eq']) ? $_POST['epis_eq'] : [];
$metodos_eq = isset($_POST['metodos_eq']) ? $_POST['metodos_eq'] : [];

// Convertir arrays a strings para almacenamiento
$epis_eq_str = implode(", ", $epis_eq);
$metodos_eq_str = implode(", ", $metodos_eq);

try {
    $sentencia = $pdo->prepare("INSERT INTO er_equiposcentro 
        (evaluacion_eq, area_eq, descripcion_eq, factoresriesgo_eq, epis_eq, metodos_eq) 
        VALUES 
        (:evaluacion_eq, :area_eq, :descripcion_eq, :factoresriesgo_eq, :epis_eq, :metodos_eq)");

    $sentencia->bindParam('evaluacion_eq', $evaluacion_eq);
    $sentencia->bindParam('area_eq', $area_eq);
    $sentencia->bindParam('descripcion_eq', $descripcion_eq);
    $sentencia->bindParam('factoresriesgo_eq', $factoresriesgo_eq);
    $sentencia->bindParam('epis_eq', $epis_eq_str);
    $sentencia->bindParam('metodos_eq', $metodos_eq_str);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Puesto/area registrado correctamente";
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . "/admin/evaluacion/show_equipos.php?id_evaluacion=$evaluacion_eq");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Evaluacion NO registrada";
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . "/admin/evaluacion/show_equipos.php?id_evaluacion=$evaluacion_eq");
    }

} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = 'danger';
    header('Location: ' . $URL . "/admin/evaluacion/show_equipos.php?id_evaluacion=$evaluacion_eq");
}
?>