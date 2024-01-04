<?php

include('../../../app/config.php');

$nroformacion = $_GET['nroformacion'];
$idtrabajador_fas = $_GET['id_trabajador'];


$sentencia = $pdo->prepare("INSERT INTO form_asistencia (nroformacion, idtrabajador_fas) 
VALUES(:nroformacion, :idtrabajador_fas)");

$sentencia->bindParam('nroformacion', $nroformacion);
$sentencia->bindParam('idtrabajador_fas', $idtrabajador_fas);


if ($sentencia->execute()) {
    session_start();
?>
    <script>
            location.href = "<?php echo $URL; ?>/admin/pruebas/create.php";
    </script>

<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Formacion NO creada";
    $_SESSION['icono'] = 'warning';
    ?>
    <script>
            location.href = "<?php echo $URL; ?>/admin/pruebas/create.php";
    </script>

<?php
}


?>