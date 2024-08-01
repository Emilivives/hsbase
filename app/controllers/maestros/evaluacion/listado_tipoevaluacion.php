<?php
// Obtener los tipos de evaluación
$sql_tipoevaluacion = "SELECT id_tipoevaluacion, tipoevaluacion_tev, especialidad_tev, descripcion_tev FROM tipoevaluacion";
$query_tipoevaluacion = $pdo->prepare($sql_tipoevaluacion);
$query_tipoevaluacion->execute();
$tipoevaluacion_datos = $query_tipoevaluacion->fetchAll(PDO::FETCH_ASSOC);