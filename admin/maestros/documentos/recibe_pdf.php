 <?php  
include('../../../app/config.php');

$con = mysqli_connect(SERVIDOR, USUARIO, PASSWORD) or die("No se ha podido conectar al Servidor");
mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, BD) or die("Upps! Error en conectar a la Base de Datos");

$fecha      	=  date("d_m_Y");
$hora        	=  date("g:i:A");

//Verificando si existe el directorio de lo contarios lo creamos el Directorio
$directorio = "Files_Pdf/";
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

$namefile  = $_REQUEST['name_file'];
$urlFile   = $_FILES["file-input"]["name"]; //Recibiendo el Archivo


//Modificando nombre del archivo
$new_name_file  = $fecha.'_'.$urlFile;


//Guardando archivo en la carperta
$archivo = $directorio . basename($new_name_file); 
$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));  
if (move_uploaded_file($_FILES["file-input"] ["tmp_name"], $archivo)) {
	
	//Registrando el archivo en bd
	$InsertFile = ("INSERT INTO documentos(
		  urlArchivo,
		  name_file,
		  fecha_actual
		)
		VALUES (
		  '" .$new_name_file. "',
		  '" .$namefile. "',
		  '" .$fecha.'_'.$hora. "'
		)");

		$resultInsert = mysqli_query($con, $InsertFile); 
		session_start();
        $_SESSION['mensaje'] = "Dobumento subido correctamente";
        $_SESSION['icono'] = 'success';?>
		<script type="text/javascript">
			window.location.href = "index.php";
		</script>
		
	<?php
	
	} else {
		echo "error en la subida del archivo";
	}
	mysqli_close($con);
	?>