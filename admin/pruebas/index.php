<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
include('../../app/controllers/maestros/empresas/listado_empresas.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<style>
    .dropdown-font-size {
        font-size: 12px;
    }

    .btn-font-size {
        font-size: 12px;
    }
</style>



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Acciones PRL (correctoras o preventivas)</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                    <li class="breadcrumb-item active">Acciones PRL</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<div class="col-md-12">
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

            <!-- Modal -->


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


            <!--fin modal-->



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
                    foreach ($citasrm as $citasrm_dato) {
                        $contadorcitas = $contadorcitas + 1;
                        $id_citarm = $citasrm_dato['id_citarm'];
                    ?>

                        <tr>
                            <td style="text-align: left"><?php echo $citasrm_dato['nombre_tr']; ?></td>
                            <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($citasrm_dato['fecha_crm'])) ?></td>
                            <td style="text-align: center">
                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Email Cita RM" data-target="#modal-emailcita<?php echo $id_citarm; ?>"><i class="fa-regular fa-envelope"></i></i></button>
                                    <a href="update.php?id_usuario=<?php echo $id_usuario ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <a href="../../app/controllers/reconocimientos/delete_cita.php?id_citarm=<?php echo $id_citarm; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar cita RM"><i class="bi bi-trash-fill"></i> </a>

                                </div>
                            </td>


                            <div class="modal fade" id="modal-emailcita<?php echo $id_citarm; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:gold">
                                            <h5 class="modal-title" id="modal-emailcita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $citasrm_dato['nombre_tr'] ?> - Detalles</h5>
                                            <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="contactoForm">

                                                <div class="row">

                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $citasrm_dato['nombre_tr'] ?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $citasrm_dato['dni_tr'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $citasrm_dato['nombre_cat'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $citasrm_dato['nombre_cen'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group row">
                                                            <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $citasrm_dato['razonsocial_emp'] ?>" disabled>
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
                                                        <textarea class="form-control" id="anotaciones_crm" name="anotaciones_crm" rows="6"></textarea>
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



                                <!--fin modal-->


                        </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </div>


</div>


<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>

<!--<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>-->

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
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

<script>
    $(document).ready(function() {
        $('#contactoForm').submit(function(e) {
            e.preventDefault();

            var nombre_tr = $('#nombre_tr').val();
            var dni_tr = $('#dni_tr').val();
            var categoria_tr = $('#categoria_tr').val();
            var centro_tr = $('#centro_tr').val();
            var destinatario = $('#destinatario').val();
            var anotaciones_crm = $('#anotaciones_crm').val();

          

            // Datos del formulario
            var datos = {
                nombre_tr: nombre_tr,
                dni_tr: dni_tr,
                categoria_tr: categoria_tr,
                centro_tr: centro_tr,
                destinatario: destinatario,
                anotaciones_crm: anotaciones_crm
            };

            // Enviar datos a través de AJAX
            $.ajax({
                type: 'POST',
                url: '../../app/controllers/reconocimientos/enviar_email.php',
                data: datos,
                success: function(response) {
                    alert(response);
                    $('#contactoForm')[0].reset();
                },
                error: function() {
                    alert('Hubo un error al enviar el correo');
                }
            });
        });
    });
</script>