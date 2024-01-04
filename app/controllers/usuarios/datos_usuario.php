<?php

$sql = "SELECT us.id_usuario as id_usuario, us.nombre_usr as nombre_usr, us.email_usr as email_usr, pf.nombre_pf as nombre_pf 
FROM `tb_usuarios` as us INNER JOIN `tb_perfiles` as pf ON us.id_perfil = pf.id_perfil WHERE `id_usuario` = '$id_usuario'";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $nombre_usr = $usuario['nombre_usr'];
    $email_usr = $usuario['email_usr'];
    $perfil_usr = $usuario['nombre_pf'];
}
