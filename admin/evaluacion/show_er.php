<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_evaluacion = $_GET['id_evaluacion'];
include('../../app/controllers/evaluacion/datos_evaluacion.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/epis_equipos_pq/listado_epi.php');
include('../../app/controllers/evaluacion/listado_puestoarea.php');
include('../../app/controllers/evaluacion/listar_puestocentro.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');

?>


<html>

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <div class="col-lg-12">
        <div class="row">
            <div class="callout callout-info">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <h5><b><?php echo $nombre_er ?></b></h5>
                        </div>
                        </dl>
                        <div class="col-md-2">
                            <dl>
                                <dt><b class="border-bottom border-primary">Responsable</b></dt>
                                <dd><?php echo $codigo_er ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-1">
                            <dl>
                                <dt><b class="border-bottom border-primary">Fecha </b></dt>
                                <dd><?php echo $fecha_er = date("d-m-Y", strtotime($fecha_er)) ?></dd>
                            </dl>
                        </div>

                        <div class="col-md-2">
                            <dl>
                                <dt><b class="border-bottom border-primary">Responsable</b></dt>
                                <dd><?php echo $nombre_resp ?></dd>



                            </dl>
                        </div> <!--boton modal modificar proyecto-->
                        <div class="col-md-1">

                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Modificar detalles" data-target="#modal-editarevaluacion<?php echo $id_evaluacion; ?>"><i class="bi bi-pencil-square"></i>Editar</button>
                            <?php include('../../app/controllers/evaluacion/datos_evaluacion.php');
                            include('../../app/controllers/maestros/responsables/listado_responsables.php');
                            include('../../app/controllers/maestros/centros/listado_centros.php');
                            ?>


                            <a class="btn btn-text-right btn-outline-dark btn-sm" title="Ver anterior" href="index.php">Volver</a>
                            <a class="btn btn-danger btn-sm" href="../../admin/actividad/reporte_memoria.php?id_proyecto=<?php echo $id_proyecto; ?>"><i class="fa-regular fa-file-lines"></i> Imprimir report</a>

                            <!--inicio modal modificar proyecto-->
                            <div class="modal fade" id="modal-editarevaluacion<?php echo $id_evaluacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:gold">
                                            <h5 class="modal-title" id="modal-editarproyecto" style="color: black;"><i class="fa-solid fa-hands-holding-circle"></i>Proyecto: <?php echo $proyecto['nombre_py'] ?></h5>
                                            <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="../../app/controllers/actividad/update_proyecto.php" method="post" enctype="multipart/form-data">


                                                <div class="row">
                                                    <div class="form-group row">
                                                        <input type="text" value="<?php echo $proyecto['id_proyecto'] ?>" name="id_proyecto" class="form-control" hidden>


                                                        <div class="col-md-5">
                                                            <label for="">Nombre</label>
                                                            <input type="text" value="<?php echo $proyecto['nombre_py'] ?>" name="nombre_py" class="form-control">
                                                        </div>


                                                        <div class="col-sm-5">
                                                            <label for="" class="col-form-label col-sm-3">Responsable:</label>
                                                            <div class="col-sm-9">
                                                                <select name="responsable_py" id="" class="form-control" required>
                                                                    <?php
                                                                    foreach ($responsables_datos as $responsable_dato) {
                                                                        $responsable_tabla = $responsable_dato['nombre_resp'];
                                                                        $id_responsable = $responsable_dato['id_responsable']; ?>
                                                                        <option value="<?php echo $id_responsable; ?>" <?php if ($responsable_tabla == $responsable_py) { ?> selected="selected" <?php } ?> nombre_resp="<?php echo $responsable_dato['nombre_resp']; ?>">
                                                                            <?php echo  $responsable_tabla; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="">Descripción:</label>
                                                            <input type="text" value="<?php echo $proyecto['descripcion_py'] ?>" name="descripcion_py" class="form-control">
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Fecha Inicio</label>
                                                            <input type="date" value="<?php echo $proyecto['fechainicio_py'] ?>" name="fechainicio_py" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Fecha Fin</label>
                                                            <input type="date" value="<?php echo $proyecto['fechafin_py'] ?>" name="fechafin_py" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"> </div>
                                                    <div class="col-sm-2">

                                                        <label for="estado" class="col-form-label col-sm-2">Estado:</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" name="estado_py" aria-label="Default select example">
                                                                <option value="<?php echo $estado_py ?>"><?php echo $estado_py ?></option>

                                                                <option value="0">Selecciona estado</option>

                                                                <option value="Activo">Activo</option>
                                                                <option value="Finalizado">Finalizado</option>
                                                                <option value="Cancelado">Cancelado</option>
                                                            </select>
                                                        </div>
                                                    </div>



                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="" class="btn btn-secondary">Cancelar</a>
                                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--fin modal-->


                        </div>
                    </div>

                </div>

            </div>


        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Puestos / Areas</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!--boton modal-->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-importarpuestoarea">Importar Puesto / Area</button>

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevopuestoarea">Añadir Puesto / Area</button>
                    </div>
                </div>
                <!-- Modal para Importar Puesto/Área -->
                <div class="modal fade" id="modal-importarpuestoarea" tabindex="-1" role="dialog" aria-labelledby="modalImportarPuestoAreaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalImportarPuestoAreaLabel">Seleccionar Puesto / Área para Importar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Puesto/Área</th>
                                            <th>Tipo eval.</th>
                                            <th>Centro tº</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Asegúrate de que este archivo contenga la lógica para llenar $puestoareas_datos

                                        // Mostrar los registros obtenidos
                                        if (!empty($puestocentro_listado)) {
                                            foreach ($puestocentro_listado as $puestocentro) { ?>
                                                <tr>
                                                    <td><?= $puestocentro['id_puestocentro']; ?></td>
                                                    <td><?= $puestocentro['puestoarea_pc']; ?></td>
                                                    <td><?= $puestocentro['tipoevaluacion_er']; ?></td>
                                                    <td><?= $puestocentro['nombre_cen']; ?></td>
                                                    <td>
                                                        <a href="../../app/controllers/evaluacion/importar_puestoarea.php?id_puestocentro=<?= $puestocentro['id_puestocentro']; ?>&id_evaluacion=<?= $_GET['id_evaluacion']; ?>" class="btn btn-primary btn-sm">Importar</a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } else {
                                            echo "<tr><td colspan='5'>No se encontraron puestos</td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!--inicio modal nuevo trabajador-->
                <div class="modal fade" id="modal-nuevopuestoarea">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:whitesmoke">
                                <h5 class="modal-title" id="modal-nuevtrabajador"><i class="bi bi-plus-lg"></i> Nueva Puesto / Area</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/evaluacion/create_puestoarea.php" method="post" enctype="multipart/form-data">

                                    <div class="well">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Evaluacion: <?php echo $codigo_er ?></label>
                                                    <input type="text" value="<?php echo $id_evaluacion ?>" name="evaluacion_pc" class="form-control" hidden>

                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="">Puesto / Area</label>
                                                    <input type="text" name="puestoarea_pc" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group row">
                                                    <label for="descripcion_pc" class="col-form-label col-sm-2">Descripcion:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="descripcion_pc" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div id="accordion">

                                                <div class="card card-outline card-primary" id="panelsStayOpen-headingone">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> Factores Riesgo / Siniestralidad / Colectivo sensible</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                                                <i class="fas fa-list"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div id="panelsStayOpen-collapseOne" class="collapse" aria-labelledby="panelsStayOpen-headingOne">

                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <div class="form-group row">
                                                                        <label for="factoresriesgo_pc" class="col-form-label col-sm-2">Factores de Riesgo:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="factoresriesgo_pc" rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <div class="form-group row">
                                                                        <label for="sensible_pc" class="col-form-label col-sm-2">Colectivo Sensible:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="sensible_pc" rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <div class="form-group row">
                                                                        <label for="siniestralidad_pc" class="col-form-label col-sm-2">Siniestralidad del puesto:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="siniestralidad_pc" rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-outline card-primary" id="headingtwo">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> EPIs / Equipos de Trabajo / Productos Químicos</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo">
                                                        <div class="card-body">


                                                            <!-- Equipos de Protección Individual -->
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="">EPIs</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CALZADO SEGURIDAD" id="ep1">
                                                                            <label class="form-check-label" for="ep1">CALZADO SEGURIDAD</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="BOTA ALTA IMPERMEABLE" id="ep2">
                                                                            <label class="form-check-label" for="ep2">BOTA ALTA IMPERMEABLE</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CASCO DE PROTECCION" id="ep3">
                                                                            <label class="form-check-label" for="ep3">CASCO DE PROTECCION</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CASCO CON PANTALLA" id="ep4">
                                                                            <label class="form-check-label" for="ep4">CASCO CON PANTALLA</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MANOPLAS SOLDADURA" id="ep5">
                                                                            <label class="form-check-label" for="ep5">MANOPLAS SOLDADURA</label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTE PROT. MEC." id="ep6">
                                                                            <label class="form-check-label" for="ep6">GUANTE PROT. MEC</label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES TÉRMICOS" id="ep7">
                                                                            <label class="form-check-label" for="ep7">GUANTES TÉRMICOS</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES LATEX" id="ep8">
                                                                            <label class="form-check-label" for="ep8">GUANTES LATEX</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES PROT. QUIM." id="ep9">
                                                                            <label class="form-check-label" for="ep9">GUANTES PROT. QUIM.</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GAFAS ANTIPROYECCIONES" id="ep10">
                                                                            <label class="form-check-label" for="ep10">GAFAS ANTIPROYECCIONES</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PANTALLA PROTECCION FACIAL" id="ep11">
                                                                            <label class="form-check-label" for="ep11">PANTALLA PROTECCION FACIAL</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PANTALLA SOLDADURA" id="ep12">
                                                                            <label class="form-check-label" for="ep12">PANTALLA SOLDADURA</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MASCARA VAPOR ORG./GAS." id="ep13">
                                                                            <label class="form-check-label" for="ep13">MASCARA VAPOR ORG./GAS.</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MASCARILLA PARTICULAS" id="ep14">
                                                                            <label class="form-check-label" for="ep14">MASCARILLA PARTICULAS</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PROTECCION AUDITIVA" id="ep15">
                                                                            <label class="form-check-label" for="ep15">PROTECCION AUDITIVA</label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="ARNES ANTICAIDAS" id="ep16">
                                                                            <label class="form-check-label" for="ep16">ARNES ANTICAIDAS</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CHALECO SALVAVIDAS" id="ep17">
                                                                            <label class="form-check-label" for="ep17">CHALECO SALVAVIDAS</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CHALECO ALTA VISIBILIDAD" id="ep18">
                                                                            <label class="form-check-label" for="ep18">CHALECO ALTA VISIBILIDAD</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CREMA SOLAR" id="ep19">
                                                                            <label class="form-check-label" for="ep19">CREMA SOLAR</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="epis_pc[]" value="ROPA DE AGUA" id="ep20">
                                                                            <label class="form-check-label" for="ep20">ROPA DE AGUA</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            </br>
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <div class="form-group row">
                                                                        <label for="equipos_pc" class="col-form-label col-sm-2">Equipos de trabajo:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="equipos_pc" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <div class="form-group row">
                                                                        <label for="prodquim_pc" class="col-form-label col-sm-2">Productos Quimicos:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="prodquim_pc" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card card-outline card-primary" id="headingthree">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i>Factores psicosociales</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="collapseTwo">
                                                        <div class="card-body">


                                                            <!-- Equipos de Protección Individual -->
                                                            <!-- Equipos de Protección Individual -->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Factor psicosocial</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Elevado esfuerzo atencion" id="ep1">
                                                                            <label class="form-check-label" for="ep1">Carga Mental: Elevado esfuerzo atencion</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Cantidad de información" id="ep2">
                                                                            <label class="form-check-label" for="ep2">Carga Mental: Cantidad de información</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Complejidad de la información" id="ep3">
                                                                            <label class="form-check-label" for="ep3">Carga Mental: Complejidad de la información</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Tiempo limitado para las tareas" id="ep4">
                                                                            <label class="form-check-label" for="ep4">Carga Mental: Tiempo limitado para las tareas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Contenido del trabajo: Trabajo monotono y/o repetitivo" id="ep5">
                                                                            <label class="form-check-label" for="ep5">Contenido del trabajo: Trabajo monotono y/o repetitivo</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Autonomia personal: Imposibilidad ausentarse del puesto" id="ep6">
                                                                            <label class="form-check-label" for="ep6">Autonomia personal: Imposibilidad ausentarse del puesto</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Autonomia personal: Imposibilidad de control sobre el ritmo" id="ep7">
                                                                            <label class="form-check-label" for="ep7">Autonomia personal: Imposibilidad de control sobre el ritmo</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo a turnos" id="ep8">
                                                                            <label class="form-check-label" for="ep8">Organización del Trabajo: Trabajo a turnos</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo nocturno" id="ep9">
                                                                            <label class="form-check-label" for="ep9">Organización del Trabajo: Trabajo nocturno</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo en solitario" id="ep10">
                                                                            <label class="form-check-label" for="ep10">Organización del Trabajo: Trabajo en solitario</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-outline card-primary" id="headingfour">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i>Metodos operativos</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseTwo">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="collapsefour" class="collapse" aria-labelledby="collapsefour">
                                                        <div class="card-body">

                                                            <div class="col-md-5">
                                                                <button type="button" class="btn btn-sm btn-primary" onclick="toggleCheckboxes()">Seleccionar/Deseleccionar Todos</button>
                                                            </div>
                                                            <!-- Equipos de Protección Individual -->
                                                            <!-- Equipos de Protección Individual -->
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="">Métodos operativos específicos</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Mantenimiento preventivo" id="ep1">
                                                                            <label class="form-check-label" for="ep1">Mantenimiento preventivo</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Comprobación de energías" id="ep2">
                                                                            <label class="form-check-label" for="ep2">Comprobación de energías</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Consignación de equipos de Tº" id="ep3">
                                                                            <label class="form-check-label" for="ep3">Consignación de equipos de Tº</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Rampas de las embarcaciones" id="ep4">
                                                                            <label class="form-check-label" for="ep4">Rampas de las embarcaciones</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en espacios cerrados" id="ep5">
                                                                            <label class="form-check-label" for="ep5">Trabajos en espacios cerrados</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Ordenam. amarre y atraque" id="ep6">
                                                                            <label class="form-check-label" for="ep6">Ordenam. amarre y atraque</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Acceso embarcaciones" id="ep7">
                                                                            <label class="form-check-label" for="ep7">Acceso embarcaciones</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Limpieza de embarcaciones" id="ep8">
                                                                            <label class="form-check-label" for="ep8">Limpieza de embarcaciones</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Conexiones electr. y agua en embarcaciones" id="ep9">
                                                                            <label class="form-check-label" for="ep9">Conexion electr. y agua en emb.</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tratamientos de superficies O.V." id="ep10">
                                                                            <label class="form-check-label" for="ep10">Tratamientos de superficies O.V.</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Traslado embarcación a área reparado" id="ep11">
                                                                            <label class="form-check-label" for="ep11">Traslado emb. a área reparado</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Apuntalamiento embarcaciones" id="ep12">
                                                                            <label class="form-check-label" for="ep12">Apuntalamiento embarcaciones</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tratamiento superficies emb. fondeadas" id="ep13">
                                                                            <label class="form-check-label" for="ep13">Tº superfic. emb. fondeadas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Manipulación de bidones" id="ep14">
                                                                            <label class="form-check-label" for="ep14">Manipulación de bidones</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso herramientas manuales" id="ep15">
                                                                            <label class="form-check-label" for="ep15">Uso herramientas manuales</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de herramientas portátiles" id="ep16">
                                                                            <label class="form-check-label" for="ep16">Uso de herramientas portátiles</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de escaleras manuales" id="ep17">
                                                                            <label class="form-check-label" for="ep17">Uso de escaleras manuales</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios de borriquetas" id="ep18">
                                                                            <label class="form-check-label" for="ep18">Andamios de borriquetas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios tubulares" id="ep19">
                                                                            <label class="form-check-label" for="ep19">Andamios tubulares</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso Plataformas elevadoras móviles personas" id="ep20">
                                                                            <label class="form-check-label" for="ep20">Uso PEMP</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos verticales" id="ep21">
                                                                            <label class="form-check-label" for="ep21">Trabajos verticales</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en cubiertas" id="ep22">
                                                                            <label class="form-check-label" for="ep22">Trabajos en cubiertas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Operativa en bodega" id="ep23">
                                                                            <label class="form-check-label" for="ep23">Operativa en bodega</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en fosos" id="ep24">
                                                                            <label class="form-check-label" for="ep17">Trabajos en fosos</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios de borriquetas" id="ep25">
                                                                            <label class="form-check-label" for="ep25">Trabajos de soldadura</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos eléctricos" id="ep26">
                                                                            <label class="form-check-label" for="ep26">Trabajos eléctricos</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Guía uso de guantes" id="ep27">
                                                                            <label class="form-check-label" for="ep27">Guía uso de guantes</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="(manual de gestión de buque)" id="ep28">
                                                                            <label class="form-check-label" for="ep28">(manual de gestión de buque)</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Métodos operativos generales</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value=">Prevención de accidentes in itinere" id="ep29">
                                                                            <label class="form-check-label" for="ep29">Prevención de accidentes in itinere</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Vigilancia de la salud" id="ep30">
                                                                            <label class="form-check-label" for="ep30">Vigilancia de la salud</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Golpe de Calor- RAD UV" id="ep31">
                                                                            <label class="form-check-label" for="ep31">Golpe de Calor- RAD UV</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tr. sensibles: embarazadas, menores o trab. Con rest. médi" id="ep32">
                                                                            <label class="form-check-label" for="ep32">Tr. sensibles: embarazadas, menores o trab. Con rest. médic</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="EPIS" id="ep33">
                                                                            <label class="form-check-label" for="ep33">EPIS</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Sistema de etiquetado Productos químicos" id="ep34">
                                                                            <label class="form-check-label" for="ep34">Sistema de etiquetado Productos químicos</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Manipulación manual de cargas" id="ep35">
                                                                            <label class="form-check-label" for="ep35">Manipulación manual de cargas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso escaleras de mano" id="ep36">
                                                                            <label class="form-check-label" for="ep36">Uso escaleras de mano</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Diseño seguro de trabajos" id="ep37">
                                                                            <label class="form-check-label" for="ep37">Diseño seguro de trabajos</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de herramientas manuales" id="ep38">
                                                                            <label class="form-check-label" for="ep38">Uso de herramientas manuales</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!--fin modal-->


                </div>
                <div class="card-body">
                    <table id="example1" class="table compact hover">
                        <colgroup>

                            <col width="1%">
                            <col width="10%">
                            <col width="85%">
                            <col width="4%">


                        </colgroup>
                        <thead class="table-secondary">
                            <tr>


                                <th style="text-align: left">#</th>
                                <th style="text-align: left">Puesto / Area</th>
                                <th style="text-align: left">Descripcion</th>
                                <th style="text-align: center"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador = 0;
                            $hoy = date('Y-m-d'); // Obtener la fecha actual
                            $mes_anterior = '';

                            foreach ($puestoareas_datos as $puestoareas_dato) {
                                $contador++;
                                $id_puestocentro = $puestoareas_dato['id_puestocentro'];

                            ?>
                                <tr class="<?php echo $highlight_class; ?>">
                                    <td style="text-align: left"><b><?php echo $contador ?></b></td>

                                    <td style="text-align: left"><?php echo $puestoareas_dato['puestoarea_pc']; ?></td>
                                    <td style="text-align: left"><?php echo $puestoareas_dato['descripcion_pc']; ?></td>
                                    <td style="text-align: left">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="show_puestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>&id_evaluacion=<?php echo $id_evaluacion; ?>">Ver</a>
                                                <a class="dropdown-item" href="../../app/controllers/evaluacion/delete_puestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>&id_evaluacion=<?php echo $id_evaluacion; ?>">Eliminar</a>
                                                <a class="dropdown-item" href="../../app/controllers/evaluacion/duplicar_puestocentro.php?id_puestocentro=<?php echo $id_puestocentro; ?>&id_evaluacion=<?php echo $id_evaluacion; ?>">Duplicar</a>
                                            </div>
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
    </div>

    <?php
    include('../../admin/layout/parte2.php');
    include('../../admin/layout/mensaje.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#epis_pc').select2({
                dropdownParent: $('#modal-nuevopuestoarea .modal-body'),
                theme: 'bootstrap4',
            });
        });


        $(function() {
            $("#example1").DataTable({
                "pageLength": 15,
                "order": [
                    [9, 'desc'],
                    [7, "asc"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de MAX total Usuarios)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Usuarios",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,

                buttons: [{
                        extend: "collection",
                        text: "Reportes",
                        orientation: "landscape",
                        buttons: [{
                                text: "Copiar",
                                extend: "copy"
                            },
                            {
                                extend: "pdf"
                            },
                            {
                                extend: "csv"
                            },
                            {
                                extend: "excel"
                            },
                            {
                                text: "Imprimir",
                                extend: "print"
                            }
                        ]
                    },
                    {
                        extend: "colvis",
                        text: "Visor de columnas",
                        /*collectionLayout: "fixed three-column" */

                    }
                ],
            }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
        });

        function toggleCheckboxes() {
            // Obtener todos los checkboxes
            var checkboxes = document.querySelectorAll('input[name="metodos_pc[]"]');
            var allChecked = true;

            // Verificar si todos están seleccionados
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            // Alternar entre seleccionar o deseleccionar todos
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !allChecked;
            });
        }
    </script>