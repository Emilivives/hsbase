<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/perfiles/update_perfil.php');


?>

<div class="container-fluid">
    <br>
    <h1>Modificar Perfil</h1>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Detalles del perfil de usuario</b></h3>

                </div>
                <div class="card-body">
                    <form action="../../app/controllers/perfiles/update.php" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="id_perfil" value="<?php echo $id_perfil_get;?>" hidden>
                                    <label for="">Nombre del perfil <b>*</b></label>
                                    <input type="text" name="nombre_pf" value="<?php echo $nombre_pf; ?>"  class="form-control" required>
                                </div>
                            </div>
                          
                        </div>
                       
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo $URL; ?>/admin/perfiles" class="btn btn-secondary">Cancelar</a>
                                <input type="submit" class="btn btn-warning" value="Guardar datos">
                            </div>
                        </div>
                </div>
                </form>
            </div>

        </div>

    </div>


</div>


<?php 
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>