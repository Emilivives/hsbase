<?php

define('APP_NAME', 'HS Base');
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'hs_base');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;


try{
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   // echo "conexion correcta con BD";
}catch (PDOException $e) {

    echo "error conexion a bd";
}

$URL = "http://localhost/hsbase";


date_default_timezone_set("Europe/Madrid");
$fechahora = date(format:'Y-m-d H:i:s');