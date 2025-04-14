<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../app/config.php');

if (!isset($_POST['id_trabajador'])) {
    http_response_code(400);
    die(json_encode(["error" => "ID del trabajador no definido"]));
}

$id_trabajador = $_POST['id_trabajador'];

try {
    $sql = "SELECT 
                id_reconocimiento, 
                fecha_rm, 
                caducidad_rm, 
                vigente_rm
            FROM reconocimientos
            WHERE trabajador_rm = ?
            ORDER BY fecha_rm DESC";

    $query = $pdo->prepare($sql);
    $query->execute([$id_trabajador]);
    $reconocimientos = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($reconocimientos)) {
        echo '<div class="alert alert-info">No se encontraron reconocimientos médicos.</div>';
    } else {
        echo '<div class="table-responsive">
              <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                    <th>Fecha</th>
                    <th>Caducidad</th>
                    <th>Vigente</th>
                    <th>Acciones</th>
                </tr>
              </thead>
              <tbody>';
        
        foreach ($reconocimientos as $recon) {
            echo '<tr>
                <td>'.($recon['fecha_rm'] ? date('d/m/Y', strtotime($recon['fecha_rm'])) : 'N/A').'</td>
                <td>'.($recon['caducidad_rm'] ? date('d/m/Y', strtotime($recon['caducidad_rm'])) : 'N/A').'</td>
                <td>'.($recon['vigente_rm'] ? '<i class="bi bi-check-circle text-success"></i> Sí' : '<i class="bi bi-x-circle text-danger"></i> No').'</td>
                <td>
                    <a href="../reconocimientos/show.php?id='.$recon['id_reconocimiento'].'" 
                       class="btn btn-sm btn-outline-secondary" 
                       title="Ver detalles">
                       <i class="bi bi-eye"></i>
                    </a>
                </td>
              </tr>';
        }
        
        echo '</tbody></table></div>';
    }
} catch (PDOException $e) {
    error_log("Error en base de datos: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar reconocimientos.</div>';
}
?>