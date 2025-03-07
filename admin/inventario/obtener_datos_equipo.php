<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include('../../app/config.php');

if ($pdo) {
    echo json_encode(["success" => true, "message" => "Conexión establecida"]);
} else {
    echo json_encode(["success" => false, "message" => "No se pudo conectar a la base de datos"]);
}

if (isset($_GET['id_maquina'])) {
    $idMaquina = (int)$_GET['id_maquina'];

    $stmt = $pdo->prepare("SELECT * FROM maquinas WHERE id_maquina = :id");
    $stmt->bindParam(':id', $idMaquina, PDO::PARAM_INT);
    $stmt->execute();
    
    $maquina = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($maquina) {
        echo json_encode([
            "success" => true,
            "nombre" => $maquina['nombre_tm'],
            "tipo" => $maquina['tipo'],
            "clase" => $maquina['clase_tm'],
            "marca" => $maquina['marca_maq'],
            "modelo" => $maquina['modelo_maq'],
            "centro" => $maquina['nombre_cen'],
            "anio" => $maquina['aniofab_maq'],
            "estado" => $maquina['estado_maq'],
            "manual" => $maquina['manual_maq'],
            "ce" => $maquina['marcace_maq'],
            "foto" => $maquina['foto']
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Equipo no encontrado"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ID de máquina no proporcionado"]);
}