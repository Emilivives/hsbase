<div class="modal fade" id="nuevoModalempresa" tabindex="-1" aria-labelledby="nuevoModalempresa" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalempresa"><i class="bi bi-building"> </i></i> <b> NUEVA EMPRESA</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->
                <form action="../../../app/controllers/maestros/empresas/create.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre Empresa <b>*</b></label>
                                <input type="text" name="nombre_emp" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Cif Empresa <b>*</b></label>
                                <input type="text" name="cif_emp" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Dirección <b>*</b></label>
                                <input type="text" name="direccion_emp" class="form-control" required>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="" class="btn btn-secondary ">Cancelar</a>
                                <input type="submit" class="btn btn-primary" value="Registrar Empresa">
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
