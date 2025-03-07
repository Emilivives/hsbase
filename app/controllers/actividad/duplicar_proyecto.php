<?php

include('../../../app/config.php');

// Obtener el ID del proyecto que deseas duplicar y validar entrada
$id_proyecto_original = filter_input(INPUT_GET, 'id_proyecto', FILTER_VALIDATE_INT);

if (!$id_proyecto_original) {
    session_start();
    $_SESSION['mensaje'] = "ID de proyecto no válido";
    $_SESSION['icono'] = 'error';
    header("Location: " . $URL . "/admin/actividad/proyectos.php");
    exit();
}

try {
    // Iniciar transacción
    $pdo->beginTransaction();

    // Paso 1: Obtener datos del proyecto original
    $query_proyecto = $pdo->prepare("SELECT * FROM ag_proyecto WHERE id_proyecto = :id_proyecto");
    $query_proyecto->bindParam(':id_proyecto', $id_proyecto_original);
    $query_proyecto->execute();
    $proyecto = $query_proyecto->fetch(PDO::FETCH_ASSOC);

    if (!$proyecto) {
        throw new Exception("Proyecto original no encontrado");
    }

    // Agregar "- copy" al nombre del proyecto
    $nuevo_nombre = $proyecto['nombre_py'] . " - copy";

    // Si ya contiene "- copy", asegurarnos de que no se duplique en exceso
    while (true) {
        $query_nombre = $pdo->prepare("SELECT COUNT(*) FROM ag_proyecto WHERE nombre_py = :nombre_py");
        $query_nombre->bindParam(':nombre_py', $nuevo_nombre);
        $query_nombre->execute();
        $existe = $query_nombre->fetchColumn();

        if ($existe > 0) {
            // Si existe un proyecto con el mismo nombre, agregar un sufijo numérico
            $nuevo_nombre = $nuevo_nombre . " (" . rand(100, 999) . ")";
        } else {
            break;
        }
    }

    // Paso 2: Crear el proyecto duplicado (sin duplicar el ID único)
    $sentencia_proyecto = $pdo->prepare("
        INSERT INTO ag_proyecto (nombre_py, empresa_py, responsable_py, descripcion_py, estado_py, fechainicio_py, fechafin_py) 
        VALUES (:nombre_py, :empresa_py, :responsable_py, :descripcion_py, :estado_py, :fechainicio_py, :fechafin_py)
    ");
    $sentencia_proyecto->bindParam(':nombre_py', $nuevo_nombre);
    $sentencia_proyecto->bindParam(':empresa_py', $proyecto['empresa_py']);
    $sentencia_proyecto->bindParam(':responsable_py', $proyecto['responsable_py']);
    $sentencia_proyecto->bindParam(':descripcion_py', $proyecto['descripcion_py']);
    $sentencia_proyecto->bindParam(':estado_py', $proyecto['estado_py']);
    $sentencia_proyecto->bindParam(':fechainicio_py', $proyecto['fechainicio_py']);
    $sentencia_proyecto->bindParam(':fechafin_py', $proyecto['fechafin_py']);
    $sentencia_proyecto->execute();

    // Obtener el ID del nuevo proyecto creado
    $id_proyecto_nuevo = $pdo->lastInsertId();

    // Paso 3: Duplicar tareas asociadas
    $query_tareas = $pdo->prepare("SELECT * FROM ag_tareas WHERE id_proyecto = :id_proyecto");
    $query_tareas->bindParam(':id_proyecto', $id_proyecto_original);
    $query_tareas->execute();
    $tareas = $query_tareas->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tareas as $tarea) {
        $fechareal = '0001-01-01';
        $estado = 'En curso';
        $sentencia_tarea = $pdo->prepare("
            INSERT INTO ag_tareas (id_proyecto, nombre_ta, fecha_ta, fechareal_ta, centro_ta, responsable_ta, prioridad_ta, estado_ta, programada_ta, detalles_ta, categoria_ta, accionprl_ta) 
            VALUES (:id_proyecto, :nombre_ta, :fecha_ta, :fechareal_ta, :centro_ta, :responsable_ta, :prioridad_ta, :estado_ta, :programada_ta, :detalles_ta, :categoria_ta, :accionprl_ta)
        ");
        $sentencia_tarea->bindParam(':id_proyecto', $id_proyecto_nuevo);
        $sentencia_tarea->bindParam(':nombre_ta', $tarea['nombre_ta']);
        $sentencia_tarea->bindParam(':fecha_ta', $tarea['fecha_ta']);
        $sentencia_tarea->bindParam(':fechareal_ta', $fechareal);
        $sentencia_tarea->bindParam(':centro_ta', $tarea['centro_ta']);
        $sentencia_tarea->bindParam(':responsable_ta', $tarea['responsable_ta']);
        $sentencia_tarea->bindParam(':prioridad_ta', $tarea['prioridad_ta']);
        $sentencia_tarea->bindParam(':estado_ta', $estado);
        $sentencia_tarea->bindParam(':programada_ta', $tarea['programada_ta']);
        $sentencia_tarea->bindParam(':detalles_ta', $tarea['detalles_ta']);
        $sentencia_tarea->bindParam(':categoria_ta', $tarea['categoria_ta']);
        $sentencia_tarea->bindParam(':accionprl_ta', $tarea['accionprl_ta']);
        $sentencia_tarea->execute();
    }

    // Confirmar la transacción
    $pdo->commit();

    // Redirigir con mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Proyecto duplicado correctamente como '$nuevo_nombre' con sus tareas";
    $_SESSION['icono'] = 'success';
    header("Location: " . $URL . "/admin/actividad/proyectos.php");
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error al duplicar proyecto: " . $e->getMessage();
    $_SESSION['icono'] = 'error';
    header("Location: " . $URL . "/admin/actividad/proyectos.php");
}

?>
