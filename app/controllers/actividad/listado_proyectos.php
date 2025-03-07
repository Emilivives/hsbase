<?php

$sql = "SELECT *, py.nombre_py as nombre_py, emp.nombre_emp as nombre_emp, resp.nombre_resp as nombre_resp, py.descripcion_py as descripcion_py, py.estado_py as estado_py, py.fechainicio_py as fechainicio_py, py.fechafin_py as fechafin_py
 FROM ag_proyecto as py
 INNER JOIN empresa as emp ON py.empresa_py = emp.id_empresa
INNER JOIN responsables as resp ON py.responsable_py = resp.id_responsable
ORDER BY py.fechainicio_py DESC";

$query_proyectos = $pdo->prepare($sql);
$query_proyectos ->execute();
$proyectos = $query_proyectos->fetchAll(PDO::FETCH_ASSOC);


