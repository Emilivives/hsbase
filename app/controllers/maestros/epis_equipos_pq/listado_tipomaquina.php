<?php
// Obtener los tipos de evaluación
$sql_tipomaquina = "SELECT id_tipomaquina, nombre_tm, clase_tm FROM tipomaquinas ORDER BY clase_tm ASC";
$query_tipomaquina = $pdo->prepare($sql_tipomaquina);
$query_tipomaquina->execute();
$tipomaquina_datos = $query_tipomaquina->fetchAll(PDO::FETCH_ASSOC);