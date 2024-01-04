<?php
include('../../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../../app/controllers/maestros/tipocentros/listado_tipocentros.php');

?>


<div class="modal fade" id="nuevoModalcentro" tabindex="-1" aria-labelledby="nuevoModalcentro" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalcentro"><i class="bi bi-building"> <i class='fas fa-ship'></i></i> <b> NUEVO CENTRO</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--cuerpo del modal-->
                <form action="../../../app/controllers/maestros/centros/create.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre Centro <b>*</b></label>
                                <input type="text" name="nombre_cen" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Empresa</label>
                                <select name="empresa_cen" id="" class="form-control">
                                    <?php
                                    foreach ($empresas_datos as $empresas_dato) { ?>
                                        <option value="<?php echo $empresas_dato['id_empresa']; ?>"><?php echo $empresas_dato['nombre_emp']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo Centro</label>
                                <select name="tipo_cen" id="" class="form-control">
                                    <?php
                                    foreach ($tipocentros_datos as $tipocentros_dato) { ?>
                                        <option value="<?php echo $tipocentros_dato['id_tipocentro']; ?>"><?php echo $tipocentros_dato['nombre_tc']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Dirección <b>*</b></label>
                                <input type="text" name="direccion_cen" class="form-control" required>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="" class="btn btn-secondary ">Cancelar</a>
                                <input type="submit" class="btn btn-primary" value="Registrar Centro">
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
</div>