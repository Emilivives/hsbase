<?php 
$sql_info_documentos_tr="SELECT *, tr.nombre_tr as nombre_tr, tr.dni_tr as dni_tr, ifd.nombre_ifd as nombre_ifd, ef.fechaentrega as fechaentrega, emp.logo_emp as logo_emp
FROM info_entregainfo as ef 
INNER JOIN info_documentos as ifd ON ef.id_infodoc = ifd.id_infodoc 
INNER JOIN trabajadores as tr ON ef.id_trabajador = tr.id_trabajador 
INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro 
INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
WHERE ef.id_trabajador = $id_trabajador";
$query_info_documentos_tr = $pdo->prepare($sql_info_documentos_tr);
$query_info_documentos_tr->execute();
$info_documentos_datos_tr = $query_info_documentos_tr->fetchAll(PDO::FETCH_ASSOC);