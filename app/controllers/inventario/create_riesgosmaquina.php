<?php
include('../../../app/config.php');

header('Content-Type: application/json'); // Para que devuelva JSON

// Verifica que los datos lleguen correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Capturar datos del formulario
        $id_maquina = $_POST['id_maquina'] ?? null;
        $riesgo_fer = $_POST['riesgo_fer'] ?? null;
        $probabilidad_fer = $_POST['probabilidad_fer'] ?? null;
        $gravedad_fer = $_POST['gravedad_fer'] ?? null;
        $nivelriesgo_fer = $_POST['nivelriesgo_fer'] ?? null;

        // Validar que todos los campos obligatorios tengan valores
        if (!$id_maquina || !$riesgo_fer || !$probabilidad_fer || !$gravedad_fer || !$nivelriesgo_fer) {
            echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
            exit;
        }

        // Preparar la consulta SQL para insertar datos con PDO
        $sql = "INSERT INTO inv_maquinaria_riesgos (id_maquina, id_riesgo, probabilidad, gravedad, nivelriesgo)
                VALUES (:id_maquina, :riesgo_fer, :probabilidad_fer, :gravedad_fer, :nivelriesgo_fer)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_maquina', $id_maquina, PDO::PARAM_INT);
        $stmt->bindParam(':riesgo_fer', $riesgo_fer, PDO::PARAM_INT);
        $stmt->bindParam(':probabilidad_fer', $probabilidad_fer, PDO::PARAM_STR);
        $stmt->bindParam(':gravedad_fer', $gravedad_fer, PDO::PARAM_STR);
        $stmt->bindParam(':nivelriesgo_fer', $nivelriesgo_fer, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Riesgo agregado correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al guardar el riesgo"]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud no permitido"]);
}
?>
