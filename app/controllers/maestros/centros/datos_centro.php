<?php
include(__DIR__ . '/../../../config.php'); // Ruta dinámica para evitar errores

if (!isset($pdo)) {
    die("Error: No se pudo conectar a la base de datos.");
}

$id_centro = $_GET['id_centro']; // Se recibe el ID por GET

$sql_centros = "SELECT 
    cen.id_centro, 
    cen.nombre_cen, 
    cen.direccion_cen, 
    emp.id_empresa, 
    emp.nombre_emp, 
    tc.id_tipocentro, 
    tc.nombre_tc 
FROM centros AS cen
INNER JOIN empresa AS emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN tipocentros AS tc ON cen.tipo_cen = tc.id_tipocentro
WHERE cen.id_centro = :id_centro";

$query_centros = $pdo->prepare($sql_centros);
$query_centros->bindParam(':id_centro', $id_centro, PDO::PARAM_INT);
$query_centros->execute();
$centro = $query_centros->fetch(PDO::FETCH_ASSOC);

if (!$centro) {
    echo "No se encontró el centro.";
    exit;
}
?>
