<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_evaluacion = $_GET['id_evaluacion'];
include('../../app/controllers/evaluacion/datos_evaluacion.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/evaluacion/listado_puestoarea.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');

?>


<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">



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


                        <a class="btn btn-text-right btn-outline-dark btn-sm" title="Ver anterior" href="../actividad/proyectos.php">Volver</a>
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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevopuestoarea">Añadir Puesto / Area</button>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Evaluacion: <?php echo $codigo_er ?></label>
                                            <input type="text" value="<?php echo $id_evaluacion ?>" name="evaluacion_pc" class="form-control" hidden>

                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="">Puesto / Area</label>
                                            <input type="text" name="puestoarea_pc" class="form-control" required>
                                        </div>
                                    </div>
                                   

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <textarea class="form-control" name="descripcion_pc" rows="10"></textarea>
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

                <!--fin modal-->


            </div>
            <div class="card-body">
                <table id="example1" class="table compact hover">
                    <colgroup>

                        <col width="5%">
                        <col width="8%">
                        <col width="45%">
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="7%">
                        <col width="7%">
                        <col width="7%">
            

                    </colgroup>
                    <thead class="table-secondary">
                        <tr>


                            <th style="text-align: left">#</th>
                            <th style="text-align: left">Puesto / Area</th>
                            <th style="text-align: left">Descripcion</th>
                            <th style="text-align: left">nº Riesgos</th>
                            <th style="text-align: left">Epis</th>
                            <th style="text-align: left">Maquinaria</th>
                            <th style="text-align: left">Prod Quim.</th>
                            <th style="text-align: left">Procedim.</th>
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
                                <td style="text-align: left"><b><?php echo $puestoareas_dato['evaluacion_pc']; ?></b></td>
                               
                                <td style="text-align: left"><?php echo $puestoareas_dato['puestoarea_pc']; ?></td>
                                <td style="text-align: left"><?php echo $puestoareas_dato['descripcion_pc']; ?></td>
                                <td style="text-align: left"><?php echo $id_puestocentro ?></td>
                                <td style="text-align: left"></td>
                                <td style="text-align: left"></td>
                                <td style="text-align: left"></td>
                                <td style="text-align: left"></td>
                                <dl>

                                    <td style="text-align: center">
                                    <a href="show_puestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>& id_evaluacion=<?php echo $id_evaluacion; ?>" class="btn btn-warning btn-sm" title="Accede"> <i class="bi bi-folder"></i> Ver</a></a>

                                    </td>
                                </dl>


                              
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

<script>
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
</script>