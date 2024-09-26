<?php

include('../../../../app/config.php');

$codigomedida = $_POST['codigomedida'];
$frasemedida = $_POST['frasemedida'];

$sentencia = $pdo->prepare("INSERT INTO er_medidas (codigomedida, frasemedida) 
                     VALUES(:codigomedida, :frasemedida)");

$sentencia->bindParam('codigomedida', $codigomedida);
$sentencia->bindParam('frasemedida', $frasemedida);

session_start();

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Riesgo registrado correctamente";
    $_SESSION['icono'] = 'success';
    // Enviar un script para cerrar la ventana sin recargar la ventana padre
    echo "<script>
            window.close(); // Cerrar la ventana actual
          </script>";
} else {
    $_SESSION['mensaje'] = "Riesgo NO creado";
    $_SESSION['icono'] = 'warning';
    // También aquí puedes enviar el script para cerrar
    echo "<script>
            window.close(); // Cerrar la ventana actual
          </script>";
}
?>
