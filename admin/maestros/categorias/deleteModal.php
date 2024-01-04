<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="deleteModalempresa"><i class="bi bi-building"> </i></i> <b> ELIMINAR CATEGORIA</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->


                <?php
                include('../../../app/config.php');
                $id_categoria = $_GET['id_categoria'];
                include('../../../app/controllers/maestros/categorias/datos_categoria.php');

                ?>

                <div class="container-fluid">
                    <br>
                    <h1>CATEGORIA: <?php echo $id_categoria; ?></h1>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="card card-outline card-danger">
                                <div class="card-header">
                                    <h3 class="card-title"><b>¿Está seguro eliminar esta categoria?</b></h3>

                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre categoria </label>
                                                <input type="text" value="<?php echo $nombre_cat ?>" name="nombre_cat" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea type="text" value="<?php echo $descripcion_cat ?>" name="descripcion_cat" class="form-control" rows="15" disabled>
                                </div>
                            </div>-->

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <form action="<?php echo $URL; ?>/app/controllers/maestros/categorias/delete.php" method="post">
                                                    <input type="text" value="<?php echo $id_categoria; ?>" name="id_categoria" hidden>
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

                <!-- Pie del Modal -->

            </div>

        </div>
    </div>
</div>