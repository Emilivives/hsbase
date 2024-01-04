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

            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>¿Está seguro eliminar usuario?</b></h3>

                </div>
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre usuario </label>
                                    <input type="text" value="<?php echo $nombre_usr?>" name="nombre_usr" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" value="<?php echo $email_usr?>" name="email_usr" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Perfil usuario</label>
                                    <input type="text" value="<?php echo $perfil_usr?>" name="perfil" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <form action="<?php echo $URL;?>/app/controllers/usuarios/delete.php" method="post">
                                        <input type="text" value="<?php echo $id_usuario;?>"name="id_usuario" hidden>
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Borrar</button>
                                    </form>
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