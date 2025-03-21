<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');

include('../../../app/controllers/maestros/centros/listado_centros.php');
include('../../../app/controllers/maestros/empresas/listado_empresas.php');
include('../../../app/controllers/maestros/tipocentros/listado_tipocentros.php');
?>
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>CENTROS</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Centros</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">


    <div class="row">

        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Centros registrados</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <div class="btn-text-right">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoModalcentro"><i class="bi bi-plus-circle"></i> Añadir Nuevo Centro</a>
                    </div>
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


                                        </div>

                                    </form>
                                    <!-- Pie del Modal -->

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Nombre centro</th>
                                <th style="text-align: center">Empresa</th>
                                <th style="text-align: center">Tipo centro</th>
                                <th style="text-align: center">Dirección centro</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($centros_datos as $centros_dato) {
                                $contador = $contador + 1;
                                $id_centro = $centros_dato['id_centro'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $centros_dato['nombre_cen']; ?></td>
                                    <td><?php echo $centros_dato['nombre_emp']; ?></td>
                                    <td><?php echo $centros_dato['nombre_tc']; ?></td>
                                    <td><?php echo $centros_dato['direccion_cen']; ?></td>
                                    <td><?php $centros_dato['estado_cen'];
                                        if ($centros_dato['estado_cen'] == 1) { ?> <span class='badge badge-success'>ACTIVO</span><?php
                                                                                                                                } else { ?> <span class='badge badge-danger'>INACTIVO</span> <?php } ?> </td>
                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="../../../app/controllers/maestros/centros/delete.php?id_centro=<?php echo $id_centro; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar empresa?')" title="Eliminar empresa"><i class="bi bi-trash-fill"></i></a>
                                            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" title="Modificar detalles" data-bs-target="#updateModalcentro<?php echo $id_centro; ?>"><i class="bi bi-pencil-square"></i> Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal for each center - MOVED INSIDE THE LOOP -->
                                <div class="modal fade" id="updateModalcentro<?php echo $id_centro; ?>" tabindex="-1" aria-labelledby="updateModalcentro<?php echo $id_centro; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary-subtle text-center">
                                                <h3 class="modal-title w-100 text-center" id="updateModalcentro<?php echo $id_centro; ?>">
                                                    <i class="bi bi-building"> <i class='fas fa-ship'></i></i> <b> EDITAR CENTRO</b>
                                                </h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="../../../app/controllers/maestros/centros/update.php" method="post">
                                                    <input type="hidden" name="id_centro" value="<?php echo $centros_dato['id_centro']; ?>">

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="estado_cen" id="flexRadioDefault3" value="1" <?php if ($centros_dato['estado_cen'] == "1") {
                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                } ?>>
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    <b><?php $centros_dato['estado_cen'];
                                                                        if ($centros_dato['estado_cen'] == 1) { ?>
                                                                            <span class='badge badge-success'>ACTIVO</span>
                                                                        <?php } else {
                                                                            echo "Activo";
                                                                        }
                                                                        ?></b>

                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="estado_cen" id="flexRadioDefault4" value="0" <?php if ($centros_dato['estado_cen'] == "0") {
                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                } ?>>
                                                                <label class="form-check-label" for="flexRadioDefault4">
                                                                    <b><?php $centros_dato['estado_cen'];
                                                                        if ($centros_dato['estado_cen'] == 0) { ?>
                                                                            <span class='badge badge-danger'>BAJA</span>
                                                                        <?php } else {
                                                                            echo "Baja";
                                                                        }
                                                                        ?></b>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Nombre Centro <b>*</b></label>
                                                                <input type="text" name="nombre_cen" class="form-control" value="<?php echo htmlspecialchars($centros_dato['nombre_cen']); ?>" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Empresa</label>
                                                                <select name="empresa_cen" class="form-control">
                                                                    <?php
                                                                    if (empty($empresas_datos)) {
                                                                        echo "<option>No hay empresas disponibles</option>";
                                                                    } else {
                                                                        foreach ($empresas_datos as $empresas_dato) {
                                                                            $id_empresa = $empresas_dato['id_empresa'];
                                                                            $selected = ($centros_dato['id_empresa'] == $id_empresa) ? 'selected' : '';
                                                                            echo "<option value='$id_empresa' $selected>" . htmlspecialchars($empresas_dato['nombre_emp']) . "</option>";
                                                                        }
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
                                                                    if (empty($tipocentros_datos)) {
                                                                        echo "<option>No hay tipos de centro disponibles</option>";
                                                                    } else {
                                                                        foreach ($tipocentros_datos as $tipocentros_dato) {
                                                                            $id_tipocentro = $tipocentros_dato['id_tipocentro'];
                                                                            $selected = ($centros_dato['id_tipocentro'] == $id_tipocentro) ? 'selected' : '';
                                                                            echo "<option value='$id_tipocentro' $selected>" . htmlspecialchars($tipocentros_dato['nombre_tc']) . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <label for="">Dirección <b>*</b></label>
                                                                <input type="text" name="direccion_cen" class="form-control" value="<?php echo htmlspecialchars($centros_dato['direccion_cen']); ?>" required>
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
                                <!-- End Modal -->
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card card-secondary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Empresas registradas</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <div class="btn-text-right">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoModalempresa"><i class="bi bi-plus-circle"></i> Añadir Empresa</a>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Nombre empresa</th>
                                <th style="text-align: center">CIF</th>
                                <th style="text-align: center">Dirección empresa</th>
                                <th style="text-align: center">Modalidad PRL</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($empresas_datos as $empresas_dato) {
                                $contador = $contador + 1;
                                $id_empresa = $empresas_dato['id_empresa'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $empresas_dato['nombre_emp']; ?></td>
                                    <td><?php echo $empresas_dato['cif_emp']; ?></td>
                                    <td><?php echo $empresas_dato['direccion_emp']; ?></td>
                                    <td><?php echo $empresas_dato['modalidadprl_emp']; ?></td>



                                    <td style="text-align: center">
                                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="Basic mixed styles example">
                                            <a href="updateempresa.php?id_empresa=<?php echo $id_empresa ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                                            <a href="../../../app/controllers/maestros/empresas/delete.php?id_empresa=<?php echo $id_empresa; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar empresa?')" title="Eliminar empresa"><i class="bi bi-trash-fill"></i></a>


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

</div>

<!--incluimos el formulario modal-->

<?php include 'nuevoModalempresa.php'; ?>
<?php include 'nuevoModalcentro.php'; ?>
</div>


<?php
include('../../../admin/layout/parte2.php');
include('../../../admin/layout/mensaje.php');
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