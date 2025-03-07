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
include('../../app/controllers/maestros/epis_equipos_pq/listado_epi.php');
include('../../app/controllers/inventario/listado_epis.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');



?>

<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href=https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css>

<style>
    .dropdown-font-size {
        font-size: 12px;
    }

    .btn-font-size {
        font-size: 12px;
    }

    .small-box-short {
        height: 80px;
        /* Ajusta la altura según sea necesario */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        /* Remueve el padding para que no agregue altura */
    }

    .small-box-short .inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0;
        /* Remueve cualquier margen */
    }

    .small-box-short .inner h2 {
        font-size: 1.5rem;
        /* Ajusta el tamaño de la fuente */
        margin: 0;
        /* Remueve cualquier margen */
    }

    .small-box-short .inner p {
        font-size: 1rem;
        /* Ajusta el tamaño de la fuente */
        margin: 0;
        /* Remueve cualquier margen */
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Equipos de proteccion individual (EPIs)</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                    <li class="breadcrumb-item active">EPIS</li>
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
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevoepi">NUEVO EQUIPO</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="modal-nuevoepi">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:whitesmoke">
                                <h5 class="modal-title" id="modal-nuevoepi"><i class="bi bi-plus-lg"></i> Nuevo EPI</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/inventario/create_epi.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                <label style="text-align: center; color: #ffffff;">
                                                    <h5 style="margin: 0;">Detalles del EPI:</h5>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group row col-md-6">
                                            <!-- Clase EPI -->
                                            <label for="clase_epi" class="col-form-label col-sm-2">Clase</label>
                                            <div class="col-sm-8">
                                                <select name="clase_epi" id="clase_epi" class="form-select">
                                                    <option value="">Seleccione</option>
                                                    <option value="EPI - Altura">EPI - Altura</option>
                                                    <option value="EPI - Respiracion">EPI - Respiracion</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row col-md-6">
                                            <!-- Tipo EPI -->
                                            <label for="centro" class="col-form-label col-sm-2">EPI: *</label>
                                            <div class="col-sm-10">
                                                <select name="tipo_epi" id="btn_centro" class="form-control" required>
                                                    <option value="0">--Seleccione tipo epi--</option>
                                                    <?php foreach ($epis_datos as $epis_dato) { ?>
                                                        <option value="<?php echo $epis_dato['id_epi']; ?>" nombre_cen="<?php echo $epis_dato['nombre_epi']; ?>">
                                                            <?php echo $epis_dato['nombre_epi']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="marca_epi" class="col-form-label col-sm-3">Marca</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="marca_epi" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="modelo_epi" class="col-form-label col-sm-3">Modelo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="modelo_epi" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="numserie_epi" class="col-form-label col-sm-3">Nº Serie</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="numserie_epi" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-5">
                                            <div class="form-group row">
                                                <label for="nombre" class="col-form-label col-sm-4">Año fabricación:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="aniofab_epi" id="aniofab_epi" value="" class="form-control" tabindex="1" placeholder="inserte año" pattern="^[0-9]*$">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group row">
                                                <label for="nombre" class="col-form-label col-sm-4">Fecha caducidad:</label>
                                                <div class="col-sm-5">
                                                    <input type="date" name="vigencia_epi" id="vigencia_epi" class="form-control" tabindex="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group row align-items-center">
                                                <label for="nombre" class="col-form-label col-sm-4">Manual Instrucciones:</label>
                                                <div class="col-sm-6 d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="manual_epi" id="flexRadioDefault3" value="No" checked>
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            <b>NO</b>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="manual_epi" id="flexRadioDefault4" value="Si">
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            <b>SI</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group row align-items-center">
                                                <label for="nombre" class="col-form-label col-sm-4">Marcado CE:</label>
                                                <div class="col-sm-6 d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="marcace_epi" id="flexRadioDefault5" value="No" checked>
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            <b>NO</b>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="marcace_epi" id="flexRadioDefault6" value="Si">
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            <b>SI</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="background-color: #eeeeee; padding: 1px; border-radius: 5px; margin-bottom: 10px;">
                                                <label style="text-align: center; color: #eeeeee;">

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                                                <div class="col-sm-7">
                                                    <select name="centro_epi" id="btn_centro" class="form-control" required>
                                                        <option value="0">--Seleccione centro--</option>
                                                        <?php
                                                        foreach ($centros_datos as $centros_dato) { ?>
                                                            <option value="<?php echo $centros_dato['id_centro']; ?>" nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>">
                                                                <?php echo $centros_dato['nombre_cen']; ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-group row col-md-6">
                                            <label for="clase_epi" class="col-form-label col-sm-2">Estado:</label>
                                            <div class="col-sm-8">
                                                <select name="estado_epi" id="estado_epi" class="form-select">
                                                    <option value="">Seleccione</option>
                                                    <option value="Disponible">Disponible</option>
                                                    <option value="Retirado">Retirado</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group row col-md-12">
                                            <label for="" class="col-form-label col-sm-2">Observaciones:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="observaciones_epi" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                <label style="text-align: center; color: #ffffff;">
                                                    <h5 style="margin: 0;">Imagenes</h5>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="file1">Imagen del Riesgo</label>
                                                    <input type="file" name="img1_epi" class="form-control" id="file1">
                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" title="Reduce tamaño imagen" target="_blank">
                                                        Max. 1Mb
                                                    </a>
                                                    <br>
                                                    <!-- Contenedor para la vista previa de la imagen -->
                                                    <div id="list1">
                                                    </div>
                                                    <script>
                                                        function archivo1(evt) {
                                                            var files = evt.target.files; // FileList object
                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                if (!f.type.match('image.*')) {
                                                                    continue;
                                                                }
                                                                var reader = new FileReader();
                                                                reader.onload = (function(theFile) {
                                                                    return function(e) {
                                                                        document.getElementById('list1').innerHTML = '<img class="thumb thumbnail" src="' + e.target.result + '" width="100%" title="' + escape(theFile.name) + '"/>';
                                                                    };
                                                                })(f);
                                                                reader.readAsDataURL(f);
                                                            }
                                                        }
                                                        document.getElementById('file1').addEventListener('change', archivo1, false);
                                                    </script>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <label for="">Imagen Preventiva </label>
                                                    <input type="file" name="img2_epi" class="form-control" id="file2">
                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" title="Reduce tamaño imagen" role="button" target="_blank">
                                                        Max. 1Mb
                                                    </a>
                                                    <br>
                                                    <output id="list2">
                                                    </output>
                                                    <script>
                                                        function archivo2(evt) {
                                                            var files = evt.target.files; // FileList object
                                                            // Obtenemos la imagen del campo "file2".
                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                //Solo admitimos imágenes.
                                                                if (!f.type.match('image.*')) {
                                                                    continue;
                                                                }
                                                                var reader = new FileReader();
                                                                reader.onload = (function(theFile) {
                                                                    return function(e) {
                                                                        // Insertamos la imagen
                                                                        document.getElementById("list2").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                    };
                                                                })(f);
                                                                reader.readAsDataURL(f);
                                                            }
                                                        }
                                                        document.getElementById('file2').addEventListener('change', archivo2, false);
                                                    </script>
                                                </div>
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
                    <table id="example1" class="table stripe compact hover table-condensed">
                        <colgroup>
                            <col width="3%">
                            <col width="12%">
                            <col width="10%">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">

                            <col width="5%">
                            <col width="3%">


                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Clase</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: left">Marca</th>
                                <th style="text-align: left">Modelo</th>
                                <th style="text-align: left">N/Ser.</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Eval.</th>
                                <th style="text-align: left">Centro</th>
                                <th style="text-align: left">Vigencia</th>
                                <th style="text-align: left">Estado</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($inventarioepis_datos as $inventarioepis_dato) {
                                $contador = $contador + 1;
                                $id_epi = $inventarioepis_dato['id_epi'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $inventarioepis_dato['nombre_epi']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $inventarioepis_dato['clase_epi']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $inventarioepis_dato['marca_epi']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $inventarioepis_dato['modelo_epi']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $inventarioepis_dato['numserie_epi']; ?></b></td>

                                    <td style="text-align: left"><?php echo $inventarioepis_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php $inventarioepis_dato['manual_epi']; ?>
                                        <?php if ($inventarioepis_dato['manual_epi'] == "Si") { ?>
                                            <span class='badge badge-success'>Si</span>
                                        <?php
                                        } else if ($inventarioepis_dato['manual_epi'] == "No") { ?>
                                            <span class='badge badge-danger'>No</span>

                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php $inventarioepis_dato['marcace_epi']; ?>
                                        <?php if ($inventarioepis_dato['marcace_epi'] == "Si") { ?>
                                            <span class='badge badge-success'>Si</span>
                                        <?php
                                        } else if ($inventarioepis_dato['marcace_epi'] == "No") { ?>
                                            <span class='badge badge-danger'>No</span>

                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php echo $inventarioepis_dato['aniofab_epi']; ?></td>

                                    <td style="text-align: left"><?php $inventarioepis_dato['estado_epi']; ?>
                                        <?php if ($inventarioepis_dato['estado_epi'] == "Cerrada") { ?>
                                            <span class='badge badge-success'>Cerrada</span>
                                        <?php
                                        } else if ($inventarioepis_dato['estado_epi'] == "En curso") { ?>
                                            <span class='badge badge-info'>En curso</span>
                                        <?php                       } else if ($inventarioepis_dato['estado_epi'] == "Disponible") { ?>
                                            <span class='badge badge-success'>Diponible</span>
                                        <?php                       } else if ($inventarioepis_dato['estado_epi'] == "Retirado") { ?>
                                            <span class='badge badge-warning'>Retirada</span>
                                        <?php                       } else if ($inventarioepis_dato['estado_epi'] == "Otros") { ?>
                                            <span class='badge badge-secondary'>Otros</span>
                                        <?php                       }
                                        ?>


                                    </td>


                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles" onclick="cargarDetallesepi(<?php echo $id_epi; ?>)"><i class="bi bi-search"></i></button>
                                            <!-- Cambiamos el data-target para que apunte al ID específico de este modal -->
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                title="Inspección Arnés"
                                                <?php if ($inventarioepis_dato['nombre_epi'] === 'ARNÉS ANTICAIDAS') : ?>
                                                data-toggle="modal" data-target="#modal-inspeccion-<?php echo $id_epi; ?>"
                                                <?php else : ?>
                                                onclick="return confirm('La revision es solo para arneses')"
                                                <?php endif; ?>>
                                                <i class="bi bi-clipboard-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" title="Editar"
                                                onclick="cargarDatosEpi(<?php echo $id_epi; ?>)">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <a href="../../app/controllers/inventario/delete_epi.php?id_epi=<?php echo $id_epi; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el epi?')" title="Eliminar epi"><i class="bi bi-trash-fill"></i> </a>

                                        </div>
                                    </td>
                                </tr>

                                <!--inicio modal editar epi-->
                                <div class="modal fade" id="modal-editar-epi">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:whitesmoke">
                                                <h5 class="modal-title" id="modal-editar-epi"><i class="bi bi-pencil-square"></i> Editar EPI</h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="../../app/controllers/inventario/update_epi.php" method="post" enctype="multipart/form-data">
                                                    <!-- Campo oculto para el ID del EPI a editar -->
                                                    <input type="hidden" name="id_epi" id="id_epi_edit">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                                <label style="text-align: center; color: #ffffff;">
                                                                    <h5 style="margin: 0;">Detalles del EPI:</h5>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group row col-md-6">
                                                            <!-- Clase EPI -->
                                                            <label for="clase_epi_edit" class="col-form-label col-sm-2">Clase</label>
                                                            <div class="col-sm-8">
                                                                <select name="clase_epi" id="clase_epi_edit" class="form-select">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="EPI - Altura">EPI - Altura</option>
                                                                    <option value="EPI - Respiracion">EPI - Respiracion</option>
                                                                    <option value="Otros">Otros</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row col-md-6">
                                                            <!-- Tipo EPI -->
                                                            <label for="tipo_epi_edit" class="col-form-label col-sm-2">EPI: *</label>
                                                            <div class="col-sm-10">
                                                                <select name="tipo_epi" id="tipo_epi_edit" class="form-control" required>
                                                                    <option value="0">--Seleccione tipo epi--</option>
                                                                    <?php foreach ($epis_datos as $epis_dato) { ?>
                                                                        <option value="<?php echo $epis_dato['id_epi']; ?>" nombre_cen="<?php echo $epis_dato['nombre_epi']; ?>">
                                                                            <?php echo $epis_dato['nombre_epi']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="marca_epi_edit" class="col-form-label col-sm-3">Marca</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="marca_epi" id="marca_epi_edit" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="modelo_epi_edit" class="col-form-label col-sm-3">Modelo</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="modelo_epi" id="modelo_epi_edit" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="numserie_epi_edit" class="col-form-label col-sm-3">Nº Serie</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="numserie_epi" id="numserie_epi_edit" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group row">
                                                                <label for="aniofab_epi_edit" class="col-form-label col-sm-4">Año fabricación:</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="aniofab_epi" id="aniofab_epi_edit" class="form-control" tabindex="1" placeholder="inserte año" pattern="^[0-9]*$">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group row">
                                                                <label for="vigencia_epi_edit" class="col-form-label col-sm-4">Fecha caducidad:</label>
                                                                <div class="col-sm-5">
                                                                    <input type="date" name="vigencia_epi" id="vigencia_epi_edit" class="form-control" tabindex="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group row align-items-center">
                                                                <label for="manual_epi_edit" class="col-form-label col-sm-4">Manual Instrucciones:</label>
                                                                <div class="col-sm-6 d-flex align-items-center">
                                                                    <div class="form-check me-3">
                                                                        <input class="form-check-input" type="radio" name="manual_epi" id="manual_no_edit" value="No">
                                                                        <label class="form-check-label" for="manual_no_edit">
                                                                            <b>NO</b>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="manual_epi" id="manual_si_edit" value="Si">
                                                                        <label class="form-check-label" for="manual_si_edit">
                                                                            <b>SI</b>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group row align-items-center">
                                                                <label for="marcace_epi_edit" class="col-form-label col-sm-4">Marcado CE:</label>
                                                                <div class="col-sm-6 d-flex align-items-center">
                                                                    <div class="form-check me-3">
                                                                        <input class="form-check-input" type="radio" name="marcace_epi" id="marcace_no_edit" value="No">
                                                                        <label class="form-check-label" for="marcace_no_edit">
                                                                            <b>NO</b>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="marcace_epi" id="marcace_si_edit" value="Si">
                                                                        <label class="form-check-label" for="marcace_si_edit">
                                                                            <b>SI</b>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="background-color: #eeeeee; padding: 1px; border-radius: 5px; margin-bottom: 10px;">
                                                                <label style="text-align: center; color: #eeeeee;">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <label for="centro_epi_edit" class="col-form-label col-sm-3">Centro: *</label>
                                                                <div class="col-sm-7">
                                                                    <select name="centro_epi" id="centro_epi_edit" class="form-control" required>
                                                                        <option value="0">--Seleccione centro--</option>
                                                                        <?php
                                                                        foreach ($centros_datos as $centros_dato) { ?>
                                                                            <option value="<?php echo $centros_dato['id_centro']; ?>" nombre_cen="<?php echo $centros_dato['nombre_cen']; ?>">
                                                                                <?php echo $centros_dato['nombre_cen']; ?> </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6">
                                                            <label for="estado_epi_edit" class="col-form-label col-sm-2">Estado:</label>
                                                            <div class="col-sm-8">
                                                                <select name="estado_epi" id="estado_epi_edit" class="form-select">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Disponible">Disponible</option>
                                                                    <option value="Retirado">Retirado</option>
                                                                    <option value="Otros">Otros</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group row col-md-12">
                                                            <label for="observaciones_epi_edit" class="col-form-label col-sm-2">Observaciones:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="observaciones_epi" id="observaciones_epi_edit" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                                <label style="text-align: center; color: #ffffff;">
                                                                    <h5 style="margin: 0;">Imagenes</h5>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="file1_edit">Imagen del Riesgo</label>
                                                                    <input type="file" name="img1_epi" class="form-control" id="file1_edit">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" title="Reduce tamaño imagen" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <!-- Contenedor para la vista previa de la imagen -->
                                                                    <div id="list1_edit">
                                                                        <!-- Aquí se mostrará la imagen actual si existe -->
                                                                        <div id="current_img1"></div>
                                                                    </div>
                                                                    <script>
                                                                        function archivo1Edit(evt) {
                                                                            var files = evt.target.files; // FileList object
                                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                                if (!f.type.match('image.*')) {
                                                                                    continue;
                                                                                }
                                                                                var reader = new FileReader();
                                                                                reader.onload = (function(theFile) {
                                                                                    return function(e) {
                                                                                        document.getElementById('list1_edit').innerHTML = '<img class="thumb thumbnail" src="' + e.target.result + '" width="100%" title="' + escape(theFile.name) + '"/>';
                                                                                    };
                                                                                })(f);
                                                                                reader.readAsDataURL(f);
                                                                            }
                                                                        }
                                                                        document.getElementById('file1_edit').addEventListener('change', archivo1Edit, false);
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-md-10">
                                                                    <label for="file2_edit">Imagen Preventiva </label>
                                                                    <input type="file" name="img2_epi" class="form-control" id="file2_edit">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" title="Reduce tamaño imagen" role="button" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <output id="list2_edit">
                                                                        <!-- Aquí se mostrará la imagen actual si existe -->
                                                                        <div id="current_img2"></div>
                                                                    </output>
                                                                    <script>
                                                                        function archivo2Edit(evt) {
                                                                            var files = evt.target.files; // FileList object
                                                                            // Obtenemos la imagen del campo "file2".
                                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                                //Solo admitimos imágenes.
                                                                                if (!f.type.match('image.*')) {
                                                                                    continue;
                                                                                }
                                                                                var reader = new FileReader();
                                                                                reader.onload = (function(theFile) {
                                                                                    return function(e) {
                                                                                        // Insertamos la imagen
                                                                                        document.getElementById("list2_edit").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                                    };
                                                                                })(f);
                                                                                reader.readAsDataURL(f);
                                                                            }
                                                                        }
                                                                        document.getElementById('file2_edit').addEventListener('change', archivo2Edit, false);
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--fin modal editar-->

                                <!-- Script para cargar los datos del EPI a editar -->
                                <script>
                                    function cargarDatosEpi(id_epi) {
                                        // Realizar una petición AJAX para obtener los datos del EPI
                                        $.ajax({
                                            url: '../../app/controllers/inventario/get_epi_details.php',
                                            type: 'POST',
                                            data: {
                                                id_epi: id_epi
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                // Rellenar el formulario con los datos obtenidos
                                                $('#id_epi_edit').val(data.id_epi);
                                                $('#clase_epi_edit').val(data.clase_epi);
                                                $('#tipo_epi_edit').val(data.tipo_epi);
                                                $('#marca_epi_edit').val(data.marca_epi);
                                                $('#modelo_epi_edit').val(data.modelo_epi);
                                                $('#numserie_epi_edit').val(data.numserie_epi);
                                                $('#aniofab_epi_edit').val(data.aniofab_epi);
                                                $('#vigencia_epi_edit').val(data.vigencia_epi);

                                                // Establecer los radio buttons
                                                if (data.manual_epi === "Si") {
                                                    $('#manual_si_edit').prop('checked', true);
                                                } else {
                                                    $('#manual_no_edit').prop('checked', true);
                                                }

                                                if (data.marcace_epi === "Si") {
                                                    $('#marcace_si_edit').prop('checked', true);
                                                } else {
                                                    $('#marcace_no_edit').prop('checked', true);
                                                }

                                                $('#centro_epi_edit').val(data.centro_epi);
                                                $('#estado_epi_edit').val(data.estado_epi);
                                                $('#observaciones_epi_edit').val(data.observaciones_epi);

                                                // Mostrar imágenes actuales si existen
                                                if (data.img1_epi) {
                                                    $('#current_img1').html('<img src="img/' + data.img1_epi + '" class="thumb thumbnail" width="100%" />');
                                                }
                                                if (data.img2_epi) {
                                                    $('#current_img2').html('<img src="img/' + data.img2_epi + '" class="thumb thumbnail" width="100%" />');
                                                }

                                                // Mostrar el modal
                                                $('#modal-editar-epi').modal('show');
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Error al cargar los datos: " + error);
                                                alert("Error al cargar los datos del EPI. Por favor, inténtelo de nuevo.");
                                            }
                                        });
                                    }
                                </script>



                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Inspección Arnés -->
    <?php foreach ($inventarioepis_datos as $inventarioepis_dato) {
        $id_epi = $inventarioepis_dato['id_epi'];
    ?>
        <div class="modal fade" id="modal-inspeccion-<?php echo $id_epi; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title"><i class="bi bi-clipboard-check"></i> Inspección Arnés - <?php echo $inventarioepis_dato['nombre_epi']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../../app/controllers/inventario/create_inspeccion_arnes.php" method="post">
                            <input type="hidden" name="id_epi" value="<?php echo $id_epi; ?>">
                            <div class="form-group row">
                                <!-- Fecha de Inspección -->
                                <div class="col-sm-6">
                                    <label><b>Fecha de Inspección:</b></label>
                                    <input type="date" name="fecha" class="form-control form-control-sm" required value="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <!-- Responsable -->
                                <div class="col-sm-6">
                                    <label><b>Responsable *</b></label>
                                    <select name="id_responsable" class="form-control form-control-sm" required>
                                        <option value="">--Seleccione Responsable--</option>
                                        <?php foreach ($responsables_datos as $responsables_dato) { ?>
                                            <option value="<?php echo $responsables_dato['id_responsable']; ?>">
                                                <?php echo $responsables_dato['nombre_resp']; ?> | <?php echo $responsables_dato['cargo_resp']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mt-3">📌 <b>Inspección de Cintas</b></h5>
                            <div class="row">
                                <?php
                                $cintas = ["hoyos", "desalichadas", "desgastadas", "talladuras", "torsion", "suciedad", "quemada", "pintura", "degradacion", "quimicos", "cortes", "otros"];
                                foreach ($cintas as $cinta) { ?>
                                    <div class="col-md-4">
                                        <label class="small">Cintas - <?php echo ucfirst($cinta); ?></label>
                                        <select name="cintas_<?php echo $cinta; ?>" class="form-control form-control-sm">
                                            <option value="INCORRECTO" selected>❌ INCORRECTO</option>
                                            <option value="CORRECTO">✅ CORRECTO</option>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>

                            <h5 class="mt-3">📌 <b>Inspección de Costuras</b></h5>
                            <div class="row">
                                <?php
                                $costuras = ["abiertas", "hebras", "reventadas", "otros"];
                                foreach ($costuras as $costura) { ?>
                                    <div class="col-md-6">
                                        <label class="small">Costuras - <?php echo ucfirst($costura); ?></label>
                                        <select name="costuras_<?php echo $costura; ?>" class="form-control form-control-sm">
                                            <option value="INCORRECTO" selected>❌ INCORRECTO</option>
                                            <option value="CORRECTO">✅ CORRECTO</option>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>

                            <h5 class="mt-3">📌 <b>Inspección de Metales</b></h5>
                            <div class="row">
                                <?php
                                $metales = ["desgaste", "corrosion", "deformacion", "fisuras", "aristas", "otros"];
                                foreach ($metales as $metal) { ?>
                                    <div class="col-md-4">
                                        <label class="small">Metales - <?php echo ucfirst($metal); ?></label>
                                        <select name="metales_<?php echo $metal; ?>" class="form-control form-control-sm">
                                            <option value="INCORRECTO" selected>❌ INCORRECTO</option>
                                            <option value="CORRECTO">✅ CORRECTO</option>

                                        </select>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Línea gruesa de color gris -->
                            <hr style="border: 3px solid #0000ff; margin-top: 10px; margin-bottom: 10px;">

                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Prioridad:</b></label>
                                    <select name="prioridad" class="form-control form-control-sm">
                                        <option value="Baja">🟢 Baja</option>
                                        <option value="Media">🟡 Media</option>
                                        <option value="Alta">🔴 Alta</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label><b>Prioridad:</b></label>
                                    <select name="valoracion_epi" class="form-control form-control-sm">
                                        <option value="Bien">🟢 Bien</option>
                                        <option value="Aceptable">🟡 Aceptable</option>
                                        <option value="Deficiente">🟠 Deficiente</option>
                                        <option value="Muy deficiente">🔴 Muy deficiente</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label><b>Observaciones:</b></label>
                                    <textarea name="observaciones" class="form-control form-control-sm" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar Inspección</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>




    <div class="row">
        <div id="detallesEpi" class="col-md-12">
            <!-- Aquí se mostrarán los detalles completos del equipo y las fotos -->
        </div>
    </div>

</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>

<script>
    function cargarDetallesepi(id) {
        // Cargar detalles del equipo junto con imágenes
        $.ajax({
            url: 'detallesepi.php',
            data: {
                id: id
            },
            success: function(response) {
                $('#detallesEpi').html(response); // Mostrar detalles e imágenes
            }
        });
    }
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