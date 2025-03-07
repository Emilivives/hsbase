<?php
session_start();

include('../../../app/config.php'); // Asegúrate de que en config.php usas PDO

if (isset($_POST['id_epi']) && filter_var($_POST['id_epi'], FILTER_VALIDATE_INT)) {
    $id_epi = $_POST['id_epi'];

    try {
        $sql = "SELECT * FROM inv_epis WHERE id_epi = :id_epi";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_epi', $id_epi, PDO::PARAM_INT);
        $stmt->execute();

        $epi = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($epi) {
            echo json_encode($epi);
        } else {
            echo json_encode(['error' => 'EPI no encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de EPI no válido']);
}
?>
