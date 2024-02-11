<?php

$id_accidente = $_GET['id_accidente'];


$sql = "SELECT ace.id_accidente as id_accidente, 
ace.nroaccidente_ace as nroaccidente_ace, pt.procesotrabajo_pt as procesotrabajo_pt, ace.comunicado_ace as comunicado_ace,
tr.nombre_tr as nombre_tr, tr.dni_tr as dni_tr, tr.sexo_tr as sexo_tr, tr.fechanac_tr as fechanac_tr, tr.inicio_tr as inicio_tr, cat.nombre_cat as nombre_cat, cat.departamento_cat as departamento_cat, 
cen.nombre_cen as nombre_cen, emp.nombre_emp as nombre_emp, emp.razonsocial_emp as razonsocial_emp, emp.modalidadprl_emp as modalidadprl_emp,
ace.lugar_ace as lugar_ace, ace.detalleslugar_ace as detalleslugar_ace, ta.tipoaccidente_ta as tipoaccidente_ta, 
ace.fecha_ace as fecha_ace, ace.fechabaja_ace as fechabaja_ace, ace.hora_ace as hora_ace, ace.horatrabajo_ace as horatrabajo_ace, 
ace.trabajohabitual_ace as trabajohabitual_ace, ace.diadescanso_ace as diadescanso_ace, ace.semanadescanso_ace as semanadescanso_ace, 
ace.isevaluadoriesgo_ace as isevaluadoriesgo_ace, ace.evalconriesgo_ace as evalconriesgo_ace, ace.isrecaida_ace as isrecaida_ace, 
ace.fechaantesrecaida_ace as fechaantesrecaida_ace, ace.descripcion_ace as descripcion_ace, tlu.tipolugar_tl as tipolugar_tl, 
ace.zonalugar_ace as zonalugar_ace, ace.observaclugar_ace as observaclugar_ace, pt.procesotrabajo_pt as procesotrabajo_pt, 
ace.observproceso_ace as observproceso_ace, af.activfisica_af as activfisica_af, ace.observtipoactiv_ace as observtipoactiv_ace, 
am.agentematerial_am as agentematerial_am, ace.observagmaterial_ace as observagmaterial_ace, ds.desviacion_des as desviacion_des, 
ace.observdesviacion_ace as observdesviacion_ace, amd.agentematerialdesv_amd as agentematerialdesv_amd, ace.observagendesv_ace as observagendesv_ace, fc.formacontacto_fc as formacontacto_fc, 
ace.observformacont_ace as observformacont_ace, aml.agentematerialles_aml as agentematerialles_aml, ace.observmatlesi_ace as observmatlesi_ace, ace.numtrafectados_ace as numtrafectados_ace, 
ace.declaraciontrab_ace as declaraciontrab_ace, ace.istestigos_ace as istestigos_ace, ace.detallestestigo_ace as detallestestigo_ace, 
ace.declaraciontestigo_ace as declaraciontestigo_ace, tl.tipolesion_tl as tipolesion_tl,gr.gravedad_gr as gravedad_gr, 
pc.partecuerpo_pc as partecuerpo_pc, ace.isevacuacion_ace as isevacuacion_ace, ace.lugarevacuacion_ace as lugarevacuacion_ace, 
ace.centromedico_ace as centromedico_ace, ace.detallescentromed_ace as detallescentromed_ace, ace.recomedincorp_ace as recomedincorp_ace, 
ace.recinedtrab_ace as recinedtrab_ace, ace.istrformado_ace as istrformado_ace, ace.istrinformado_ace as istrinformado_ace, 
ace.protcolectivadisp_ace as protcolectivadisp_ace, ace.protcolecnecesa_ace as protcolecnecesa_ace, ace.observprotcol_ace as observprotcol_ace, 
ace.episdispon_ace as episdispon_ace, ace.episneces_ace as episneces_ace, ace.observepis_ace as observepis_ace, 
ace.causaaccidente_ace as causaaccidente_ace, ace.porquecausa_ace as porquecausa_ace, ace.quiencontrolcausa_ace as quiencontrolcausa_ace, 
ace.conclusionacci_ace as conclusionacci_ace, ace.medidasprev_ace as medidasprev_ace, ace.valoracionmedida_ace as valoracionmedida_ace, 
ace.histaccult12mes_ace as histaccult12mes_ace, ace.histpuestoacc_ace as histpuestoacc_ace, ace.histtrabajosreal_ace as histtrabajosreal_ace, 
ace.histcausaacc_ace as histcausaacc_ace, ace.histmedidaacc_ace as histmedidaacc_ace, ace.investigador_ace as investigador_ace, 
ace.cargoinvesiga_ace as cargoinvesiga_ace, ace.fechainvestiga_ace as fechainvestiga_ace, ace.fechacumplimen_ace as fechacumplimen_ace, 
ace.revisadopor_ace as revisadopor_ace, ace.cargorevisado_ace as cargorevisado_ace, ace.fecharevision_ace as fecharevision_ace
FROM `accidentes`as ace 
INNER JOIN `trabajadores` as tr ON ace.trabajador_ace = tr.id_trabajador
INNER JOIN `categorias` as cat ON tr.categoria_tr = cat.id_categoria
INNER JOIN `centros` as cen ON ace.centro_ace = cen.id_centro
INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN `ace_procesotrabajo` as pt ON ace.procesotrabajo_ace = pt.id_procesotrabajo
INNER JOIN `ace_actividadfisica` as af ON ace.tipoactividad_ace = af.id_actividadfisica
INNER JOIN `ace_tipoaccidente` as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
INNER JOIN `ace_tipolesion` as tl ON ace.tipolesion_ace = tl.id_tipolesion
INNER JOIN `ace_tipolugar` as tlu ON ace.tipolugar_ace = tlu.id_tipolugar
INNER JOIN `ace_agentematerial` as am ON ace.agentematerial_ace = am.id_agentematerial
INNER JOIN `ace_agentematerialdesv` as amd ON ace.agmaterdesv_ace = amd.id_agentematerialdesv
INNER JOIN `ace_agentematerialles` as aml ON ace.matercasusalesi_ace = aml.id_agentematerialles
INNER JOIN `ace_formacontacto` as fc ON ace.formacontacto_ace = fc.id_formacontacto
INNER JOIN `ace_partecuerpo` as pc ON ace.partecuerpo_ace = pc.id_partecuerpo
INNER JOIN `ace_gravedad` as gr ON ace.gradolesion_ace = gr.id_gravedad
INNER JOIN `ace_desviacion` as ds ON ace.desviacion_ace = ds.id_desviacion
WHERE `id_accidente` = '$id_accidente'";

$query = $pdo->prepare($sql);
$query->execute();
$accidentes_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($accidentes_datos as $accidentes_dato) {
    $nroaccidente_ace = $accidentes_dato['nroaccidente_ace'];
    $comunicado_ace = $accidentes_dato['comunicado_ace'];
    $trabajador_ace = $accidentes_dato['nombre_tr'];
    $dni_trabajador_ace = $accidentes_dato['dni_tr'];
    $sexo_trabajador_ace = $accidentes_dato['sexo_tr'];
    $fechanac_trabajador_ace = $accidentes_dato['fechanac_tr'];
    $inicio_trabajador_ace = $accidentes_dato['inicio_tr'];
    $categoria_trabajador_ace = $accidentes_dato['nombre_cat'];
    $departamento_trabajador_ace = $accidentes_dato['departamento_cat'];
    $centro_ace = $accidentes_dato['nombre_cen'];
    $empresa_ace = $accidentes_dato['nombre_emp'];
    $razonsocial_ace = $accidentes_dato['razonsocial_emp'];
    $modalidadprl_ace = $accidentes_dato['modalidadprl_emp'];
    $lugar_ace = $accidentes_dato['lugar_ace'];
    $detalleslugar_ace = $accidentes_dato['detalleslugar_ace'];
    $tipoaccidente_ace = $accidentes_dato['tipoaccidente_ta'];
    $fecha_ace = $accidentes_dato['fecha_ace'];
    $fechabaja_ace = $accidentes_dato['fechabaja_ace'];
    $hora_ace = $accidentes_dato['hora_ace'];
    $horatrabajo_ace = $accidentes_dato['horatrabajo_ace'];
    $trabajohabitual_ace = $accidentes_dato['trabajohabitual_ace'];
    $diadescanso_ace = $accidentes_dato['diadescanso_ace'];
    $semanadescanso_ace = $accidentes_dato['semanadescanso_ace'];
    $isevaluadoriesgo_ace = $accidentes_dato['isevaluadoriesgo_ace'];
    $evalconriesgo_ace = $accidentes_dato['evalconriesgo_ace'];
    $isrecaida_ace = $accidentes_dato['isrecaida_ace'];
    $fechaantesrecaida_ace = $accidentes_dato['fechaantesrecaida_ace'];
    $descripcion_ace = $accidentes_dato['descripcion_ace'];
    $tipolugar_ace = $accidentes_dato['tipolugar_tl'];
    $zonalugar_ace = $accidentes_dato['zonalugar_ace'];
    $observaclugar_ace = $accidentes_dato['observaclugar_ace'];
    $procesotrabajo_ace = $accidentes_dato['procesotrabajo_pt'];
    $observproceso_ace = $accidentes_dato['observproceso_ace'];
    $tipoactividad_ace = $accidentes_dato['activfisica_af'];
    $observtipoactiv_ace = $accidentes_dato['observtipoactiv_ace'];
    $agentematerial_ace = $accidentes_dato['agentematerial_am'];
    $observagmaterial_ace = $accidentes_dato['observagmaterial_ace'];
    $desviacion_ace = $accidentes_dato['desviacion_des'];
    $observdesviacion_ace = $accidentes_dato['observdesviacion_ace'];
    $agmaterdesv_ace = $accidentes_dato['agentematerialdesv_amd'];
    $observagendesv_ace = $accidentes_dato['observagendesv_ace'];
    $formacontacto_ace = $accidentes_dato['formacontacto_fc'];
    $observformacont_ace = $accidentes_dato['observformacont_ace'];
    $matercasusalesi_ace = $accidentes_dato['agentematerialles_aml'];
    $observmatlesi_ace = $accidentes_dato['observmatlesi_ace'];
    $numtrafectados_ace = $accidentes_dato['numtrafectados_ace'];
    $declaraciontrab_ace = $accidentes_dato['declaraciontrab_ace'];
    $istestigos_ace = $accidentes_dato['istestigos_ace'];
    $detallestestigo_ace = $accidentes_dato['detallestestigo_ace'];
    $declaraciontestigo_ace = $accidentes_dato['declaraciontestigo_ace'];
    $tipolesion_ace = $accidentes_dato['tipolesion_tl'];
    $gradolesion_ace = $accidentes_dato['gravedad_gr'];
    $partecuerpo_ace = $accidentes_dato['partecuerpo_pc'];
    $isevacuacion_ace = $accidentes_dato['isevacuacion_ace'];
    $lugarevacuacion_ace = $accidentes_dato['lugarevacuacion_ace'];
    $centromedico_ace = $accidentes_dato['centromedico_ace'];
    $detallescentromed_ace = $accidentes_dato['detallescentromed_ace'];
    $recomedincorp_ace = $accidentes_dato['recomedincorp_ace'];
    $recinedtrab_ace = $accidentes_dato['recinedtrab_ace'];
    $istrformado_ace = $accidentes_dato['istrformado_ace'];
    $istrinformado_ace = $accidentes_dato['istrinformado_ace'];
    $protcolectivadisp_ace = $accidentes_dato['protcolectivadisp_ace'];
    $protcolecnecesa_ace = $accidentes_dato['protcolecnecesa_ace'];
    $observprotcol_ace = $accidentes_dato['observprotcol_ace'];
    $episdispon_ace = $accidentes_dato['episdispon_ace'];
    $episneces_ace = $accidentes_dato['episneces_ace'];
    $observepis_ace = $accidentes_dato['observepis_ace'];
    $causaaccidente_ace = $accidentes_dato['causaaccidente_ace'];
    $porquecausa_ace = $accidentes_dato['porquecausa_ace'];
    $quiencontrolcausa_ace = $accidentes_dato['quiencontrolcausa_ace'];
    $conclusionacci_ace = $accidentes_dato['conclusionacci_ace'];
    $medidasprev_ace = $accidentes_dato['medidasprev_ace'];
    $valoracionmedida_ace = $accidentes_dato['valoracionmedida_ace'];
    $histaccult12mes_ace = $accidentes_dato['histaccult12mes_ace'];
    $histpuestoacc_ace = $accidentes_dato['histpuestoacc_ace'];
    $histtrabajosreal_ace = $accidentes_dato['histtrabajosreal_ace'];
    $histcausaacc_ace = $accidentes_dato['histcausaacc_ace'];
    $histmedidaacc_ace = $accidentes_dato['histmedidaacc_ace'];
    $investigador_ace = $accidentes_dato['investigador_ace'];
    $cargoinvesiga_ace = $accidentes_dato['cargoinvesiga_ace'];
    $fechainvestiga_ace = $accidentes_dato['fechainvestiga_ace'];
    $fechacumplimen_ace = $accidentes_dato['fechacumplimen_ace'];
    $revisadopor_ace = $accidentes_dato['revisadopor_ace'];
    $cargorevisado_ace = $accidentes_dato['cargorevisado_ace'];
    $fecharevision_ace = $accidentes_dato['fecharevision_ace'];
}
