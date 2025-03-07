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
define('USUARIO', 'root');      // Mantén un usuario fijo
define('PASSWORD', '');         // Mantén la contraseña fija
define('BD', 'hs_base');

define('BASE_URL', '/hsbase'); // Ajusta según tu configuración
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . BASE_URL);


$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "Conexión correcta con la BD";
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit;  // Detenemos la ejecución si no se conecta a la base de datos
}

$URL = "http://localhost/hsbase";

date_default_timezone_set("Europe/Madrid");
$fechahora = date('Y-m-d H:i:s');
$fecha = date('Y-m-d');
