<div class="modal fade" id="nuevoModalperfil" tabindex="-1" aria-labelledby="nuevoModalperfil" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalLabel">NUEVO PERFIL USUARIO</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->
                <form action="../../app/controllers/perfiles/create.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre PERFIL <b>*</b></label>
                                <input type="text" name="nombre_pf" class="form-control" required>
                            </div>
                            <br>

                        </div>

                    </div>

                    <hr>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                    </div>

                </form>
                <!-- Pie del Modal -->

            </div>

        </div>
    </div>
</div>