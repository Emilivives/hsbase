<?php
// Validar que $id_revision se reciba correctamente
if (!isset($_GET['id'])) {
    echo "ID de revisión no especificado.";
    exit;
}

$id_revision = $_GET['id']; // Asegúrate de validar y sanitizar esta entrada

$query = "SELECT 
        rev.id_revision_maquina,
        rev.id_revision,
        rev.id_maquina,
        rev.valoracion_equipo,
        tm.nombre_tm AS nombre_tipo_maquina,
        tm.clase_tm AS clase_maquina,
        maq.marca_maq AS marca,
        maq.modelo_maq AS modelo,
        maq.numserie_maq AS num_serie,
        cen.nombre_cen AS centro
    FROM er_revision_maquina AS rev
    INNER JOIN inv_maquinaria AS maq ON rev.id_maquina = maq.id_maquina
    INNER JOIN tipomaquinas AS tm ON maq.tipo_maq = tm.id_tipomaquina
    INNER JOIN centros AS cen ON maq.centro_maq = cen.id_centro
    WHERE rev.id_revision = :id_revision
";
$stmt = $pdo->prepare($query);
$stmt->execute([':id_revision' => $id_revision]);
$maquinas_evaluar = $stmt->fetchAll(PDO::FETCH_ASSOC);
