<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

$id_usuario = $_GET['id_usuario'];
include('../../app/controllers/usuarios/datos_usuario.php');

?>

<div class="container-fluid">
    <br>
    <h1>Detalles del usuario <?php echo $id_usuario ?></h1>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos registrados del usuario</b></h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre usuario </label>
                                <input type="text" value="<?php echo $nombre_usr ?>" name="nombre_usr" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="<?php echo $email_usr ?>" name="email_usr" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Perfil</label>
                                <input type="text" value="<?php echo $perfil_usr ?>" name="perfil" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>


<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>