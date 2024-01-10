<?php

include('../../../app/config.php');


$nroformacion = $_GET['nroformacion'];
$tipo_fr = $_GET['tipo_fr'];
$fecha_fr = $_GET['fecha_fr'];
$fechacad_fr = $_GET['fechacad_fr'];
$formador_fr = $_GET['formador_fr'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO formacion (nroformacion, tipo_fr, fecha_fr, fechacad_fr, formador_fr) 
VALUES(:nroformacion, :tipo_fr, :fecha_fr, :fechacad_fr, :formador_fr)");

$sentencia->bindParam('nroformacion', $nroformacion);
$sentencia->bindParam('tipo_fr', $tipo_fr);
$sentencia->bindParam('fecha_fr', $fecha_fr);
$sentencia->bindParam('fechacad_fr', $fechacad_fr);
$sentencia->bindParam('formador_fr', $formador_fr);

if ($sentencia->execute()) {

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Formacion registrada correctamente";
    $_SESSION['icono'] = 'success';
    //header('Location: ' . $URL . '/admin/pruebas/create.php');
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
    //header('Location: ' . $URL . '/admin/pruebas/create.php');
?>
    <script>
        location.href = "<?php echo $URL; ?>/admin//formacion";
    </script>
<?php
}