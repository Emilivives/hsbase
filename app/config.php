<?php
// para servidor web
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//define('APP_NAME', 'HS Base');
//define('SERVIDOR', 'localhost:3306');
//define('USUARIO', 'emilivives');
//define('PASSWORD', 'c3obG#vsx8ryR1T$');
//define('BD', 'hs_base');
// fin para servidor web


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
$fecha = date(format:'Y-m-d');


