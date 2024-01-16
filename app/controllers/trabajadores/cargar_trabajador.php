<?php

include('../../../app/config.php');

$codigo = $_POST['trabajador'];

$sql = "SELECT * FROM trabajadores WHERE id='$trabajador'";

$result = mysqli_query($servidor, $sql);

$cadena = "<label>Codigo de Barra</label> 
			<select class='form-control' required id='id_trabajador' name='id_trabajador'>";

while ($ver = mysqli_fetch_assoc($result)) {
    $cadena = $cadena . '<option value=' . $ver['nombre_tr'] . '>' . utf8_encode($ver['nombre_tr']) . '</option>';
}

echo  $cadena . "</select>";