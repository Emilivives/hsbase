<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/perfiles/listado_perfiles.php');
?>

<div class="container-fluid">
    <br>
    <h1>Nuevo Usuario</h1>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos del usuario</b></h3>

                </div>
                <div class="card-body">
                    <form action="../../app/controllers/usuarios/create.php" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre usuario <b>*</b></label>
                                    <input type="text" name="nombre_usr" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email <b>*</b></label>
                                    <input type="email" name="email_usr" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Perfil Usuario</label>
                                    <select name="perfil" id="" class="form-control">
                                        <?php
                                        foreach ($perfiles_datos as $perfiles_dato) { ?>
                                            <option value="<?php echo $perfiles_dato['id_perfil']; ?>"><?php echo $perfiles_dato['nombre_pf']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contraseña <b>*</b></label>
                                    <input type="password" name="password_usr" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Verificar contraseña <b>*</b></label>
                                    <input type="password" name="password_verify" class="form-control" required>
                                </div>
                            </div>
                        </div>
                       
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="" class="btn btn-secondary">Cancelar</a>
                                <input type="submit" class="btn btn-primary" value="Registrar usuario">
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