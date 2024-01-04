<?php

include ('../../config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM `tb_usuarios` WHERE `email_usr` = '$email' ";
$query = $pdo->prepare($sql);
$query ->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;

foreach($usuarios as $usuario){
    
    $contador = $contador + 1;
    $password_tabla = $usuario['password_usr'];
}


$hash = $password_tabla;

if(($contador>0) && (password_verify($password, $hash))){
    echo "Bienvenido al sistema";
    session_start();
    $_SESSION['sesion_email'] = $email;
    header('location:'.$URL.'/admin');
}else{
    echo "Error en los datos";
    header('location:'.$URL.'/login');
}

?>


