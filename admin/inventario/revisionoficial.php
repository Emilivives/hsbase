<?php
session_start();
include('../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}
include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/inventario/listado_revisionoficial_maq.php');
include('../../app/controllers/inventario/listado_maquinas.php');


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

      .badge-wh-1 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 16px;
            font-weight: normal;
            color: #fff;
            background-color: #ec224a;
            line-height: 2;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 3px;
        }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Revisiones oficiales de equipos</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Equipos</a></li>
                    <li class="breadcrumb-item active">Revisiones oficiales</li>
                </ol>
            </div><!-- /.col -->
            <hr class="border-primary">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


</html>



<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header col-md-12">
                <h3 class="card-title"><b>Listado</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#nuevo-revisionoficial">NUEVA REVISION OFICIAL</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="nuevo-revisionoficial">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#004080;color:white">
                                <h5 class="modal-title" id="modal-revisionoficial">Nuevo Revision oficial</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/inventario/create_revisionoficial.php" method="post" enctype="multipart/form-data">


                                    <div class="well">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <label for="" class="col-form-label col-sm-3">Tipo / Marca / SN</label>
                                                    <div class="col-sm-7">
                                                        <select name="id_equipo" id="" class="form-control" required>
                                                            <option value="">--Seleccione Equipo--</option>
                                                            <?php
                                                            foreach ($maquinas_datos as $maquinas_dato) { ?>
                                                                <option value="<?php echo $maquinas_dato['id_maquina']; ?>">
                                                                    <?php echo $maquinas_dato['nombre_tm']; ?> | <?php echo $maquinas_dato['marca_maq']; ?>| <?php echo $maquinas_dato['modelo_maq']; ?> | <?php echo $maquinas_dato['numserie_maq']; ?>
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
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <label for="tipo_revof" class="col-form-label col-sm-3">Tipo Revision:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="tipo_revof" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                        <div class="row">

                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="" class="col-form-label col-sm-5">Fecha revisión</label>

                                                    <div class="col-sm-6">
                                                        <input type="date" name="fecha_revof" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group row">
                                                    <label for="" class="col-form-label col-sm-5">Valido hasta</label>

                                                    <div class="col-sm-7">
                                                        <input type="date" name="caducidad_revof" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-1"> </div>
                                            <div class="col-sm-3">
                                                <div class="form-group row align-items-center">
                                                    <label for="nombre" class="col-form-label col-sm-4">Vigente:</label>
                                                    <div class="col-sm-6 d-flex align-items-center">
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="vigente_revof" id="flexRadioDefault3" value="1" checked>
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <b>SI</b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="vigente_revof" id="flexRadioDefault4" value="0">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <b>NO</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <label for="proveedor_revof" class="col-form-label col-sm-3">Proveedor:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="proveedor_revof" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>





                                        <div class="row">
                                            <div class="form-group row col-md-12">
                                                <label for="" class="col-form-label col-sm-2">Observaciones:</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="4" name="observaciones_revof" class="form-control"></textarea>
                                                </div>
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

                    <!--fin modal-->


                </div>

                <div class="card-body">
                    <table id="example1" class="table stripe compact hover table-condensed">
                        <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="10%">
                            <col width="8%">
                            <col width="8%">
                            <col width="7%">
                            <col width="12%">
                            <col width="10%">
                            <col width="3%">
                            <col width="7%">
                            <col width="7%">
                            <col width="3%">

                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Tipo</th>
                                <th style="text-align: left">Clase</th>
                                <th style="text-align: center">Marca</th>
                                <th style="text-align: left">Modelo</th>
                                <th style="text-align: left">S/N</th>
                                <th style="text-align: left">Centro tº</th>
                                <th style="text-align: left">Tipo rev.</th>
                                <th style="text-align: left">Vigente</th>
                                <th style="text-align: left">Fecha Rev. </th>
                                <th style="text-align: left">Caduca</th>
                                <th style="text-align: left">ACCIONES

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($listarevisionoficial_datos as $listarevisionoficial_dato) {
                                $contador = $contador + 1;
                                $id_maquina = $listarevisionoficial_dato['id_maquina'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['nombre_tm']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['clase_tm']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['marca_maq']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['modelo_maq']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['numserie_maq']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $listarevisionoficial_dato['nombre_cen']; ?></b></td>
                                    <td style="text-align: left"><?php echo $listarevisionoficial_dato['tipo_revof']; ?></td>
                                    <td style="text-align: left"><?php $listarevisionoficial_dato['vigente_revof']; ?>
                                        <?php if ($listarevisionoficial_dato['vigente_revof'] == "1") { ?>
                                            <span class='badge badge-success'>Si</span>
                                        <?php
                                        } else if ($listarevisionoficial_dato['vigente_revof'] == "0") { ?>
                                            <span class='badge badge-danger'>No</span>

                                        <?php                       }
                                        ?>
                                    </td>
                                    <td style="text-align: left"><b><?php echo date('d/m/Y', strtotime($listarevisionoficial_dato['fecha_revof'])); ?></b></td>
                                    <td style="text-align: left">
                                        <?php
                                        // Convertir la fecha de caducidad a formato d/m/Y
                                        $caducidad = date('d/m/Y', strtotime($listarevisionoficial_dato['caducidad_revof']));

                                        // Comparar la fecha de caducidad con la fecha actual
                                        $fecha_actual = date('Y-m-d');  // Formato Y-m-d para la comparación

                                        // Si la fecha de caducidad es anterior a la fecha actual, agregar clase 'rojo'
                                        if (strtotime($listarevisionoficial_dato['caducidad_revof']) < strtotime($fecha_actual)) {
                                            echo "<span class='badge-wh-1'><b>$caducidad</b></span>";  // Si la fecha ha pasado, mostrar en rojo
                                        } else {
                                            echo "<b>$caducidad</b>";  // Si la fecha no ha pasado, mostrar normalmente
                                        }
                                        ?>
                                    </td>
                                  
                                    <td style="text-align: center">
                                        <!-- Botón para cargar registros asociados -->
                                        <button class="btn btn-sm btn-info show-records" data-id="<?php echo $id_maquina; ?>">
                                            Ver registros
                                        </button>
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


</div>
<div class="row">
    <!-- Contenedor para mostrar la tabla de registros asociados -->
    <div id="relatedRecords" style="margin-top: 20px; display: none;">
        <h5>REVISIONES REALIZADAS AL EQUIPO: <?php ?></h5>
        <table id="relatedTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Proveedor</th>
                    <th>Fecha Rev.</th>
                    <th>Caducidad</th>
                    <th>Vigente</th>
                    <th>Observaciones / Normativa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán dinámicamente los registros -->
            </tbody>
        </table>
    </div>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Capturar clic en los botones "Ver registros"
        document.querySelectorAll('.show-records').forEach(button => {
            button.addEventListener('click', function() {
                const id_maquina = this.dataset.id;

                // Realizar la solicitud AJAX
                fetch('detallesrevisionoficial.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_maquina: id_maquina
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#relatedTable tbody');
                        const relatedRecords = document.getElementById('relatedRecords');

                        // Limpiar contenido anterior
                        tableBody.innerHTML = '';

                        // Verificar si hay datos
                        if (data.length > 0) {
                            // Poblar la tabla con los registros
                            data.forEach(record => {
                                const row = `
                            <tr data-id="${record.id_revisionoficial}">
                                <td style="width: 5%;">${record.id_revisionoficial}</td>
                                <td contenteditable="true" class="editable" style="width: 15%;">${record.tipo_revof}</td>
                                <td contenteditable="true" class="editable" style="width: 15%;">${record.proveedor_revof}</td>
                                <td contenteditable="true" input type="date" class="editable" style="width: 10%;">${record.fecha_revof}</td>
                                <td contenteditable="true" input type="date" class="editable" style="width: 10%;">${record.caducidad_revof}</td>
                                <td style="width: 5%;">
                                    <select class="editable">
                                        <option value="1" ${record.vigente_revof == 1 ? 'selected' : ''}>Sí</option>
                                        <option value="0" ${record.vigente_revof == 0 ? 'selected' : ''}>No</option>
                                    </select>
                                </td>
                                <td contenteditable="true" class="editable" style="width: 20%;">${record.observaciones_revof}</td>
                                <td style="width: 10%;">
                                    <button class="btn btn-sm btn-success save-row">Guardar</button>
                                    <button class="btn btn-sm btn-danger delete-row">Eliminar</button>

                                </td>
                            </tr>
                        `;
                                tableBody.insertAdjacentHTML('beforeend', row);
                            });

                            // Añadir eventos al botón Guardar de cada fila
                            document.querySelectorAll('.save-row').forEach(button => {
                                button.addEventListener('click', saveRow);
                            });
                        } else {
                            tableBody.innerHTML = '<tr><td colspan="8">No se encontraron registros.</td></tr>';
                        }

                        // Mostrar la tabla secundaria
                        relatedRecords.style.display = 'block';
                    })
                    .catch(err => console.error('Error:', err));
            });
        });

        // Función para guardar los cambios de una fila
        function saveRow() {
            const row = this.closest('tr');
            const id = row.dataset.id;

            // Recopilar los datos editados
            const updatedData = {
                id_revisionoficial: id,
                tipo_revof: row.children[1].textContent.trim(),
                proveedor_revof: row.children[2].textContent.trim(),
                fecha_revof: row.children[3].textContent.trim(),
                caducidad_revof: row.children[4].textContent.trim(),
                vigente_revof: row.children[5].querySelector('select').value,
                observaciones_revof: row.children[6].textContent.trim()
            };

            // Enviar los datos al servidor
            fetch('actualizar_revision.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updatedData)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Cambios guardados correctamente.');
                        location.reload(); // Recarga toda la página
                    } else {
                        alert('Error al guardar los cambios.');
                    }
                })
                .catch(err => console.error('Error:', err));
        }

    });

    // Añadir evento de clic para el botón Eliminar
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-row')) {
            const row = event.target.closest('tr');
            const id = row.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Enviar la solicitud para eliminar el registro
                fetch('eliminar_revisionoficial.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_revisionoficial: id
                        })
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            // Eliminar la fila de la tabla
                            row.remove();
                            alert('Registro eliminado correctamente.');
                        } else {
                            alert('Error al eliminar el registro.');
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        alert('Ocurrió un error al intentar eliminar el registro.');
                    });
            }
        }
    });
</script>



<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "order": [
                [8, 'desc'],
                [9, "asc"]
            ],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ equipos de trabajo",
                "infoEmpty": "Mostrando 0 a 0 de 0 acciones PRL",
                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Maquinas",
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
                            extend: "pdf",
                            orientation: 'landscape'
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