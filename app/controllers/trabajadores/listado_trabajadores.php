<?php
// Primero, obtenemos los datos de los trabajadores como ya lo estás haciendo
$sql = "SELECT tr.id_trabajador as id_trabajador, tr.codigo_tr as codigo_tr, 
        tr.dni_tr as dni_tr, tr.nombre_tr as nombre_tr, tr.sexo_tr as sexo_tr, 
        tr.fechanac_tr as fechanac_tr, tr.inicio_tr as inicio_tr,  
        tr.activo_tr as activo_tr, tr.formacionpdt_tr as formacionpdt_tr, 
        tr.informacion_tr as informacion_tr, cat.nombre_cat as nombre_cat, 
        dpo.nombre_dpo as nombre_dpo, cat.departamento_cat as departamento_cat,  
        cen.nombre_cen as nombre_cen, emp.nombre_emp as nombre_emp, 
        tc.nombre_tc as nombre_tc 
        FROM trabajadores as tr  
        INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria 
        INNER JOIN departamentos as dpo ON cat.departamento_cat = dpo.id_departamento 
        INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro 
        INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa 
        INNER JOIN tipocentros as tc ON cen.tipo_cen = tc.id_tipocentro 
        ORDER BY tr.codigo_tr DESC";

$query = $pdo->prepare($sql);
$query->execute();
$trabajadores = $query->fetchAll(PDO::FETCH_ASSOC);

// Ahora, para cada trabajador, obtenemos sus formaciones e información PRL
foreach ($trabajadores as &$trabajador) {
    // Obtener formaciones del trabajador
    $sql_formaciones = "SELECT f.id_tipoformacion, tf.nombre_tf 
                       FROM formacion_trabajador f
                       JOIN tipoformacion tf ON f.id_tipoformacion = tf.id_tipoformacion
                       WHERE f.id_trabajador = :id";
    
    $stmt_formaciones = $pdo->prepare($sql_formaciones);
    $stmt_formaciones->execute([':id' => $trabajador['id_trabajador']]);
    $trabajador['formaciones'] = $stmt_formaciones->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener información PRL del trabajador
    $sql_info_prl = "SELECT id_infodoc FROM informacion_trabajador WHERE id_trabajador = :id";
    $stmt_info_prl = $pdo->prepare($sql_info_prl);
    $stmt_info_prl->execute([':id' => $trabajador['id_trabajador']]);
    $trabajador['info_prl'] = $stmt_info_prl->fetchAll(PDO::FETCH_COLUMN, 0); // Solo obtenemos los IDs
    
    // Si quieres también obtener los nombres de las info PRL, podrías hacer:
    if (!empty($trabajador['info_prl'])) {
        $placeholders = implode(',', array_fill(0, count($trabajador['info_prl']), '?'));
        $sql_info_prl_nombres = "SELECT id_infodoc, nombre_ifd FROM info_documentos WHERE id_infodoc IN ($placeholders)";
        $stmt_info_prl_nombres = $pdo->prepare($sql_info_prl_nombres);
        $stmt_info_prl_nombres->execute($trabajador['info_prl']);
        $trabajador['info_prl_detalles'] = $stmt_info_prl_nombres->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $trabajador['info_prl_detalles'] = [];
    }
}
unset($trabajador); // Importante para evitar problemas con la referencia
?>