<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/perfiles/listado_perfiles.php');

$id_usuario = $_GET['id_usuario'];
include('../../app/controllers/usuarios/datos_usuario.php');
?>

<div class="container-fluid">
    <br>
    <h1>Modificar datos de Usuario <?php echo $nombre_usr; ?></h1>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Detalles del usuario</b></h3>

                </div>
                <div class="card-body">
                    <form action="../../app/controllers/usuarios/update.php" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre usuario <b>*</b></label>
                                    <input type="text" name="nombre_usr" value="<?php echo $nombre_usr; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email <b>*</b></label>
                                    <input type="email" name="email_usr" value="<?php echo $email_usr; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Perfil Usuario</label>
                                    <select name="perfil" id="" class="form-control">
                                        <?php
                                        foreach ($perfiles_datos as $perfiles_dato) {
                                            $perfil_tabla = $perfiles_dato['nombre_pf'];
                                            $id_perfil = $perfiles_dato['id_perfil']; ?>
                                            <option value="<?php echo $id_perfil; ?>" <?php if ($perfil_tabla == $perfil_usr) { ?> selected="selected" <?php } ?>>
                                                <?php echo  $perfil_tabla; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contraseña <b>*</b></label>
                                    <input type="password" name="password_usr" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Verificar contraseña <b>*</b></label>
                                    <input type="password" name="password_verify" class="form-control">
                                </div>
                            </div>
                        </div>
                       

                        
                        <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>" hidden>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                <input type="submit" class="btn btn-warning" value="Actualizar datos">
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