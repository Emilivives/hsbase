<?php

$sql_centros = "SELECT MIN(cen.id_centro) as id_centro,
                       cen.nombre_cen as nombre_cen,
                       cen.direccion_cen as direccion_cen,
                       cen.estado_cen as estado_cen,
                       emp.id_empresa as id_empresa,
                       emp.nombre_emp as nombre_emp,
                       emp.razonsocial_emp as razonsocial_emp,
                       emp.modalidadprl_emp as modalidadprl_emp,
                       tc.id_tipocentro as id_tipocentro,
                       tc.nombre_tc as nombre_tc
                FROM `centros` as cen
                INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
                INNER JOIN tipocentros as tc ON cen.tipo_cen = tc.id_tipocentro
                GROUP BY cen.nombre_cen, emp.nombre_emp, tc.nombre_tc
                WHERE emp.id_empresa = :id_empresa
                ORDER BY cen.nombre_cen ASC";
$query_centros = $pdo->prepare($sql_centros);
$query_centros->execute();
$centros_datos = $query_centros->fetchAll(PDO::FETCH_ASSOC);

