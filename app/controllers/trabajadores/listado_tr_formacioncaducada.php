<?php 
$sql = "SELECT 
tr.id_trabajador AS id_trabajador, 
tr.codigo_tr AS codigo_tr, 
tr.dni_tr AS dni_tr, 
tr.nombre_tr AS nombre_tr, 
tr.sexo_tr AS sexo_tr, 
tr.fechanac_tr AS fechanac_tr, 
tr.inicio_tr AS inicio_tr, 
tr.activo_tr AS activo_tr, 
tr.formacionpdt_tr AS formacionpdt_tr, 
tr.informacion_tr AS informacion_tr, 
cat.nombre_cat AS nombre_cat, 
cat.departamento_cat AS departamento_cat, 
cen.nombre_cen AS nombre_cen, 
emp.nombre_emp AS nombre_emp, 
tc.nombre_tc AS nombre_tc,
fr.fechacad_fr as fechacad_fr,
MAX(fr.fechacad_fr) AS ult_fecha_cad
FROM trabajadores tr 
INNER JOIN form_asistencia fas ON tr.id_trabajador = fas.idtrabajador_fas
INNER JOIN formacion fr ON fas.nroformacion = fr.nroformacion
INNER JOIN tipoformacion tf ON fr.tipo_fr = tf.id_tipoformacion
INNER JOIN categorias cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN centros cen ON tr.centro_tr = cen.id_centro
INNER JOIN empresa emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN tipocentros tc ON cen.tipo_cen = tc.id_tipocentro
WHERE tr.activo_tr = 1
AND tf.art19_tf = 1
GROUP BY tr.id_trabajador
HAVING MAX(fr.fechacad_fr) < DATE_ADD(CURDATE(), INTERVAL 12 MONTH)
ORDER BY tr.codigo_tr DESC";


$query = $pdo->prepare($sql);
$query ->execute();
$trabajadores_formacioncaducada = $query->fetchAll(PDO::FETCH_ASSOC);

