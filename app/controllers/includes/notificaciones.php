<?php
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/trabajadores/listado_trabajadores.php'); 
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/formaciones/listado_formaciones.php'); 
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/reconocimientos/listado_reconocimientos.php'); 
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/inventario/listado_revisionoficial_maq.php'); 
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/accidentes/listado_accidentes.php'); 
 include($_SERVER['DOCUMENT_ROOT'] . '/admin/actividad/listado_accionprl.php');

$contador_tr_no_formados = 0;
$contador_accidentes_sin_comunicar = 0;
$contador_tr_no_citarm = 0;
$contador_mantenimientos_caducados = 0;

// Lógica como ya la tienes:
foreach ($trabajadores as $trabajador) {
    if ($trabajador['activo_tr'] == 1 && $trabajador['formacionpdt_tr'] == 'No') {
        $contador_tr_no_formados++;
    }
}

foreach ($accidentes_datos as $accidente) {
    if ($accidente['comunicado_ace'] == "NO") {
        $contador_accidentes_sin_comunicar++;
    }
}

foreach ($reconocimientos as $reconocimiento) {
    if ($reconocimiento['vigente_rm'] == 1 && $reconocimiento['caducidad_rm'] < $fechahora && $reconocimiento['cita_rm'] == 0) {
        $contador_tr_no_citarm++;
    }
}

foreach ($listarevisionoficial_datos as $revision) {
    if ($revision['vigente_revof'] == 1 && strtotime($revision['caducidad_revof']) < strtotime(date('Y-m-d'))) {
        $contador_mantenimientos_caducados++;
    }
}

// Contador total
$contador_total_notificaciones = $contador_tr_no_formados + $contador_accidentes_sin_comunicar + $contador_tr_no_citarm + $contador_mantenimientos_caducados;
?>
