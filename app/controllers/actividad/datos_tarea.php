<?php 
$sql = "SELECT ta.*, 
               py.nombre_py as nombre_py, 
               cen.id_centro as id_centro, cen.nombre_cen as nombre_cen, 
               cen.empresa_cen as id_empresa, -- Se añade el ID de la empresa
               resp.nombre_resp as nombre_resp, 
               acc.codigo_acc as codigo_acc 
        FROM ag_tareas as ta 
        INNER JOIN ag_proyecto as py ON ta.id_proyecto = py.id_proyecto 
        INNER JOIN centros as cen ON ta.centro_ta = cen.id_centro 
        INNER JOIN responsables as resp ON ta.responsable_ta = resp.id_responsable 
        INNER JOIN ag_acciones as acc ON ta.accionprl_ta = acc.id_accion 
        WHERE ta.id_tarea = :id_tarea";

$query = $pdo->prepare($sql);
$query->bindParam(':id_tarea', $id_tarea, PDO::PARAM_INT);
$query->execute();
$tarea = $query->fetch(PDO::FETCH_ASSOC);

// Variables con los datos recuperados
$id_proyecto = $tarea['id_proyecto'];
$proyecto_ta = $tarea['nombre_py'];
$nombre_ta = $tarea['nombre_ta'];
$fecha_ta = $tarea['fecha_ta'];
$fechareal_ta = $tarea['fechareal_ta'];
$id_centro_ta = $tarea['id_centro']; // Se guarda el ID del centro
$centro_ta = $tarea['nombre_cen'];
$id_empresa_ta = $tarea['id_empresa']; // Se guarda el ID de la empresa
$responsable_ta = $tarea['nombre_resp'];
$prioridad_ta = $tarea['prioridad_ta'];
$estado_ta = $tarea['estado_ta'];
$programada_ta = $tarea['programada_ta'];
$detalles_ta = $tarea['detalles_ta'];
$categoria_ta = $tarea['categoria_ta'];
$accionprl_ta = $tarea['codigo_acc'];
