<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalLabel"> <i class="bi bi-plus-circle-fill"></i> NUEVA CATEGORIA</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <!--cuerpo del modal-->
                <form action="../../../app/controllers/maestros/categorias/create.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label for="">Nombre categoria <b>*</b></label>
                                <input type="text" name="nombre_cat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Departamento <b>*</b></label>
                                <input type="text" name="departamento_cat" class="form-control" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="">Descripcion categoria</label>
                                <textarea class="form-control" name="descripcion_cat" rows="15"></textarea>
                            </div>
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