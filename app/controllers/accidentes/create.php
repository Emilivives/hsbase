<?php

include('../../../app/config.php');

$nroaccidente_ace = $_POST['nroaccidente_ace'];
$comunicado_ace =  $_POST['comunicado_ace'];
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
$diasbaja_ace = $_POST['diasbaja_ace'];
$isevaluadoriesgo_ace = $_POST['isevaluadoriesgo_ace'];
$evalconriesgo_ace = $_POST['evalconriesgo_ace'];
$isrecaida_ace = $_POST['isrecaida_ace'];
$fechaantesrecaida_ace = $_POST['fechaantesrecaida_ace'];
$descripcion_ace = $_POST['descripcion_ace'];

$tipolugar_ace = !empty($_POST['tipolugar_ace']) ? $_POST['tipolugar_ace'] : NULL;

$zonalugar_ace = $_POST['zonalugar_ace'];
$observaclugar_ace = $_POST['observaclugar_ace'];

$procesotrabajo_ace = !empty($_POST['procesotrabajo_ace']) ? $_POST['procesotrabajo_ace'] : NULL;

$observproceso_ace = $_POST['observproceso_ace'];

$tipoactividad_ace = !empty($_POST['tipoactividad_ace']) ? $_POST['tipoactividad_ace'] : NULL;

$observtipoactiv_ace = $_POST['observtipoactiv_ace'];

$agentematerial_ace = !empty($_POST['agentematerial_ace']) ? $_POST['agentematerial_ace'] : NULL;

$observagmaterial_ace = $_POST['observagmaterial_ace'];

$desviacion_ace = !empty($_POST['desviacion_ace']) ? $_POST['desviacion_ace'] : NULL;
$observdesviacion_ace = $_POST['observdesviacion_ace'];

$agmaterdesv_ace = !empty($_POST['agmaterdesv_ace']) ? $_POST['agmaterdesv_ace'] : NULL;
$observagendesv_ace = $_POST['observagendesv_ace'];

$formacontacto_ace = !empty($_POST['formacontacto_ace']) ? $_POST['formacontacto_ace'] : NULL;
$observformacont_ace = $_POST['observformacont_ace'];

$matercasusalesi_ace = !empty($_POST['matercasusalesi_ace']) ? $_POST['matercasusalesi_ace'] : NULL;
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


// Comprova si està buit
if (empty($fechabaja_ace)) {
    $fechabaja_ace = null;
}
if (empty($fechaantesrecaida_ace)) {
    $fechaantesrecaida_ace = null;
}
if (empty($recomedincorp_ace)) {
    $recomedincorp_ace = null;
}
if (empty($recinedtrab_ace)) {
    $recinedtrab_ace = null;
}
if (empty($recomedincorp_ace)) {
    $recomedincorp_ace = null;
}
if (empty($fechacumplimen_ace)) {
    $fechacumplimen_ace = null;
}
if (empty($fechainvestiga_ace)) {
    $fechainvestiga_ace = null;
}
if (empty($fecharevision_ace)) {
    $fecharevision_ace = null;
}
if (empty($tipolugar_ace)) {
    $tipolugar = null;
}


if (empty($hora_ace)) {
    $hora_ace = null;
}
if (empty($diasbaja_ace)) {
    $diasbaja_ace = 0;
}

if($numtrafectados_ace = "-"){
$numtrafectados_ace = null;
}



$sentencia = $pdo->prepare("INSERT INTO accidentes (nroaccidente_ace, comunicado_ace, trabajador_ace, centro_ace, lugar_ace, detalleslugar_ace, tipoaccidente_ace, fecha_ace, fechabaja_ace, hora_ace, horatrabajo_ace, trabajohabitual_ace, diadescanso_ace, semanadescanso_ace, diasbaja_ace, isevaluadoriesgo_ace, evalconriesgo_ace, isrecaida_ace, fechaantesrecaida_ace, descripcion_ace, tipolugar_ace, zonalugar_ace, observaclugar_ace, procesotrabajo_ace, observproceso_ace, tipoactividad_ace, observtipoactiv_ace, agentematerial_ace, observagmaterial_ace, desviacion_ace, observdesviacion_ace, agmaterdesv_ace, observagendesv_ace, formacontacto_ace, observformacont_ace, matercasusalesi_ace, observmatlesi_ace, numtrafectados_ace, declaraciontrab_ace, istestigos_ace, detallestestigo_ace, declaraciontestigo_ace, tipolesion_ace, gradolesion_ace, partecuerpo_ace, isevacuacion_ace, lugarevacuacion_ace, centromedico_ace, detallescentromed_ace, recomedincorp_ace, recinedtrab_ace, istrformado_ace, istrinformado_ace, protcolectivadisp_ace, protcolecnecesa_ace, observprotcol_ace, episdispon_ace, episneces_ace, observepis_ace, causaaccidente_ace, porquecausa_ace, quiencontrolcausa_ace, conclusionacci_ace, medidasprev_ace, valoracionmedida_ace, histaccult12mes_ace, histpuestoacc_ace, histtrabajosreal_ace, histcausaacc_ace, histmedidaacc_ace, investigador_ace, cargoinvesiga_ace, fechainvestiga_ace, fechacumplimen_ace, revisadopor_ace, cargorevisado_ace, fecharevision_ace)
VALUES (:nroaccidente_ace, :comunicado_ace, :trabajador_ace, :centro_ace, :lugar_ace, :detalleslugar_ace, :tipoaccidente_ace,:fecha_ace, :fechabaja_ace, :hora_ace, :horatrabajo_ace, :trabajohabitual_ace, :diadescanso_ace, :semanadescanso_ace, :diasbaja_ace, :isevaluadoriesgo_ace, :evalconriesgo_ace, :isrecaida_ace, :fechaantesrecaida_ace, :descripcion_ace, :tipolugar_ace, :zonalugar_ace, :observaclugar_ace, :procesotrabajo_ace, :observproceso_ace, :tipoactividad_ace, :observtipoactiv_ace, :agentematerial_ace, :observagmaterial_ace, :desviacion_ace, :observdesviacion_ace, :agmaterdesv_ace, :observagendesv_ace, :formacontacto_ace, :observformacont_ace, :matercasusalesi_ace, :observmatlesi_ace, :numtrafectados_ace, :declaraciontrab_ace, :istestigos_ace, :detallestestigo_ace, :declaraciontestigo_ace, :tipolesion_ace, :gradolesion_ace, :partecuerpo_ace, :isevacuacion_ace, :lugarevacuacion_ace, :centromedico_ace, :detallescentromed_ace, :recomedincorp_ace, :recinedtrab_ace, :istrformado_ace, :istrinformado_ace, :protcolectivadisp_ace, :protcolecnecesa_ace, :observprotcol_ace, :episdispon_ace, :episneces_ace, :observepis_ace, :causaaccidente_ace, :porquecausa_ace, :quiencontrolcausa_ace, :conclusionacci_ace, :medidasprev_ace, :valoracionmedida_ace, :histaccult12mes_ace, :histpuestoacc_ace, :histtrabajosreal_ace, :histcausaacc_ace, :histmedidaacc_ace, :investigador_ace, :cargoinvesiga_ace, :fechainvestiga_ace, :fechacumplimen_ace, :revisadopor_ace, :cargorevisado_ace, :fecharevision_ace)");

$sentencia->bindParam(':nroaccidente_ace',$nroaccidente_ace);
$sentencia->bindParam(':comunicado_ace',$comunicado_ace);
$sentencia->bindParam(':trabajador_ace',$trabajador_ace);
$sentencia->bindParam(':centro_ace',$centro_ace);
$sentencia->bindParam(':lugar_ace',$lugar_ace);
$sentencia->bindParam(':detalleslugar_ace',$detalleslugar_ace);
$sentencia->bindParam(':tipoaccidente_ace',$tipoaccidente_ace);
$sentencia->bindParam(':fecha_ace',$fecha_ace);
$sentencia->bindParam(':fechabaja_ace',$fechabaja_ace);
$sentencia->bindParam(':hora_ace',$hora_ace);
$sentencia->bindParam(':horatrabajo_ace',$horatrabajo_ace);
$sentencia->bindParam(':trabajohabitual_ace',$trabajohabitual_ace);
$sentencia->bindParam(':diadescanso_ace',$diadescanso_ace);
$sentencia->bindParam(':semanadescanso_ace',$semanadescanso_ace);
$sentencia->bindParam(':diasbaja_ace',$diasbaja_ace);
$sentencia->bindParam(':isevaluadoriesgo_ace',$isevaluadoriesgo_ace);
$sentencia->bindParam(':evalconriesgo_ace',$evalconriesgo_ace);
$sentencia->bindParam(':isrecaida_ace',$isrecaida_ace);
$sentencia->bindParam(':fechaantesrecaida_ace',$fechaantesrecaida_ace);
$sentencia->bindParam(':descripcion_ace',$descripcion_ace);
$sentencia->bindParam(':tipolugar_ace',$tipolugar_ace);
$sentencia->bindParam(':zonalugar_ace',$zonalugar_ace);
$sentencia->bindParam(':observaclugar_ace',$observaclugar_ace);
$sentencia->bindParam(':procesotrabajo_ace',$procesotrabajo_ace);
$sentencia->bindParam(':observproceso_ace',$observproceso_ace);
$sentencia->bindParam(':tipoactividad_ace',$tipoactividad_ace);
$sentencia->bindParam(':observtipoactiv_ace',$observtipoactiv_ace);
$sentencia->bindParam(':agentematerial_ace',$agentematerial_ace);
$sentencia->bindParam(':observagmaterial_ace',$observagmaterial_ace);
$sentencia->bindParam(':desviacion_ace',$desviacion_ace);
$sentencia->bindParam(':observdesviacion_ace',$observdesviacion_ace);
$sentencia->bindParam(':agmaterdesv_ace',$agmaterdesv_ace);
$sentencia->bindParam(':observagendesv_ace',$observagendesv_ace);
$sentencia->bindParam(':formacontacto_ace',$formacontacto_ace);
$sentencia->bindParam(':observformacont_ace',$observformacont_ace);
$sentencia->bindParam(':matercasusalesi_ace',$matercasusalesi_ace);
$sentencia->bindParam(':observmatlesi_ace',$observmatlesi_ace);
$sentencia->bindParam(':numtrafectados_ace',$numtrafectados_ace);
$sentencia->bindParam(':declaraciontrab_ace',$declaraciontrab_ace);
$sentencia->bindParam(':istestigos_ace',$istestigos_ace);
$sentencia->bindParam(':detallestestigo_ace',$detallestestigo_ace);
$sentencia->bindParam(':declaraciontestigo_ace',$declaraciontestigo_ace);
$sentencia->bindParam(':tipolesion_ace',$tipolesion_ace);
$sentencia->bindParam(':gradolesion_ace',$gradolesion_ace);
$sentencia->bindParam(':partecuerpo_ace',$partecuerpo_ace);
$sentencia->bindParam(':isevacuacion_ace',$isevacuacion_ace);
$sentencia->bindParam(':lugarevacuacion_ace',$lugarevacuacion_ace);
$sentencia->bindParam(':centromedico_ace',$centromedico_ace);
$sentencia->bindParam(':detallescentromed_ace',$detallescentromed_ace);
$sentencia->bindParam(':recomedincorp_ace',$recomedincorp_ace);
$sentencia->bindParam(':recinedtrab_ace',$recinedtrab_ace);
$sentencia->bindParam(':istrformado_ace',$istrformado_ace);
$sentencia->bindParam(':istrinformado_ace',$istrinformado_ace);
$sentencia->bindParam(':protcolectivadisp_ace',$protcolectivadisp_ace);
$sentencia->bindParam(':protcolecnecesa_ace',$protcolecnecesa_ace);
$sentencia->bindParam(':observprotcol_ace',$observprotcol_ace);
$sentencia->bindParam(':episdispon_ace',$episdispon_ace);
$sentencia->bindParam(':episneces_ace',$episneces_ace);
$sentencia->bindParam(':observepis_ace',$observepis_ace);
$sentencia->bindParam(':causaaccidente_ace',$causaaccidente_ace);
$sentencia->bindParam(':porquecausa_ace',$porquecausa_ace);
$sentencia->bindParam(':quiencontrolcausa_ace',$quiencontrolcausa_ace);
$sentencia->bindParam(':conclusionacci_ace',$conclusionacci_ace);
$sentencia->bindParam(':medidasprev_ace',$medidasprev_ace);
$sentencia->bindParam(':valoracionmedida_ace',$valoracionmedida_ace);
$sentencia->bindParam(':histaccult12mes_ace',$histaccult12mes_ace);
$sentencia->bindParam(':histpuestoacc_ace',$histpuestoacc_ace);
$sentencia->bindParam(':histtrabajosreal_ace',$histtrabajosreal_ace);
$sentencia->bindParam(':histcausaacc_ace',$histcausaacc_ace);
$sentencia->bindParam(':histmedidaacc_ace',$histmedidaacc_ace);
$sentencia->bindParam(':investigador_ace',$investigador_ace);
$sentencia->bindParam(':cargoinvesiga_ace',$cargoinvesiga_ace);
$sentencia->bindParam(':fechainvestiga_ace',$fechainvestiga_ace);
$sentencia->bindParam(':fechacumplimen_ace',$fechacumplimen_ace);
$sentencia->bindParam(':revisadopor_ace',$revisadopor_ace);
$sentencia->bindParam(':cargorevisado_ace',$cargorevisado_ace);
$sentencia->bindParam(':fecharevision_ace',$fecharevision_ace);


if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Actividad registrada correctamente";
    $_SESSION['icono'] = 'success';
    header("Location: " . $URL . "/admin/accidentes");
    } else {
    session_start();
    $_SESSION['mensaje'] = "Formacion NO creada";
    $_SESSION['icono'] = 'warning';
    header("Location: " . $URL . "/admin/accidentes");
    }
    
    
    ?>