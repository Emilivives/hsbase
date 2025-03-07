<?php

include('../../../../app/config.php');

$nombre_tm = $_POST['nombre_tm'];
$clase_tm = $_POST['clase_tm'];

    $sentencia = $pdo->prepare("INSERT INTO tipomaquinas (nombre_tm, clase_tm) 
                         VALUES(:nombre_tm, :clase_tm)");

    $sentencia->bindParam('nombre_tm', $nombre_tm);
    $sentencia->bindParam('clase_tm', $clase_tm);
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
    
