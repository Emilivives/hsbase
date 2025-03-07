<?php
require_once('../../../app/config.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Capturar datos del formulario
$fecha = trim($_POST['fecha_er'] ?? '');
$id_centro = trim($_POST['centro_er'] ?? '');
$descripcion = trim($_POST['descripcion_er'] ?? '');

// Validar que los campos no estén vacíos
if (empty($fecha) || empty($id_centro) || empty($descripcion)) {
    $_SESSION['mensaje'] = "Error: Todos los campos son obligatorios.";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . '/admin/evaluacion/index_equipos.php');
    exit;
}

try {
    // Debug: Print values before insert
    error_log("Inserting: fecha=$fecha, centro=$id_centro, desc=$descripcion");
    
    // Preparar la consulta SQL con PDO
    $sql = "INSERT INTO er_equiposcentro (id_centro, fecha, descripcion) VALUES (:id_centro, :fecha, :descripcion)";
    $stmt = $pdo->prepare($sql);
    
    // Asignar los valores y ejecutar
    $stmt->bindParam(':id_centro', $id_centro, PDO::PARAM_INT);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    
    // Debug: Print the prepared SQL
    error_log("SQL: " . $sql);
    
    $result = $stmt->execute();
    
    if ($result) {
        // Debug: Print success message
        error_log("Insert successful. Last Insert ID: " . $pdo->lastInsertId());
        
        $_SESSION['mensaje'] = "Evaluación creada correctamente.";
        $_SESSION['icono'] = 'success';
    } else {
        // Debug: Print error info
        error_log("Insert failed. Error info: " . print_r($stmt->errorInfo(), true));
        
        $_SESSION['mensaje'] = "Error al crear la evaluación.";
        $_SESSION['icono'] = 'warning';
    }
    
} catch (PDOException $e) {
    error_log("Error PDO: " . $e->getMessage());
    $_SESSION['mensaje'] = "Error interno del servidor.";
    $_SESSION['icono'] = 'danger';
}

header('Location: ' . $URL . '/admin/evaluacion/index_equipos.php');
exit;