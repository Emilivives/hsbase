<?php
// Consulta para obtener todos los elementos de revisión
$query = "SELECT * FROM er_elementos_revisionmaq ORDER BY id_elemento ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($elementos);
