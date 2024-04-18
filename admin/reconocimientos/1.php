<div class="col-md-4">
        <div class="card card-outline card-danger">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Citas reconocimientos</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!-- Button trigger modal -->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevacita">
                        Nuevo Cita
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="50%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="text-align: left">Nombre trab.</th>
                            <th style="text-align: center">Fecha cita</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contadorcitas = 0;
                        foreach ($citasrm as $citasrm_lista) {
                            $contadorcitas = $contadorcitas + 1;
                            $id_citarm = $citasrm_lista['id_citarm'];
                        ?>

                            <tr>
                                <td style="text-align: left"><?php echo $citasrm_lista['nombre_tr']; ?></td>
                                <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($citasrm_lista['fecha_crm'])) ?></td>
                                <td style="text-align: center">
                                    <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Email Cita RM" data-target="#modal-emailcita<?php echo $id_citarm; ?>"><i class="fa-regular fa-envelope"></i></i></button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="EDITAR Cita RM" data-target="#modal-modificacita<?php echo $id_citarm; ?>"><i class="bi bi-pencil-square"></i></i></button>
                                        <a href="../../app/controllers/reconocimientos/delete_cita.php?id_citarm=<?php echo $id_citarm; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar cita RM"><i class="bi bi-trash-fill"></i> </a>
                                    </div>
                                </td>






                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>


    </div>


    <!--Modal Modificar cita-->
    <div class="modal fade" id="modal-modificacita<?php echo $id_citarm; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:gold">
                    <h5 class="modal-title" id="modal-modificacita" style="color: black;"><i class="bi bi-person-lines-fill"></i>MODIFICA CITA RM - <?php echo $citasrm_lista['nombre_tr'] ?> </h5>
                    <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="../../app/controllers/reconocimientos/update_cita.php" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <input type="text" id="id_citarm" name="id_citarm" value="<?php echo $citasrm_lista['id_citarm'] ?>" class="form-control" hidden>


                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $citasrm_lista['nombre_tr'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $citasrm_lista['dni_tr'] ?>" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $citasrm_lista['nombre_cat'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $citasrm_lista['nombre_cen'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $citasrm_lista['razonsocial_emp'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <hr>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha cita</label>
                                    <input type="date" name="fecha_crm" value="<?php echo $citasrm_lista['fecha_crm'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="accpropuesta_acc" class="col-form-label col-sm-4">Anotaciones / restricciones</label>

                                        <textarea class="form-control" name="anotaciones_crm" value="" rows="2"><?php echo $citasrm_lista['anotaciones_crm'] ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Guardar</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>
    <!--fin modal-->
    <!--Modal email cita-->
    <div class="modal fade" id="modal-emailcita<?php echo $id_citarm; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:gold">
                    <h5 class="modal-title" id="modal-emailcita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $citasrm_lista['nombre_tr'] ?> - Detalles</h5>
                    <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="../../app/controllers/reconocimientos/enviar_email.php" method="post" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $citasrm_lista['nombre_tr'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $citasrm_lista['dni_tr'] ?>" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $citasrm_lista['nombre_cat'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $citasrm_lista['nombre_cen'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $citasrm_lista['razonsocial_emp'] ?>" readonly>
                                    </div>
                                </div>
                            </div>




                            </br>
                            <hr>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Destinatario email</label>
                                    <select name="destinatario" id="destinatario" class="form-control">
                                        <?php
                                        foreach ($emailsinteres_datos as $emailsinteres_dato) { ?>
                                            <option value="<?php echo $emailsinteres_dato['email_ei']; ?>"><?php echo $emailsinteres_dato['nombre_ei'] ?> | <?php echo $emailsinteres_dato['email_ei'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </br>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <label for="">Anotaciones / restricciones</label>
                                <textarea class="form-control" name="anotaciones_crm" value="" rows="2"><?php echo $citasrm_lista['anotaciones_crm'] ?></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Enviar</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>
    <!--fin modal-->

    <!-- Modal Nueva cita -->
    <div class="modal fade" id="modal-nuevacita">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#808000 ;color:white">
                    <h5 class="modal-title" id="modal-nuevacita">Cita para Reconocimiento Medico</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../app/controllers/reconocimientos/create_citarm.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Trabajador</label>
                                <select name="trabajador_crm" id="" class="form-control">
                                    <?php
                                    foreach ($trabajadores as $trabajador) { ?>
                                        <option value="<?php echo $trabajador['id_trabajador']; ?>"><?php echo $trabajador['nombre_tr'] ?> | <?php echo $trabajador['nombre_cat']  ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha cita</label>
                                    <input type="date" name="fecha_crm" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="">Anotaciones / restricciones</label>
                                    <textarea class="form-control" name="anotaciones_crm" rows="3"></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal nueva cita-->

