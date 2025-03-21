<?php

include('../../../app/config.php');


$nroformacion = $_GET['nroformacion'];
$tipo_fr = $_GET['tipo_fr'];
$fecha_fr = $_GET['fecha_fr'];
$fechacad_fr = $_GET['fechacad_fr'];
$formador_fr = $_GET['formador_fr'];
$detalle_fr = $_GET['detalle_fr'];
$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO formacion (nroformacion, tipo_fr, fecha_fr, fechacad_fr, formador_fr, detalle_fr) 
VALUES(:nroformacion, :tipo_fr, :fecha_fr, :fechacad_fr, :formador_fr, :detalle_fr)");

$sentencia->bindParam('nroformacion', $nroformacion);
$sentencia->bindParam('tipo_fr', $tipo_fr);
$sentencia->bindParam('fecha_fr', $fecha_fr);
$sentencia->bindParam('fechacad_fr', $fechacad_fr);
$sentencia->bindParam('formador_fr', $formador_fr);
$sentencia->bindParam('detalle_fr', $detalle_fr);

if ($sentencia->execute()) {

// Get the art19_tf value for this formation type
$query = $pdo->prepare("SELECT art19_tf FROM tipoformacion WHERE id_tipoformacion = :tipo_fr");
$query->bindParam(':tipo_fr', $tipo_fr, PDO::PARAM_INT);
$query->execute();
$art19_tf = $query->fetchColumn();

// If it's a workplace training (art19_tf = 1), update all workers in this formation
if ($art19_tf == 1) {
    $updateWorkers = $pdo->prepare("
        UPDATE trabajadores t
        JOIN form_asistencia fa ON t.id_trabajador = fa.idtrabajador_fas
        SET t.formacionpdt_tr = 'Si'
        WHERE fa.nroformacion = :nroformacion
    ");
    $updateWorkers->bindParam(':nroformacion', $nroformacion, PDO::PARAM_INT);
    $updateWorkers->execute();
}

$pdo->commit();
session_start();
$_SESSION['mensaje'] = "Formacion registrada correctamente";
$_SESSION['icono'] = 'success';
?>
    <script>
        location.href = "<?php echo $URL;?>/admin/formacion";
    </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Formacion NO creada";
    $_SESSION['icono'] = 'warning';
  
?>
    <script>
        location.href = "<?php echo $URL; ?>/admin/formacion";
    </script>
<?php
}