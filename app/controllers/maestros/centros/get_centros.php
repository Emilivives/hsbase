<?php
include('../../../../app/config.php');

if (isset($_POST['empresa_id'])) {
    $empresa_id = $_POST['empresa_id'];

    $sql_centros = "SELECT id_centro, nombre_cen FROM centros WHERE empresa_cen = :empresa_id AND estado_cen = 1 ORDER BY nombre_cen ASC";
    $query_centros = $pdo->prepare($sql_centros);
    $query_centros->bindParam(':empresa_id', $empresa_id, PDO::PARAM_INT);
    $query_centros->execute();
    $centros = $query_centros->fetchAll(PDO::FETCH_ASSOC);

    if ($query_centros->rowCount() > 0) {
        echo '<option value="">Seleccione un centro</option>';
        foreach ($centros as $centro) {
            echo '<option value="' . $centro['id_centro'] . '">' . $centro['nombre_cen'] . '</option>';
        }
    } else {
        echo '<option value="">No hay centros disponibles</option>';
    }
}
?>
