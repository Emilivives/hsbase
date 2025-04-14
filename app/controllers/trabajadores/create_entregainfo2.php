<?php

include('../../../app/config.php');

$id_trabajador = $_POST['id_trabajador'];
$id_infodoc = $_POST['id_infodoc'];
$fechaentrega = $_POST['fechaentrega'];

// Insertar en info_entregainfo
$sentencia = $pdo->prepare("INSERT INTO info_entregainfo (id_trabajador, id_infodoc, fechaentrega) 
VALUES(:id_trabajador, :id_infodoc, :fechaentrega)");

$sentencia->bindParam(':id_trabajador', $id_trabajador);    
$sentencia->bindParam(':id_infodoc', $id_infodoc);
$sentencia->bindParam(':fechaentrega', $fechaentrega);

if ($sentencia->execute()) {

    // Verificar si ya existe en informacion_trabajador
    $checkExists = $pdo->prepare("
        SELECT COUNT(*) FROM informacion_trabajador 
        WHERE id_trabajador = :id_trabajador AND id_infodoc = :id_infodoc
    ");
    $checkExists->bindParam(':id_trabajador', $id_trabajador);
    $checkExists->bindParam(':id_infodoc', $id_infodoc);
    $checkExists->execute();
    $exists = $checkExists->fetchColumn();

    if ($exists > 0) {
        $update = $pdo->prepare("
            UPDATE informacion_trabajador
            SET fecha_completado = :fecha, estado = 'Completado'
            WHERE id_trabajador = :id_trabajador AND id_infodoc = :id_infodoc
        ");
    } else {
        $update = $pdo->prepare("
            INSERT INTO informacion_trabajador (id_trabajador, id_infodoc, fecha_asignacion, fecha_completado, estado)
            VALUES (:id_trabajador, :id_infodoc, :fecha, :fecha, 'Completado')
        ");
    }

    $update->bindParam(':id_trabajador', $id_trabajador);
    $update->bindParam(':id_infodoc', $id_infodoc);
    $update->bindParam(':fecha', $fechaentrega);
    $update->execute();

    // 💡 NUEVA PARTE: Comprobar si el documento es tipo "puesto de trabajo"
    $consultaTipo = $pdo->prepare("
        SELECT tipoinfo_ifd FROM info_documentos WHERE id_infodoc = :id_infodoc
    ");
    $consultaTipo->bindParam(':id_infodoc', $id_infodoc);
    $consultaTipo->execute();
    $resultado = $consultaTipo->fetch(PDO::FETCH_ASSOC);

    if ($resultado && strtolower(trim($resultado['tipoinfo_ifd'])) == 'puesto de trabajo') {
        // Si es tipo "puesto de trabajo", actualizamos el campo informacion_tr a 'Si'
        $actualizaTrabajador = $pdo->prepare("
            UPDATE trabajadores
            SET informacion_tr = 'Si'
            WHERE id_trabajador = :id_trabajador
        ");
        $actualizaTrabajador->bindParam(':id_trabajador', $id_trabajador);
        $actualizaTrabajador->execute();
    }

    // Mensaje OK
    session_start();
    $_SESSION['mensaje'] = "Formación registrada correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . "/admin/trabajadores/trabajadorshow.php?id_trabajador=".$id_trabajador);
} else {
    session_start();
    $_SESSION['mensaje'] = "Formación NO creada";
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . "/admin/trabajadores/trabajadorshow.php?id_trabajador=".$id_trabajador);
}
?>
