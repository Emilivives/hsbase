<?php

$sql = "SELECT emp.id_empresa as id_empresa, emp.nombre_emp as nombre_emp, emp.razonsocial_emp as razonsocial_emp, emp.cif_emp as cif_emp, emp.direccion_emp as direccion_emp, 
emp.modalidadprl_emp as modalidadprl_emp, emp.logo_emp as logo_emp
FROM empresa as emp WHERE id_empresa = $id_empresa";
$query = $pdo->prepare($sql);
$query->execute();
$empresa_datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($empresa_datos as $empresa_dato) {
    $nombre_emp = $empresa_dato['nombre_emp'];
    $razonsocial_emp = $empresa_dato['razonsocial_emp'];
    $cif_emp = $empresa_dato['cif_emp'];
    $direccion_emp = $empresa_dato['direccion_emp'];
    $modalidadprl_emp = $empresa_dato['modalidadprl_emp'];
    $logo_emp = $empresa_dato['logo_emp'];
     

}

