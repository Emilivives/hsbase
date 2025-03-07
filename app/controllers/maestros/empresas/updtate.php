<?php
include('../../../config.php');

$id_empresa = $_POST['id_empresa'];
$nombre_emp = $_POST['nombre_emp'];
$razonsocial_emp = $_POST['razonsocial_emp'];
$cif_emp = $_POST['cif_emp'];
$direccion_emp = $_POST['direccion_emp'];
$modalidadprl_emp = $_POST['modalidadprl_emp'];
$logo_actual = $_POST['logo_actual']; // Imagen actual en la BD

// Verificar si se subió una nueva imagen
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Ruta donde se guardará la imagen
    $nombreDelArchivo = date("Y-m-d-h-i-s") . "__" . $_FILES['image']['name'];
    $location = "../../../../admin/maestros/centros/img/" . $nombreDelArchivo;
    
    // Mover la imagen al servidor
    if (move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
        // Eliminar la imagen anterior si existe
        if (!empty($logo_actual) && file_exists("../../../../admin/maestros/centros/img/" . $logo_actual)) {
            unlink("../../../../admin/maestros/centros/img/" . $logo_actual);
        }
        // Actualizar la variable con el nuevo nombre de imagen
        $logo_emp = $nombreDelArchivo;
    } else {
        $logo_emp = $logo_actual; // Si hay error al subir, mantener la imagen anterior
    }
} else {
    $logo_emp = $logo_actual; // Si no se subió una nueva imagen, mantener la actual
}

// Actualizar en la base de datos
$sentencia = $pdo->prepare("UPDATE empresa SET 
    nombre_emp=:nombre_emp,
    razonsocial_emp=:razonsocial_emp,
    cif_emp=:cif_emp,
    direccion_emp=:direccion_emp,
    modalidadprl_emp=:modalidadprl_emp,
    logo_emp=:logo_emp
    WHERE id_empresa = :id_empresa");

$sentencia->bindParam(':id_empresa', $id_empresa);
$sentencia->bindParam(':nombre_emp', $nombre_emp);
$sentencia->bindParam(':razonsocial_emp', $razonsocial_emp);
$sentencia->bindParam(':cif_emp', $cif_emp);
$sentencia->bindParam(':direccion_emp', $direccion_emp);
$sentencia->bindParam(':modalidadprl_emp', $modalidadprl_emp);
$sentencia->bindParam(':logo_emp', $logo_emp);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la empresa correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/admin/maestros/centros/index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/admin/maestros/centros/updateempresa.php?id=' . $id_empresa);
}
?>