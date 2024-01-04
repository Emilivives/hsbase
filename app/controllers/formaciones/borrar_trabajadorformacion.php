<?php

include('../../../app/config.php');

$id_formasistencia = $_POST['id_formasistencia'];


$sentencia = $pdo->prepare("DELETE FROM form_asistencia WHERE id_formasistencia ='$id_formasistencia'");

//$sentencia->bindParam('id_formasistencia', $id_formasistencia);

if ($sentencia->execute()) {
?>
    <script>
        location.href = "<?php echo $URL; ?>/admin/pruebas/create.php";
    </script>


<?php
} else {
?>
    <script>
        location.href = "<?php echo $URL; ?>/admin/pruebas/create.php";
    </script>


<?php
}
