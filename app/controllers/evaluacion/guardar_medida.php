<?php
// Conexión a la base de datos

include('../../../app/config.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_filaeval = $_POST['id_filaeval'];
    $nueva_frasemedida = $_POST['frasemedida'];

    // Insertar la nueva frasemedida en la tabla er_medidas
    $sql_insert_medida = "INSERT INTO er_medidas (frasemedida) VALUES (:frasemedida)";
    $stmt_insert = $pdo->prepare($sql_insert_medida);
    $stmt_insert->bindParam(':frasemedida', $nueva_frasemedida);
    $stmt_insert->execute();

    // Obtener el ID de la nueva medida
    $nuevo_id_medida = $pdo->lastInsertId();

    // Actualizar la relación en er_filamedidas
    $sql_update_filamedidas = "UPDATE er_filamedidas SET medida_fm = :nuevo_id_medida WHERE filaeval_fm = :id_filaeval";
    $stmt_update = $pdo->prepare($sql_update_filamedidas);
    $stmt_update->bindParam(':nuevo_id_medida', $nuevo_id_medida, PDO::PARAM_INT);
    $stmt_update->bindParam(':id_filaeval', $id_filaeval, PDO::PARAM_INT);
    $stmt_update->execute();

    // Redirigir o mostrar mensaje de éxito
    header("Location: tabla.php?success=1");
    exit();
}