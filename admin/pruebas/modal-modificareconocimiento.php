<!--Modal modifica rm-->
<div class="modal fade" id="modal-modificareconocimiento<?php echo $id_reconocimiento; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
    <?php include('../../app/controllers/reconocimientos/datos_reconocimiento.php'); ?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:gold">
                <h5 class="modal-title" id="modal-modificacita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $reconocimientos_dato['nombre_tr'] ?> -

                    <?php $reconocimientos_dato['activo_tr'];
                    if ($reconocimientos_dato['activo_tr'] == 0) { ?>
                        <span class='badge badge-danger'>
                            <h4>BAJA</h4>
                        </span>
                    <?php }
                    ?>




                </h5>
                <button type="button" class="close" style="color:black;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="../../app/controllers/reconocimientos/update.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <input type="text" name="id_reconocimiento" value="<?php echo $reconocimientos_dato['id_reconocimiento'] ?>" class="form-control" hidden>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Trabajador</label>
                                <select name="trabajador_rm" id="" class="form-control">
                                    <?php
                                    foreach ($trabajadores as $trabajador) {
                                        $trabajador_tabla = $trabajador['nombre_tr'];
                                        $id_trabajador = $trabajador['id_trabajador']; ?>
                                        <option value="<?php echo $id_trabajador; ?>" <?php if ($trabajador_tabla == $trabajador_rm) { ?> selected="selected" <?php } ?>>
                                            <?php echo $trabajador_tabla; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha Reconocimiento</label>
                                    <input type="date" name="fecha_rm" value="<?php echo $reconocimientos_dato['fecha_rm'] ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Valido hasta</label>
                                    <input type="date" name="caducidad_rm" value="<?php echo $reconocimientos_dato['caducidad_rm'] ?>" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="vigente_rm" id="flexRadioDefault3" value="1" <?php if ($reconocimientos_dato['vigente_rm'] == "1") {
                                                                                                                                        echo 'Checked';
                                                                                                                                    } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        <b><?php $reconocimientos_dato['vigente_rm'];
                                            if ($reconocimientos_dato['vigente_rm'] == 1) { ?>
                                                <span class='badge badge-success'>VIGENTE</span>
                                            <?php } else {
                                                echo "Activo";
                                            }
                                            ?></b>

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="vigente_rm" id="flexRadioDefault3" value="0" <?php if ($reconocimientos_dato['vigente_rm'] == "0") {
                                                                                                                                        echo 'Checked';
                                                                                                                                    } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        <b><?php $reconocimientos_dato['vigente_rm'];
                                            if ($reconocimientos_dato['vigente_rm'] == 0) { ?>
                                                <span class='badge badge-danger'>NULO</span>
                                            <?php } else {
                                                echo "Nulo";
                                            }
                                            ?></b>
                                    </label>
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cita_rm" id="flexRadioDefault5" value="1" <?php if ($reconocimientos_dato['cita_rm'] == "1") {
                                                                                                                                        echo 'Checked';
                                                                                                                                    } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        <b><?php $reconocimientos_dato['cita_rm'];
                                            if ($reconocimientos_dato['cita_rm'] == 1) { ?>
                                                <span class='badge badge-success'>CITADO</span>
                                            <?php } else {
                                                echo "Activo";
                                            }
                                            ?></b>

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cita_rm" id="flexRadioDefault6" value="1" <?php if ($reconocimientos_dato['cita_rm'] == "0") {
                                                                                                                                        echo 'Checked';
                                                                                                                                    } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        <b><?php $reconocimientos_dato['cita_rm'];
                                            if ($reconocimientos_dato['cita_rm'] == 0) { ?>
                                                <span class='badge badge-danger'>NO CITADO</span>
                                            <?php } else {
                                                echo "Nulo";
                                            }
                                            ?></b>
                                    </label>
                                </div>
                            </div>

                        </div>
                        </br>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha CITA MEDICA</label>
                                    <input type="date" name="fechacita_rm" value="<?php echo $reconocimientos_dato['fechacita_rm'] ?>" class="form-control">
                                </div>
                            </div>


                        </div>
                        </br>
                        <hr>

                        <div class="row">
                            <div class="form-group">
                                <label for="">Anotaciones / restricciones</label>
                                <textarea class="form-control" name="anotaciones_rm" rows="6"></textarea>
                            </div>
                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Enviar</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


</div>
<!--fin modal-->