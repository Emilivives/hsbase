<?php 
include('../../../app/controllers/maestros/centros/datos_centro.php'); 
?>

<div class="modal fade" id="updateModalcentro" tabindex="-1" aria-labelledby="updateModalcentro" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="updateModalcentro">
                    <i class="bi bi-building"> <i class='fas fa-ship'></i></i> <b> EDITAR CENTRO</b>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../../app/controllers/maestros/centros/update.php" method="post">
                    <input type="hidden" name="id_centro" value="<?php echo $centro['id_centro']; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre Centro <b>*</b></label>
                                <input type="text" name="nombre_cen" class="form-control" value="<?php echo htmlspecialchars($centro['nombre_cen']); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Empresa</label>
                                <select name="empresa_cen" class="form-control">
                                    <?php
                                    foreach ($empresas_datos as $empresas_dato) { 
                                        $selected = ($centro['id_empresa'] == $empresas_dato['id_empresa']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $empresas_dato['id_empresa']; ?>" <?php echo $selected; ?>>
                                            <?php echo htmlspecialchars($empresas_dato['nombre_emp']); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo Centro</label>
                                <select name="tipo_cen" class="form-control">
                                    <?php
                                    foreach ($tipocentros_datos as $tipocentros_dato) { 
                                        $selected = ($centro['id_tipocentro'] == $tipocentros_dato['id_tipocentro']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $tipocentros_dato['id_tipocentro']; ?>" <?php echo $selected; ?>>
                                            <?php echo htmlspecialchars($tipocentros_dato['nombre_tc']); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Dirección <b>*</b></label>
                                <input type="text" name="direccion_cen" class="form-control" value="<?php echo htmlspecialchars($centro['direccion_cen']); ?>" required>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-primary" value="Actualizar Centro">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
