<?php include(BASE_PATH.'/app/controllers/perfiles/listado_perfiles.php') ?>

<div class="modal fade" id="nuevoModalusuario" tabindex="-1" aria-labelledby="nuevoModalusuario" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalLabel"><b>NUEVO PERFIL USUARIO</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->
                <form action="../../app/controllers/usuarios/create.php" method="post" enctype="multipart/form-data">

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
                            <a href="" class="btn btn-secondary ">Cancelar</a>
                            <input type="submit" class="btn btn-primary" value="Registrar usuario">
                        </div>
                    </div>

                    <!-- <hr>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                    </div> -->

                </form>
                <!-- Pie del Modal -->

            </div>

        </div>
    </div>
</div>