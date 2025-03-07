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
include('../../app/controllers/pruebas/listado_trabajadores.php');
include('../../app/controllers/maestros/epis_equipos_pq/listado_tipomaquina.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/inventario/listado_maquinas.php');
include('../../app/controllers/maestros/evaluacion/listado_riesgos.php');



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
                <h3 class="m-0">Equipos de trabajo (maquinaria)</h3>
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


</html>

<!--
<div class="row">
    <div class="col-lg-1 col-6">
        <div class="small-box bg-light shadow-sm border small-box-short">
            <div class="inner">
                <?php
                $contador_de_maquinas = 0;
                foreach ($maquinas_datos as $maquinas_dato) {
                    if ($maquinas_dato['estado_maq'] == 'Disponible') {
                        $contador_de_maquinas++;
                    }
                }
                ?>
                <h2><?php echo $contador_de_maquinas; ?><sup style="font-size: 20px"></sup></h2>
                <p>Maquinas disponibles</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-gears"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box small-box-short">
            <div class="inner">
                <h2>44</h2>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box small-box-short">
            <div class="inner">
                <h2>65</h2>
                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>
</div>-->

<!-- /.content-header -->

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
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#nuevo-equipotrabajo">NUEVO EQUIPO</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="nuevo-equipotrabajo">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                <h5 class="modal-title" id="modal-equipotrabajo">Nuevo Equipo de trabajo (maquina)</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/inventario/create_maquina.php" method="post" enctype="multipart/form-data">


                                    <div class="well">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group row">
                                                    <label for="" class="col-form-label col-sm-3">Clase / Tipo *</label>
                                                    <div class="col-sm-7">
                                                        <select name="tipo_maq" id="" class="form-control" required>
                                                            <option value="">--Seleccione Responsable--</option>
                                                            <?php
                                                            foreach ($tipomaquina_datos as $tipomaquina_dato) { ?>
                                                                <option value="<?php echo $tipomaquina_dato['id_tipomaquina']; ?>">
                                                                    <?php echo $tipomaquina_dato['clase_tm']; ?> | <?php echo $tipomaquina_dato['nombre_tm']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- Botón para abrir en ventana pequeña -->
                                                        <button type="button" class="btn btn-sm btn-primary" id="abrirVentanaclasemaquina" style="padding: 2px 10px; font-size: 14px;" title="Nueva clase">
                                                            <i class="bi bi-plus-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            // Asignación del evento al botón con el id "abrirVentanaclasemaquina"
                                            document.getElementById('abrirVentanaclasemaquina').addEventListener('click', function(event) {
                                                event.preventDefault();


                                                const width = 500;
                                                const height = 400;

                                                // Abrir una nueva ventana con las dimensiones especificadas
                                                window.open('../maestros/epis_equipos_pq/soloequipos.php', '_blank', `width=${width},height=${height}`);
                                            });
                                        </script>



                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="marca_maq" class="col-form-label col-sm-3">Marca</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="marca_maq" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="modelo_maq" class="col-form-label col-sm-3">Modelo</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="modelo_maq" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="numserie_maq" class="col-form-label col-sm-3">Nº Serie</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="numserie_maq" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group row align-items-center">
                                                    <label for="nombre" class="col-form-label col-sm-5">Manual:</label>
                                                    <div class="col-sm-6 d-flex align-items-center">
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="manual_maq" id="flexRadioDefault3" value="No" checked>
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <b>NO</b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="manual_maq" id="flexRadioDefault4" value="Si">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <b>SI</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row align-items-center">
                                                    <label for="nombre" class="col-form-label col-sm-4">Marcado CE:</label>
                                                    <div class="col-sm-6 d-flex align-items-center">
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="marcace_maq" id="flexRadioDefault5" value="No" checked>
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <b>NO</b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="marcace_maq" id="flexRadioDefault6" value="Si">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <b>SI</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group row">
                                                    <label for="marca_maq" class="col-form-label col-sm-3">Año</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="aniofab_maq" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="form-group row">
                                                    <label for="proveedor_maq" class="col-form-label col-sm-2">Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="proveedor_maq" id="" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                                                    <div class="col-sm-7">
                                                        <select name="centro_maq" id="btn_centro" class="form-control" required>
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
                                                <label for="estado_maq" class="col-form-label col-sm-2">Estado:</label>
                                                <div class="col-sm-8">
                                                    <select name="estado_maq" id="estado_maq" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Disponible">Disponible</option>
                                                        <option value="Retirado">Retirado</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Línea horizontal azul -->
                                                <hr style="border: 1px solid blue; margin-bottom: 10px;">
                                            </div>
                                        </div>

                                        <!-- Equipos de Protección Individual -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">EPIs</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CALZADO SEGURIDAD" id="ep1">
                                                        <label class="form-check-label" for="ep1">CALZADO SEGURIDAD</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="BOTA ALTA IMPERMEABLE" id="ep2">
                                                        <label class="form-check-label" for="ep2">BOTA ALTA IMPERMEABLE</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CASCO DE PROTECCION" id="ep3">
                                                        <label class="form-check-label" for="ep3">CASCO DE PROTECCION</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CASCO CON PANTALLA" id="ep4">
                                                        <label class="form-check-label" for="ep4">CASCO CON PANTALLA</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="MANOPLAS SOLDADURA" id="ep5">
                                                        <label class="form-check-label" for="ep5">MANOPLAS SOLDADURA</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="GUANTE PROT. MEC." id="ep6">
                                                        <label class="form-check-label" for="ep6">GUANTE PROT. MEC</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="GUANTES TÉRMICOS" id="ep7">
                                                        <label class="form-check-label" for="ep7">GUANTES TÉRMICOS</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="GUANTES LATEX" id="ep8">
                                                        <label class="form-check-label" for="ep8">GUANTES LATEX</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="GUANTES PROT. QUIM." id="ep9">
                                                        <label class="form-check-label" for="ep9">GUANTES PROT. QUIM.</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="GAFAS ANTIPROYECCIONES" id="ep10">
                                                        <label class="form-check-label" for="ep10">GAFAS ANTIPROYECCIONES</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="PANTALLA PROTECCION FACIAL" id="ep11">
                                                        <label class="form-check-label" for="ep11">PANTALLA PROTECCION FACIAL</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="PANTALLA SOLDADURA" id="ep12">
                                                        <label class="form-check-label" for="ep12">PANTALLA SOLDADURA</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="MASCARA VAPOR ORG./GAS." id="ep13">
                                                        <label class="form-check-label" for="ep13">MASCARA VAPOR ORG./GAS.</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="MASCARILLA PARTICULAS" id="ep14">
                                                        <label class="form-check-label" for="ep14">MASCARILLA PARTICULAS</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="PROTECCION AUDITIVA" id="ep15">
                                                        <label class="form-check-label" for="ep15">PROTECCION AUDITIVA</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="ARNES ANTICAIDAS" id="ep16">
                                                        <label class="form-check-label" for="ep16">ARNES ANTICAIDAS</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CHALECO SALVAVIDAS" id="ep17">
                                                        <label class="form-check-label" for="ep17">CHALECO SALVAVIDAS</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CHALECO ALTA VISIBILIDAD" id="ep18">
                                                        <label class="form-check-label" for="ep18">CHALECO ALTA VISIBILIDAD</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="CREMA SOLAR" id="ep19">
                                                        <label class="form-check-label" for="ep19">CREMA SOLAR</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="epis_maq[]" value="ROPA DE AGUA" id="ep20">
                                                        <label class="form-check-label" for="ep20">ROPA DE AGUA</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group row col-md-12">
                                                <label for="" class="col-form-label col-sm-2">Observaciones:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="observaciones_maq" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                    <label style="text-align: center; color: #ffffff;">
                                                        <h5 style="margin: 0;">Imagenes</h5>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Navegación de pestañas -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Imágenes Principales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Imágenes Adicionales</a>
                                            </li>
                                        </ul>

                                        <!-- Contenido de las pestañas -->
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-md-8">
                                                                <label for="">Imagen 1 </label>
                                                                <input type="file" name="img1_maq" class="form-control" id="file1">
                                                                <br>
                                                                <output id="list1"></output>
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
                                                                                    document.getElementById("list1").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
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
                                                            <div class="col-md-8">
                                                                <label for="">Imagen 2 </label>
                                                                <input type="file" name="img2_maq" class="form-control" id="file2">
                                                                <br>
                                                                <output id="list2"></output>
                                                                <script>
                                                                    function archivo2(evt) {
                                                                        var files = evt.target.files; // FileList object
                                                                        for (var i = 0, f; f = files[i]; i++) {
                                                                            if (!f.type.match('image.*')) {
                                                                                continue;
                                                                            }
                                                                            var reader = new FileReader();
                                                                            reader.onload = (function(theFile) {
                                                                                return function(e) {
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
                                            </div>

                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-md-8">
                                                                <label for="">Imagen Mantenimiento 1 </label>
                                                                <input type="file" name="imgmto1_maq" class="form-control" id="filemto1">
                                                                <br>
                                                                <output id="listmto1"></output>
                                                                <script>
                                                                    function archivomto1(evt) {
                                                                        var files = evt.target.files; // FileList object
                                                                        for (var i = 0, f; f = files[i]; i++) {
                                                                            if (!f.type.match('image.*')) {
                                                                                continue;
                                                                            }
                                                                            var reader = new FileReader();
                                                                            reader.onload = (function(theFile) {
                                                                                return function(e) {
                                                                                    document.getElementById("listmto1").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                                };
                                                                            })(f);
                                                                            reader.readAsDataURL(f);
                                                                        }
                                                                    }
                                                                    document.getElementById('filemto1').addEventListener('change', archivomto1, false);
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-md-8">
                                                                <label for="">Imagen Mantenimiento 2 </label>
                                                                <input type="file" name="imgmto2_maq" class="form-control" id="filemto2">
                                                                <br>
                                                                <output id="listmto2"></output>
                                                                <script>
                                                                    function archivomto2(evt) {
                                                                        var files = evt.target.files; // FileList object
                                                                        for (var i = 0, f; f = files[i]; i++) {
                                                                            if (!f.type.match('image.*')) {
                                                                                continue;
                                                                            }
                                                                            var reader = new FileReader();
                                                                            reader.onload = (function(theFile) {
                                                                                return function(e) {
                                                                                    document.getElementById("listmto2").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                                                };
                                                                            })(f);
                                                                            reader.readAsDataURL(f);
                                                                        }
                                                                    }
                                                                    document.getElementById('filemto2').addEventListener('change', archivomto2, false);
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
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
                            <col width="3%">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">

                            <col width="5%">


                        </colgroup>
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: left">Tipo</th>
                                <th style="text-align: left">Clase</th>
                                <th style="text-align: center">Marca</th>
                                <th style="text-align: left">Modelo</th>
                                <th style="text-align: left">Centro tº</th>
                                <th style="text-align: left">Manual </th>
                                <th style="text-align: left">CE</th>
                                <th style="text-align: left">Año</th>

                                <th style="text-align: left">Estado</th>
                                <th style="text-align: left">ACCIONES

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($maquinas_datos as $maquinas_dato) {
                                $contador = $contador + 1;
                                $id_maquina = $maquinas_dato['id_maquina'];
                            ?>

                                <tr>
                                    <td style="text-align: center"><b><?php echo $contador; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $maquinas_dato['nombre_tm']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $maquinas_dato['clase_tm']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $maquinas_dato['marca_maq']; ?></b></td>
                                    <td style="text-align: left"><b><?php echo $maquinas_dato['modelo_maq']; ?></b></td>
                                    <td style="text-align: left"><?php echo $maquinas_dato['nombre_cen']; ?></td>
                                    <td style="text-align: left"><?php $maquinas_dato['manual_maq']; ?>
                                        <?php if ($maquinas_dato['manual_maq'] == "Si") { ?>
                                            <span class='badge badge-success'>Si</span>
                                        <?php
                                        } else if ($maquinas_dato['manual_maq'] == "No") { ?>
                                            <span class='badge badge-danger'>No</span>

                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php $maquinas_dato['marcace_maq']; ?>
                                        <?php if ($maquinas_dato['marcace_maq'] == "Si") { ?>
                                            <span class='badge badge-success'>Si</span>
                                        <?php
                                        } else if ($maquinas_dato['marcace_maq'] == "No") { ?>
                                            <span class='badge badge-danger'>No</span>

                                        <?php                       }
                                        ?>


                                    </td>
                                    <td style="text-align: left"><?php echo $maquinas_dato['aniofab_maq']; ?></td>

                                    <td style="text-align: left"><?php $maquinas_dato['estado_maq']; ?>
                                        <?php if ($maquinas_dato['estado_maq'] == "Cerrada") { ?>
                                            <span class='badge badge-success'>Cerrada</span>
                                        <?php
                                        } else if ($maquinas_dato['estado_maq'] == "En curso") { ?>
                                            <span class='badge badge-info'>En curso</span>
                                        <?php                       } else if ($maquinas_dato['estado_maq'] == "Disponible") { ?>
                                            <span class='badge badge-success'>Diponible</span>
                                        <?php                       } else if ($maquinas_dato['estado_maq'] == "Retirado") { ?>
                                            <span class='badge badge-warning'>Retirada</span>
                                        <?php                       } else if ($maquinas_dato['estado_maq'] == "Otros") { ?>
                                            <span class='badge badge-secondary'>Otros</span>
                                        <?php                       }
                                        ?>


                                    </td>


                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles" onclick="cargarDetalles(<?php echo $id_maquina; ?>)"><i class="bi bi-search"></i></button>
                                            <!-- Cambiamos el data-target para que apunte al ID específico de este modal -->
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" title="Riesgos equipo" data-target="#modal-riesgosequipo-<?php echo $id_maquina; ?>"><i class="bi bi-exclamation-triangle-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" title="Mantenimiento" data-target="#modal-nuevomantenimiento-<?php echo $id_maquina; ?>"><i class="bi bi-wrench"></i>
                                            </button>


                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" title="Editar" data-target="#editar-equipotrabajo-<?php echo $id_maquina; ?>" onclick="cargarDatosMaquina(<?php echo $id_maquina; ?>)"><i class="bi bi-pencil-square"></i></button>
                                            <a href="../../app/controllers/inventario/delete_maquina.php?id_maquina=<?php echo $id_maquina; ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar investigación"><i class="bi bi-trash-fill"></i> </a>

                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal de Edición -->
                                <div class="modal fade" id="editar-equipotrabajo-<?php echo $id_maquina; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                                <h5 class="modal-title">Editar Equipo de Trabajo (Máquina)</h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../app/controllers/inventario/update_maquina.php" method="post" enctype="multipart/form-data">

                                                    <input type="text" name="id_maquina" value="<?php echo $id_maquina; ?>">

                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="form-group row">
                                                                    <label for="" class="col-form-label col-sm-3">Clase / Tipo *</label>
                                                                    <div class="col-sm-7">

                                                                        <select name="tipo_maq" id="" class="form-control">

                                                                            <?php
                                                                            foreach ($tipomaquina_datos as $tipomaquina_dato) {
                                                                                $tipomaquina_tabla = $tipomaquina_dato['nombre_tm']; // Nombre de la maquina
                                                                                $id_tipomaquina = $tipomaquina_dato['id_tipomaquina']; // ID de la maquina

                                                                                // Compara el id_maquina con el valor guardado en tipo_maq
                                                                            ?>
                                                                                <option value="<?php echo $id_tipomaquina; ?>" <?php if ($tipomaquina_tabla == $maquinas_dato['nombre_tm']) { ?> selected="selected" <?php } ?>>
                                                                                    <?php echo $tipomaquina_tabla; ?>
                                                                                </option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <!-- Botón para abrir en ventana pequeña -->
                                                                        <button type="button" class="btn btn-sm btn-primary" id="abrirVentanaclasemaquina2" style="padding: 2px 10px; font-size: 14px;" title="Nueva clase">
                                                                            <i class="bi bi-plus-lg"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            // Asignación del evento al botón con el id "abrirVentanaclasemaquina"
                                                            document.getElementById('abrirVentanaclasemaquina2').addEventListener('click', function(event) {
                                                                event.preventDefault();


                                                                const width = 500;
                                                                const height = 400;

                                                                // Abrir una nueva ventana con las dimensiones especificadas
                                                                window.open('../maestros/epis_equipos_pq/soloequipos.php', '_blank', `width=${width},height=${height}`);
                                                            });
                                                        </script>



                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group row">
                                                                    <label for="marca_maq" class="col-form-label col-sm-3">Marca</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="marca_maq" id="" class="form-control" value="<?php echo $maquinas_dato['marca_maq']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group row">
                                                                    <label for="modelo_maq" class="col-form-label col-sm-3">Modelo</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="modelo_maq" id="" class="form-control" value="<?php echo $maquinas_dato['modelo_maq']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group row">
                                                                    <label for="numserie_maq" class="col-form-label col-sm-3">Nº Serie</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="numserie_maq" id="" class="form-control" value="<?php echo $maquinas_dato['numserie_maq']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group row align-items-center">
                                                                    <label for="nombre" class="col-form-label col-sm-5">Manual:</label>
                                                                    <div class="col-sm-6 d-flex align-items-center">
                                                                        <div class="form-check me-3">
                                                                            <input class="form-check-input" type="radio" name="manual_maq" id="flexRadioDefault3" value="No"
                                                                                <?php if ($maquinas_dato['manual_maq'] == "No") {
                                                                                    echo 'checked';
                                                                                } ?> />
                                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                                <b>No</b>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="manual_maq" id="flexRadioDefault4" value="Si" <?php if ($maquinas_dato['manual_maq'] == "Si") {
                                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                                } ?>>
                                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                                <b>SI</b>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group row align-items-center">
                                                                    <label for="nombre" class="col-form-label col-sm-4">Marcado CE:</label>
                                                                    <div class="col-sm-6 d-flex align-items-center">
                                                                        <div class="form-check me-3">
                                                                            <input class="form-check-input" type="radio" name="marcace_maq" id="flexRadioDefault5" value="No" <?php if ($maquinas_dato['manual_maq'] == "No") {
                                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                                } ?>
                                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                            <b>NO</b>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="marcace_maq" id="flexRadioDefault6" value="Si" <?php if ($maquinas_dato['manual_maq'] == "Si") {
                                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                                } ?>>
                                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                                <b>SI</b>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group row">
                                                                    <label for="marca_maq" class="col-form-label col-sm-3">Año</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="aniofab_maq" id="" class="form-control" value="<?php echo $maquinas_dato['aniofab_maq']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <div class="form-group row">
                                                                    <label for="proveedor_maq" class="col-form-label col-sm-2">Proveedor</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="proveedor_maq" id="" class="form-control" value="<?php echo $maquinas_dato['proveedor_maq']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr>
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
                                                                        <select name="centro_maq" id="" class="form-control">
                                                                            <option value="0">--Seleccione centro--</option>
                                                                            <?php
                                                                            foreach ($centros_datos as $centros_dato) {
                                                                                $centro_tabla = $centros_dato['nombre_cen']; // Nombre del centro
                                                                                $id_centro = $centros_dato['id_centro']; // ID del centro

                                                                                // Compara el id_centro con el valor guardado en centro_maq
                                                                            ?>
                                                                                <option value="<?php echo $id_centro; ?>" <?php if ($centro_tabla == $maquinas_dato['nombre_cen']) { ?> selected="selected" <?php } ?>>
                                                                                    <?php echo $centro_tabla; ?>
                                                                                </option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>


                                                                    </div>


                                                                </div>

                                                            </div>

                                                            <div class="form-group row col-md-6">
                                                                <label for="estado_maq" class="col-form-label col-sm-2">Estado:</label>
                                                                <div class="col-sm-8">
                                                                    <select name="estado_maq" id="estado_maq" class="form-select">
                                                                        <option value="">Seleccione</option>
                                                                        <option value="Disponible" <?php echo ($maquinas_dato['estado_maq'] == "Disponible") ? "selected" : ""; ?>>Disponible</option>
                                                                        <option value="Retirado" <?php echo ($maquinas_dato['estado_maq'] == "Retirado") ? "selected" : ""; ?>>Retirado</option>
                                                                        <option value="Otros" <?php echo ($maquinas_dato['estado_maq'] == "Otros") ? "selected" : ""; ?>>Otros</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group row col-md-12">
                                                                <label for="" class="col-form-label col-sm-2">Observaciones:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="observaciones_maq" class="form-control" value="<?php echo $maquinas_dato['observaciones_maq']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

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

                                                                    <div class="col-md-8">
                                                                        <label for="">Imagen 1</label>
                                                                        <input type="file" name="img1_maq" class="form-control" id="file1">
                                                                        <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
                                                                            Max. 1Mb
                                                                        </a>

                                                                        <br><br>
                                                                        <output id="list1">
                                                                            <!-- Aquí se carga la imagen inicial desde la base de datos -->
                                                                            <img src="<?php echo $URL . '/admin/inventario/img/' . $maquinas_dato['img1_maq']; ?>" width="100%" alt="Imagen Actual">
                                                                        </output>

                                                                        <script>
                                                                            // Función para manejar la previsualización de la imagen seleccionada
                                                                            function archivo1(evt) {
                                                                                var files = evt.target.files; // FileList object
                                                                                if (files.length === 0) {
                                                                                    // No se seleccionó ningún archivo, se mantiene la imagen actual
                                                                                    return;
                                                                                }
                                                                                // Recorremos los archivos seleccionados
                                                                                for (var i = 0, f; f = files[i]; i++) {
                                                                                    // Solo admitimos imágenes
                                                                                    if (!f.type.match('image.*')) {
                                                                                        continue;
                                                                                    }

                                                                                    var reader = new FileReader();
                                                                                    reader.onload = (function(theFile) {
                                                                                        return function(e) {
                                                                                            // Insertamos la nueva imagen seleccionada
                                                                                            document.getElementById("list1").innerHTML = '<img class="thumb thumbnail" src="' + e.target.result + '" width="100%" title="' + escape(theFile.name) + '"/>';
                                                                                        };
                                                                                    })(f);
                                                                                    reader.readAsDataURL(f);
                                                                                }
                                                                            }

                                                                            // Agregamos el evento 'change' al campo de archivo
                                                                            document.getElementById('file1').addEventListener('change', archivo1, false);
                                                                        </script>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="col-md-8">
                                                                    <label for="">Imagen 2</label>
                                                                    <input type="file" name="img2_maq" class="form-control" id="file2">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br><br>
                                                                    <output id="list2">
                                                                        <img src="<?php echo $URL . '/admin/inventario/img/' . $maquinas_dato['img2_maq']; ?>" width="100%" alt="Imagen Actual">
                                                                    </output>

                                                                    <script>
                                                                        function archivo2(evt) {
                                                                            var files = evt.target.files;
                                                                            if (files.length === 0) {
                                                                                return;
                                                                            }
                                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                                if (!f.type.match('image.*')) {
                                                                                    continue;
                                                                                }
                                                                                var reader = new FileReader();
                                                                                reader.onload = (function(theFile) {
                                                                                    return function(e) {
                                                                                        document.getElementById("list2").innerHTML = '<img class="thumb thumbnail" src="' + e.target.result + '" width="100%" title="' + escape(theFile.name) + '"/>';
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
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                                                            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <!-- Modal específico para cada registro -->
                                <div class="modal fade" id="modal-nuevomantenimiento-<?php echo $id_maquina; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#eeeeee; color:black">
                                                <h5 class="modal-title">Mantenimiento equipo: <?php echo $maquinas_dato['nombre_tm']; ?> / <?php echo $maquinas_dato['marca_maq']; ?></h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="../../app/controllers/inventario/create_mtomaquina.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Equipo / Máquina: <?php echo $maquinas_dato['marca_maq']; ?> - <?php echo $maquinas_dato['modelo_maq']; ?> - <?php echo $maquinas_dato['numserie_maq']; ?></label>
                                                                <input type="hidden" value="<?php echo $id_maquina; ?>" name="id_maquina">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Fecha <b>*</b></label>
                                                                <input type="date" name="fecha_mto" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Responsable</label>
                                                                <input type="text" name="operario_mto" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Detalles <b>*</b></label>
                                                                <textarea class="form-control" name="detalles_mto" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <!-- Más campos del formulario como en el original -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-riesgosequipo-<?php echo $id_maquina; ?>" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#eeeeee; color:black">
                                                <h5 class="modal-title">Mantenimiento equipo: <?php echo $maquinas_dato['nombre_tm']; ?> / <?php echo $maquinas_dato['marca_maq']; ?></h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="form-riesgo" action="../../app/controllers/inventario/create_riesgosmaquina.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Equipo / Máquina: <?php echo $maquinas_dato['marca_maq']; ?> - <?php echo $maquinas_dato['modelo_maq']; ?> - <?php echo $maquinas_dato['numserie_maq']; ?></label>
                                                                <input type="hidden" value="<?php echo $id_maquina; ?>" name="id_maquina">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                                <label style="text-align: center; color: #ffffff;">
                                                                    <h5 style="margin: 0;">Identificacion Riesgo:</h5>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="riesgo">Riesgo</label>
                                                            <div class="input-group">
                                                                <select name="riesgo_fer" id="id_riesgo" class="form-control">
                                                                    <option value="">Seleccione un riesgo</option>
                                                                    <?php
                                                                    foreach ($riesgos_datos as $riesgos_dato) { ?>
                                                                        <option value="<?php echo $riesgos_dato['id_riesgo']; ?>">
                                                                            <?php echo $riesgos_dato['codigoriesgo']; ?> - <?php echo  $riesgos_dato['fraseriesgo'];  ?>


                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </br>



                                                    <!-- Nueva sección para Probabilidad, Gravedad y Nivel de Riesgo -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="probabilidad_fer">Probabilidad</label>
                                                                <select name="probabilidad_fer" class="form-control probabilidad_fer">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Baja">Baja</option>
                                                                    <option value="Media">Media</option>
                                                                    <option value="Alta">Alta</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gravedad_fer">Consecuencias</label>
                                                                <select name="gravedad_fer" class="form-control gravedad_fer">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Ligeramente Dañino">Ligeramente Dañino</option>
                                                                    <option value="Dañino">Dañino</option>
                                                                    <option value="Extremadamente Dañino">Extremadamente Dañino</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="nivelriesgo_fer">Nivel de Riesgo</label>
                                                                <input type="text" class="form-control nivelriesgo_fer" name="nivelriesgo_fer" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Más campos del formulario como en el original -->

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" id="guardar-seguir">Guardar y Seguir</button>
                                                    <button type="submit" class="btn btn-success" id="guardar-salir">Guardar y Salir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="detallesEquipo" class="col-md-12">
            <!-- Aquí se mostrarán los detalles completos del equipo y las fotos -->
        </div>
    </div>

</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>

<script>
    function cargarDetalles(id) {
        // Cargar detalles del equipo junto con imágenes
        $.ajax({
            url: 'detalles.php',
            data: {
                id: id
            },
            success: function(response) {
                $('#detallesEquipo').html(response); // Mostrar detalles e imágenes
            }
        });
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.modal').forEach(modal => {
        const form = modal.querySelector('#form-riesgo');
        const guardarSeguirBtn = modal.querySelector('#guardar-seguir');
        const guardarSalirBtn = modal.querySelector('#guardar-salir');
        
        // Variable para controlar si debemos cerrar el modal
        let shouldCloseModal = false;

        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Determinar qué botón fue presionado
                shouldCloseModal = event.submitter.id === 'guardar-salir';
                
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Riesgo agregado correctamente');
                        
                        if (shouldCloseModal) {
                            // Forzar el cierre del modal usando Bootstrap
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            if (modalInstance) {
                                modalInstance.hide();
                            } else {
                                // Fallback a jQuery si el método de Bootstrap no funciona
                                $(modal).modal('hide');
                            }
                            
                            // Recargar después de un breve delay
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        } else {
                            // Solo resetear el formulario si no vamos a cerrar
                            form.reset();
                        }
                    } else {
                        alert('Error al agregar riesgo');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
            });
        }
    });
});


</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('change', function(event) {
                if (event.target.classList.contains('probabilidad_fer') || event.target.classList.contains('gravedad_fer')) {
                    actualizarNivelRiesgo(modal);
                }
            });
        });

        function actualizarNivelRiesgo(modal) {
            const probabilidad = modal.querySelector('.probabilidad_fer').value;
            const gravedad = modal.querySelector('.gravedad_fer').value;
            const nivelRiesgo = modal.querySelector('.nivelriesgo_fer');

            let riesgoValue = '';
            let riesgoColor = '';

            if (probabilidad === 'Baja' && gravedad === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Trivial';
                riesgoColor = '#fff9b1';
            } else if (probabilidad === 'Baja' && gravedad === 'Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = '#fdea00';
            } else if (probabilidad === 'Baja' && gravedad === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidad === 'Media' && gravedad === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = '#fdea00';
            } else if (probabilidad === 'Media' && gravedad === 'Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidad === 'Media' && gravedad === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = '#cacaca';
            } else if (probabilidad === 'Alta' && gravedad === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidad === 'Alta' && gravedad === 'Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = '#cacaca';
            } else if (probabilidad === 'Alta' && gravedad === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Intolerable';
                riesgoColor = '#ff2300';
            }

            nivelRiesgo.value = riesgoValue;
            nivelRiesgo.style.backgroundColor = riesgoColor;
            nivelRiesgo.style.color = (riesgoValue === 'Riesgo Intolerable') ? 'white' : 'black';
            nivelRiesgo.style.fontWeight = 'bold';
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