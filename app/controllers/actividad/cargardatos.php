<?php

include('../../../app/config.php');

$id_proyecto=$_POST['id_proyecto'];

	$sql="SELECT id,
			 id_proyecto,
			 nombre_py
		from ag_proyecto 
		where id_proyecto='$id_proyecto'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label>Lista Tareas (paises)</label> 
			<select id='listatarea' name='listatarea'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
	

?>