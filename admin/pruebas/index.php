<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
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
    <form id="contactoForm">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group row">
                    <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" id="nombre_tr" name="nombre_tr" value="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group row">
                    <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                    <div class="col-sm-5">
                        <input type="text" id="dni_tr" name="dni_tr" class="form-control">
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group row">
                    <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                    <div class="col-sm-8">
                        <input type="text" id="categoria_tr" name="categoria_tr" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group row">
                    <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                    <div class="col-sm-8">
                        <input type="text" id="centro_tr" name="centro_tr" class="form-control">
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
                    <input type="hidden" id="nombre_ei" name="nombre_ei" value="">
                </div>
                <?php echo '<option value="'.$emailsinteres_dato['id_emailinteres'].'-'.$emailsinteres_dato['nombre_ei'].'"></option>';?>
            </div>
        </div>
        </br>
        <hr>
        <div class="row">
            <div class="form-group">
                <label for="">Anotaciones / restricciones</label>
                <textarea class="form-control" name="anotaciones_crm" id="anotaciones_crm" rows="6"></textarea>
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