<?php

include('../../../app/config.php');



$sql = "SELECT id_accidente,nroaccidente_ace,trabajador_ace,centro_ace,lugar_ace,detalleslugar_ace,tipoaccidente_ace,fecha_ace,fechabaja_ace,hora_ace,horatrabajo_ace,trabajohabitual_ace,diadescanso_ace,semanadescanso_ace,isevaluadoriesgo_ace,evalconriesgo_ace,isrecaida_ace,fechaantesrecaida_ace,descripcion_ace,tipolugar_ace,zonalugar_ace,observaclugar_ace,procesotrabajo_ace,observproceso_ace,tipoactividad_ace,observtipoactiv_ace,agentematerial_ace,observagmaterial_ace,desviacion_ace,observdesviacion_ace,agmaterdesv_ace,observagendesv_ace,formacontacto_ace,observformacont_ace,matercasusalesi_ace,observmatlesi_ace,numtrafectados_ace,declaraciontrab_ace,istestigos_ace,detallestestigo_ace,declaraciontestigo_ace,tipolesion_ace,gradolesion_ace,partecuerpo_ace,isevacuacion_ace,lugarevacuacion_ace,centromedico_ace,detallescentromed_ace,recomedincorp_ace,recinedtrab_ace,istrformado_ace,istrinformado_ace,protcolectivadisp_ace,protcolecnecesa_ace,observprotcol_ace,episdispon_ace,episneces_ace,observepis_ace,causaaccidente_ace,porquecausa_ace,quiencontrolcausa_ace,conclusionacci_ace,medidasprev_ace,valoracionmedida_ace,histaccult12mes_ace,histpuestoacc_ace,histtrabajosreal_ace,histcausaacc_ace,histmedidaacc_ace,investigador_ace,cargoinvesiga_ace,fechainvestiga_ace,fechacumplimen_ace,revisadopor_ace,cargorevisado_ace,fecharevision_ace)
FROM `accidentes`as ace 
INNER JOIN `trabajadores` as tr ON ace.trabajador_ace = tr.id_trabajador
INNER JOIN `centros` as cen ON ace.centro_ace = cen.id_centro
INNER JOIN `empresa` as emp ON cen.empresa_cen = emp.id_empresa
INNER JOIN `ace_tipoaccidente` as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
INNER JOIN `ace_tipolesion` as tl ON ace.tipolesion_ace = tl.id_tipolesion
INNER JOIN `ace_gravedad` as gr ON ace.gradolesion_ace = gr.id_gravedad
ORDER BY ace.fecha_ace DESC";
$query = $pdo->prepare($sql);
$query->execute();
$accidente_datos = $query->fetchAll(PDO::FETCH_ASSOC);

$id_accidente = NULL;
$nroaccidente_ace = $_POST['nroaccidente_ace'];
$trabajador_ace = $_POST['trabajador_ace'];
$centro_ace = $_POST['centro_ace'];
$lugar_ace = $_POST['lugar_ace'];
$detalleslugar_ace = $_POST['detalleslugar_ace'];
$tipoaccidente_ace = $_POST['tipoaccidente_ace'];
$fecha_ace = $_POST['fecha_ace'];
$fechabaja_ace = $_POST['fechabaja_ace'];
$hora_ace = $_POST['hora_ace'];
$horatrabajo_ace = $_POST['horatrabajo_ace'];
$trabajohabitual_ace = $_POST['trabajohabitual_ace'];
$diadescanso_ace = $_POST['diadescanso_ace'];
$semanadescanso_ace = $_POST['semanadescanso_ace'];
$isevaluadoriesgo_ace = $_POST['isevaluadoriesgo_ace'];
$evalconriesgo_ace = $_POST['evalconriesgo_ace'];
$isrecaida_ace = $_POST['isrecaida_ace'];
$fechaantesrecaida_ace = $_POST['fechaantesrecaida_ace'];
$descripcion_ace = $_POST['descripcion_ace'];
$tipolugar_ace = $_POST['tipolugar_ace'];
$zonalugar_ace = $_POST['zonalugar_ace'];
$observaclugar_ace = $_POST['observaclugar_ace'];
$procesotrabajo_ace = $_POST['procesotrabajo_ace'];
$observproceso_ace = $_POST['observproceso_ace'];
$tipoactividad_ace = $_POST['tipoactividad_ace'];
$observtipoactiv_ace = $_POST['observtipoactiv_ace'];
$agentematerial_ace = $_POST['agentematerial_ace'];
$observagmaterial_ace = $_POST['observagmaterial_ace'];
$desviacion_ace = $_POST['desviacion_ace'];
$observdesviacion_ace = $_POST['observdesviacion_ace'];
$agmaterdesv_ace = $_POST['agmaterdesv_ace'];
$observagendesv_ace = $_POST['observagendesv_ace'];
$formacontacto_ace = $_POST['formacontacto_ace'];
$observformacont_ace = $_POST['observformacont_ace'];
$matercasusalesi_ace = $_POST['matercasusalesi_ace'];
$observmatlesi_ace = $_POST['observmatlesi_ace'];
$numtrafectados_ace = $_POST['numtrafectados_ace'];
$declaraciontrab_ace = $_POST['declaraciontrab_ace'];
$istestigos_ace = $_POST['istestigos_ace'];
$detallestestigo_ace = $_POST['detallestestigo_ace'];
$declaraciontestigo_ace = $_POST['declaraciontestigo_ace'];
$tipolesion_ace = $_POST['tipolesion_ace'];
$gradolesion_ace = $_POST['gradolesion_ace'];
$partecuerpo_ace = $_POST['partecuerpo_ace'];
$isevacuacion_ace = $_POST['isevacuacion_ace'];
$lugarevacuacion_ace = $_POST['lugarevacuacion_ace'];
$centromedico_ace = $_POST['centromedico_ace'];
$detallescentromed_ace = $_POST['detallescentromed_ace'];
$recomedincorp_ace = $_POST['recomedincorp_ace'];
$recinedtrab_ace = $_POST['recinedtrab_ace'];
$istrformado_ace = $_POST['istrformado_ace'];
$istrinformado_ace = $_POST['istrinformado_ace'];
$protcolectivadisp_ace = $_POST['protcolectivadisp_ace'];
$protcolecnecesa_ace = $_POST['protcolecnecesa_ace'];
$observprotcol_ace = $_POST['observprotcol_ace'];
$episdispon_ace = $_POST['episdispon_ace'];
$episneces_ace = $_POST['episneces_ace'];
$observepis_ace = $_POST['observepis_ace'];
$causaaccidente_ace = $_POST['causaaccidente_ace'];
$porquecausa_ace = $_POST['porquecausa_ace'];
$quiencontrolcausa_ace = $_POST['quiencontrolcausa_ace'];
$conclusionacci_ace = $_POST['conclusionacci_ace'];
$medidasprev_ace = $_POST['medidasprev_ace'];
$valoracionmedida_ace = $_POST['valoracionmedida_ace'];
$histaccult12mes_ace = $_POST['histaccult12mes_ace'];
$histpuestoacc_ace = $_POST['histpuestoacc_ace'];
$histtrabajosreal_ace = $_POST['histtrabajosreal_ace'];
$histcausaacc_ace = $_POST['histcausaacc_ace'];
$histmedidaacc_ace = $_POST['histmedidaacc_ace'];
$investigador_ace = $_POST['investigador_ace'];
$cargoinvesiga_ace = $_POST['cargoinvesiga_ace'];
$fechainvestiga_ace = $_POST['fechainvestiga_ace'];
$fechacumplimen_ace = $_POST['fechacumplimen_ace'];
$revisadopor_ace = $_POST['revisadopor_ace'];
$cargorevisado_ace = $_POST['cargorevisado_ace'];
$fecharevision_ace = $_POST['fecharevision_ace'];

    ?>