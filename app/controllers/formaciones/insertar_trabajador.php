<?php 

include('../../../app/config.php');

$nroformacion = $_GET['nroformacion'];
$idtrabajador_fas = $_GET['id_trabajador'];

// Insertar el trabajador en la formación
$sentencia = $pdo->prepare("INSERT INTO form_asistencia (nroformacion, idtrabajador_fas) VALUES(:nroformacion, :idtrabajador_fas)");
$sentencia->bindParam(':nroformacion', $nroformacion);
$sentencia->bindParam(':idtrabajador_fas', $idtrabajador_fas);

if ($sentencia->execute()) {
    // Verificar si la formación es "riesgos del puesto de trabajo"
    $query = $pdo->prepare("SELECT detalle_fr FROM formacion WHERE nroformacion = :nroformacion");
    $query->bindParam(':nroformacion', $nroformacion);
    $query->execute();
    $detalle_fr = $query->fetchColumn();

    if ($detalle_fr === 'riesgos del puesto de trabajo') {
        // Actualizar el campo formacionpdt_tr del trabajador
        $update = $pdo->prepare("UPDATE trabajadores SET formacionpdt_tr = 'Si' WHERE id_trabajador = :idtrabajador_fas");
        $update->bindParam(':idtrabajador_fas', $idtrabajador_fas);
        $update->execute();
    }

    session_start();
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/admin/formacion/create.php";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Formacion NO creada";
    $_SESSION['icono'] = 'warning';
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/admin/formacion/create.php";
    </script>
    <?php
}
