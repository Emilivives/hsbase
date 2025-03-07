<?php

$sql = "SELECT *, py.nombre_py as nombre_py, emp.nombre_emp as nombre_emp, resp.nombre_resp as nombre_resp, py.descripcion_py as descripcion_py, py.estado_py as estado_py, py.fechainicio_py as fechainicio_py, 
py.fechafin_py as fechafin_py FROM ag_proyecto as py 
INNER JOIN empresa as emp ON py.empresa_py = emp.id_empresa
INNER JOIN responsables as resp ON py.responsable_py = resp.id_responsable WHERE id_proyecto = $id_proyecto";


$query = $pdo->prepare($sql);
$query->execute();
$proyectos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($proyectos as $proyecto) {
    $nombre_py = $proyecto['nombre_py'];
    $empresa_py = $proyecto['nombre_emp'];
    $responsable_py = $proyecto['nombre_resp'];
    $descripcion_py = $proyecto['descripcion_py'];
    $estado_py = $proyecto['estado_py'];
    $fechainicio_py = $proyecto['fechainicio_py'];
    $fechafin_py = $proyecto['fechafin_py'];
     

}
