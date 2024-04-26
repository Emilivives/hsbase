<?php

$sql = "SELECT tr.id_trabajador as id_trabajador, tr.codigo_tr as codigo_tr, tr.dni_tr as dni_tr, tr.nombre_tr as nombre_tr, tr.sexo_tr as sexo_tr, tr.fechanac_tr as fechanac_tr, tr.inicio_tr as inicio_tr, 
tr.activo_tr as activo_tr, tr.formacionpdt_tr as formacionpdt_tr, tr.informacion_tr as informacion_tr, cat.nombre_cat as nombre_cat, cat.departamento_cat as departamento_cat, cen.nombre_cen as nombre_cen , emp.nombre_emp as nombre_emp, tc.nombre_tc as nombre_tc
FROM `trabajadores`as tr 
INNER JOIN `categorias` as cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN `centros` as cen ON tr.centro_tr = cen.id_centro
INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN `tipocentros` as tc ON cen.tipo_cen = tc.id_tipocentro
WHERE tr.formacionpdt_tr == 'Si'
ORDER BY tr.codigo_tr DESC";
$query = $pdo->prepare($sql);
$query ->execute();
$trabajadores = $query->fetchAll(PDO::FETCH_ASSOC);


// , emp.nombre_emp as nombre_emp 
// INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.nombre_emp