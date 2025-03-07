<?php
require_once('../../../app/config.php');
session_start();

// Debug inicial
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug de los datos recibidos
echo "Datos POST recibidos:<br>";
var_dump($_POST);

// Obtener los datos enviados desde el formulario
$id_revision = $_POST['id_revision'] ?? null;
$maquina_id = $_POST['maquina_id'] ?? null;

echo "ID Revisión: " . $id_revision . "<br>";
echo "ID Máquina: " . $maquina_id . "<br>";

// Validar que se hayan enviado los datos necesarios
if (!empty($id_revision) && !empty($maquina_id)) {
    try {
        // Debug de la conexión
        echo "Intentando conexión a la base de datos...<br>";
        
        // Preparar la consulta
        $sql = "INSERT INTO er_revision_maquina (id_revision, id_maquina, valoracion_equipo, evaluacion_final)
                VALUES (:id_revision, :maquina_id, NULL, NULL)";
        
        echo "SQL a ejecutar: " . $sql . "<br>";
        
        $stmt = $pdo->prepare($sql);
        
        // Asignar los valores
        $stmt->bindParam(':id_revision', $id_revision, PDO::PARAM_INT);
        $stmt->bindParam(':maquina_id', $maquina_id, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Máquina añadida correctamente.";
            $_SESSION['icono'] = "success";
            echo "Inserción exitosa<br>";
        } else {
            $_SESSION['mensaje'] = "Error al añadir la máquina.";
            $_SESSION['icono'] = "error";
            echo "Error en la inserción<br>";
            var_dump($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        echo "Excepción PDO: " . $e->getMessage() . "<br>";
    }
} else {
    $_SESSION['mensaje'] = "Por favor, complete todos los campos.";
    $_SESSION['icono'] = "warning";
    echo "Datos incompletos<br>";
}

// Debug de la URL de redirección
echo "URL base: " . $URL . "<br>";
$redirect_url = trim($URL) . '/admin/evaluacion/show_equiposcentro.php';
if (!empty($id_revision)) {
    $redirect_url .= '?id=' . urlencode($id_revision);
}
echo "URL de redirección: " . $redirect_url . "<br>";

// Comentamos temporalmente la redirección para ver los mensajes de debug
// header('Location: ' . $redirect_url);
// exit();