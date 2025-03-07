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
$id_puestocentro = $_GET['id_puestocentro'];
$id_evaluacion = $_GET['id_evaluacion'];

include('../../app/controllers/evaluacion/datos_puestoarea.php');
include('../../app/controllers/evaluacion/datos_evaluacion.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/evaluacion/listado_riesgos.php');
include('../../app/controllers/maestros/evaluacion/listado_medidas.php');
include('../../app/controllers/evaluacion/listado_filaseval.php');
include('../../app/controllers/evaluacion/listado_puestoarea.php');
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

    <style>
        .btn {
            margin-left: 5px;
            /* Espacio entre los botones */
        }

        .btn-small {
            font-size: 0.8rem;
            /* Tamaño de fuente más pequeño */
            padding: 0.2rem 0.4rem;
            /* Tamaño de relleno más pequeño */
            border-radius: 0.2rem;
            /* Radio de borde pequeño */
            line-height: 1;
            /* Ajustar la altura de línea para un tamaño de botón más pequeño */
        }

        .badge-wh-1 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ffffb9;
            line-height: 0;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-2 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ffff00;
            line-height: 0;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-3 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ancho fijo */
            padding: 0 2px;
            /* Reducción de padding horizontal para estrechar el span */
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            background-color: #ff9191;
            line-height: 1;
            /* Ajuste de line-height para que no influya en la altura del span */
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-4 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            width: 150px;
            /* Ancho fijo */
            background-color: #9a9a9a;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-5 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            width: 150px;
            /* Ancho fijo */
            color: #ffffff;
            background-color: #ff0000;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .badge-wh-6 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            width: 150px;
            /* Ancho fijo */
            color: #fff;
            background-color: #E1B4FC;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        /* Cambia el fondo del dropdown */
        .select2-container--bootstrap4 .select2-dropdown {
            background-color: rgb(207, 205, 205);
            /* Cambia este color según necesites */

        }

        /* Cambia el fondo de los elementos al pasar el mouse */
        .select2-container--bootstrap4 .select2-results__option--highlighted {
            background-color: rgb(0, 60, 255) !important;
            color: white !important;
        }

        /* Agregar borde al dropdown (lista desplegable) */
        .select2-container--bootstrap4 .select2-dropdown {
            border: 8px solid #ffcc00 !important;
            border-radius: 5px;
        }


        /* Estilos personalizados para las pestañas */
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            /* Azul para la pestaña activa */
            color: white;
            border-color: #007bff;
        }

        .nav-tabs .nav-link {
            background-color: #6c757d;
            /* Gris para la pestaña inactiva */
            color: white;
            border-color: #6c757d;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgb(235, 236, 144);
            /* Gris más oscuro al pasar el ratón */
            color: black;
            border-color: rgb(235, 236, 144);
        }


        /* Ajustar la duración de la animación del collapse */
        .collapse {
            transition: height 2s ease;
            /* Cambia 0.5s a la duración que prefieras */
        }

        .collapse.show {
            transition: height 2s ease;
            /* Asegúrate de que la transición también se aplique al estado mostrado */
        }

        .dropdown-item:hover {
            color: #000;
            /* Color negro al pasar el mouse */
            background-color: #0080ff;
            /* Fondo blanco al pasar el mouse */
        }
    </style>

</head>

<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt><b class="border-bottom border-primary">Evaluacion </b></dt>
                            <dd><?php echo $nombre_er ?></dd>

                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>

                            <dt><b class="border-bottom border-primary">Centro </b></dt>
                            <dd><?php echo $nombre_cen ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Responsable</b></dt>
                            <dd><?php echo $nombre_resp ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Fecha</b></dt>
                            <dd><?php echo $fecha_er = date("d-m-Y", strtotime($fecha_er)) ?></dd>

                        </dl>

                    </div>

                    <div class="col-md-1">

                    </div>
                    <div class="col-md-1">

                    </div>


                    <div class="col-md-1">
                        <div class="row">
                            <button type="button" class="btn btn-outline-warning btn-sm"><a href="updatetareas.php?id_tarea=<?php echo $id_tarea ?>&id_proyecto=<?php echo $id_proyecto1 ?>">Editar</a>
                        </div>
                        <div class="row">
                            <a class="btn btn-outline-secondary btn-sm w-100" title="Ver anterior" href="show_er.php?id_evaluacion=<?php echo $id_evaluacion ?>">
                                <i class="fa-solid fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="callout callout-info">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <dl>
                            <dt><b class="border-bottom border-primary">Descripcion</b></dt>

                            <dd><?php echo htmlspecialchars($puestoarea_pc, ENT_QUOTES, 'UTF-8'); ?></dd>

                    </div>
                    </dl>
                    <div class="col-md-9">
                        <dl>
                            <dt><b class="border-bottom border-primary">Descripcion</b></dt>
                            <dd>
                                <?php
                                // Dividir el texto en palabras
                                $palabras = explode(' ', $descripcion_pc);

                                // Obtener las primeras 5 palabras
                                $primeras_palabras = array_slice($palabras, 0, 40);

                                // Unir las palabras nuevamente en un string
                                $descripcion_corta = implode(' ', $primeras_palabras);

                                // Mostrar el texto abreviado
                                echo $descripcion_corta;
                                ?> ...
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-1">

                        <button type="button" class="btn btn-primary btn-sm w-100" data-toggle="modal" data-target="#modal-editapuestoarea<?php echo $id_puestocentro ?>">
                            <i class="fa-solid fa-pencil-alt"></i> Editar Puesto / Área
                        </button>
                        <?php include('../../app/controllers/evaluacion/datos_evaluacion.php');
                        include('../../app/controllers/evaluacion/datos_puestoarea.php');
                        include('../../app/controllers/maestros/responsables/listado_responsables.php');
                        include('../../app/controllers/maestros/centros/listado_centros.php');
                        ?>


                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                IMPRIMIR
                            </button>
                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" style="color:#ddd" href="reporte_puestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>" target="_blank" class="btn btn-warning btn-sm" title="EVALUACION"> <i class="bi bi-printer"></i> IMPRIMIR ER</a></a>
                                <a class="dropdown-item" style="color: #ddd;" href="planificacion_er.php?id_puestocentro=<?php echo $id_puestocentro; ?>" class="btn btn-danger btn-sm btn-font-size" title="Imprimir planificacion preventiva"><i class="bi bi-printer"></i> PLANIFICACIÓN</a>
                                <a class="dropdown-item" style="color: #ddd;" href="ficha_infopuestoarea.php?id_puestocentro=<?php echo $id_puestocentro; ?>" target="_blank"><i class="bi bi-copy"></i> FICHA PUESTO</a>
                            </div>
                        </div>
                        <!--inicio modal modificar proyecto-->
                        <div class="modal fade" id="modal-editapuestoarea<?php echo $id_puestocentro ?>">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:gold">
                                        <h5 class="modal-title" id="modal-nuevtrabajador"><i class="bi bi-plus-lg"></i> Editar Puesto / Area</h5>
                                        <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="../../app/controllers/evaluacion/update_puestoarea.php" method="post" enctype="multipart/form-data">

                                            <div class="well">
                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Evaluacion: <?php echo $codigo_er ?> // <?php echo $id_puestocentro ?></label>
                                                            <input type="text" value="<?php echo $id_evaluacion ?>" name="evaluacion_pc" class="form-control" hidden>
                                                            <input type="text" value="<?php echo $id_puestocentro ?>" name="id_puestocentro" class="form-control" hidden>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="">Puesto / Area</label>
                                                            <input type="text" value="<?php echo $puestoarea_pc ?>" name="puestoarea_pc" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">

                                                        <div class="form-group row">
                                                            <label for="descripcion_pc" class="col-form-label col-sm-2">Descripcion:</label>
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" value="" name="descripcion_pc" rows="10"><?php echo $descripcion_pc ?></textarea>

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
                                                                        <i class="fas fa-caret-down"></i>
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
                                                                                    <textarea class="form-control" value="" name="factoresriesgo_pc" rows="4"><?php echo $factoresriesgo_pc ?></textarea>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">

                                                                            <div class="form-group row">
                                                                                <label for="sensible_pc" class="col-form-label col-sm-2">Colectivo Sensible:</label>
                                                                                <div class="col-sm-12">
                                                                                    <textarea class="form-control" value="" name="sensible_pc" rows="4"><?php echo $sensible_pc ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">

                                                                            <div class="form-group row">
                                                                                <label for="siniestralidad_pc" class="col-form-label col-sm-2">Siniestralidad del puesto:</label>
                                                                                <div class="col-sm-12">
                                                                                    <textarea class="form-control" value="" name="siniestralidad_pc" rows="4"><?php echo $siniestralidad_pc ?></textarea>
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

                                                                                <?php
                                                                                // Supongamos que $epis_pc contiene los datos en formato de cadena
                                                                                $epis_pc_string = $epis_pc; // Reemplaza con tu variable real
                                                                                $epis_pc1 = explode(',', $epis_pc_string);
                                                                                ?>

                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CALZADO SEGURIDAD" id="ep1" <?php echo in_array("CALZADO SEGURIDAD", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep1">CALZADO SEGURIDAD</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="BOTA ALTA IMPERMEABLE" id="ep2" <?php echo in_array("BOTA ALTA IMPERMEABLE", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep2">BOTA ALTA IMPERMEABLE</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CASCO DE PROTECCION" id="ep3" <?php echo in_array("CASCO DE PROTECCION", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep3">CASCO DE PROTECCION</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CASCO CON PANTALLA" id="ep4" <?php echo in_array("CASCO CON PANTALLA", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep4">CASCO CON PANTALLA</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MANOPLAS SOLDADURA" id="ep5" <?php echo in_array("MANOPLAS SOLDADURA", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep5">MANOPLAS SOLDADURA</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTE PROT. MEC." id="ep6" <?php echo in_array("GUANTE PROT. MEC.", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep6">GUANTE PROT. MEC</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES TÉRMICOS" id="ep7" <?php echo in_array("GUANTES TÉRMICOS", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep7">GUANTES TÉRMICOS</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES LATEX" id="ep8" <?php echo in_array("GUANTES LATEX", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep8">GUANTES LATEX</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GUANTES PROT. QUIM." id="ep9" <?php echo in_array("GUANTES PROT. QUIM.", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep9">GUANTES PROT. QUIM.</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="GAFAS ANTIPROYECCIONES" id="ep10" <?php echo in_array("GAFAS ANTIPROYECCIONES", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep10">GAFAS ANTIPROYECCIONES</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PANTALLA PROTECCION FACIAL" id="ep11" <?php echo in_array("PANTALLA PROTECCION FACIAL", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep11">PANTALLA PROTECCION FACIAL</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PANTALLA SOLDADURA" id="ep12" <?php echo in_array("PANTALLA SOLDADURA", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep12">PANTALLA SOLDADURA</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MASCARA VAPOR ORG./GAS." id="ep13" <?php echo in_array("MASCARA VAPOR ORG./GAS.", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep13">MASCARA VAPOR ORG./GAS.</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="MASCARILLA PARTICULAS" id="ep14" <?php echo in_array("MASCARILLA PARTICULAS", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep14">MASCARILLA PARTICULAS</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="PROTECCION AUDITIVA" id="ep15" <?php echo in_array("PROTECCION AUDITIVA", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep15">PROTECCION AUDITIVA</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="ARNES ANTICAIDAS" id="ep16" <?php echo in_array("ARNES ANTICAIDAS", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep16">ARNES ANTICAIDAS</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CHALECO SALVAVIDAS" id="ep17" <?php echo in_array("CHALECO SALVAVIDAS", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep17">CHALECO SALVAVIDAS</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CHALECO ALTA VISIBILIDAD" id="ep18" <?php echo in_array("CHALECO ALTA VISIBILIDAD", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep18">CHALECO ALTA VISIBILIDAD</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="CREMA SOLAR" id="ep19" <?php echo in_array("CREMA SOLAR", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep19">CREMA SOLAR</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="epis_pc[]" value="ROPA DE AGUA" id="ep20" <?php echo in_array("ROPA DE AGUA", $epis_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep20">ROPA DE AGUA</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group row">
                                                                                <label for="equipos_pc" class="col-form-label col-sm-2">Equipos de trabajo:</label>
                                                                                <div class="col-sm-12">
                                                                                    <textarea class="form-control" value="" name="equipos_pc" rows="3"><?php echo $equipos_pc ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group row">
                                                                                <label for="prodquim_pc" class="col-form-label col-sm-2">Productos Quimicos:</label>
                                                                                <div class="col-sm-12">
                                                                                    <textarea class="form-control" value="" name="prodquim_pc" rows="3"><?php echo $prodquim_pc ?></textarea>

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

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Factor psicosocial</label>
                                                                                <?php
                                                                                $factorpsico_pc_string = $factorpsico_pc; // Variable que contiene los datos en formato de cadena
                                                                                $factorpsico_pc1 = array_map('trim', explode(',', $factorpsico_pc_string)); // Convertir a array
                                                                                ?>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Elevado esfuerzo atencion" id="ep1" <?php echo in_array("Carga Mental: Elevado esfuerzo atencion", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep1">Carga Mental: Elevado esfuerzo atencion</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Cantidad de información" id="ep2" <?php echo in_array("Carga Mental: Cantidad de información", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep2">Carga Mental: Cantidad de información</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Complejidad de la información" id="ep3" <?php echo in_array("Carga Mental: Complejidad de la información", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep3">Carga Mental: Complejidad de la información</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Carga Mental: Tiempo limitado para las tareas" id="ep4" <?php echo in_array("Carga Mental: Tiempo limitado para las tareas", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep4">Carga Mental: Tiempo limitado para las tareas</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Contenido del trabajo: Trabajo monotono y/o repetitivo" id="ep5" <?php echo in_array("Contenido del trabajo: Trabajo monotono y/o repetitivo", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep5">Contenido del trabajo: Trabajo monotono y/o repetitivo</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Autonomia personal: Imposibilidad ausentarse del puesto" id="ep6" <?php echo in_array("Autonomia personal: Imposibilidad ausentarse del puesto", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep6">Autonomia personal: Imposibilidad ausentarse del puesto</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Autonomia personal: Imposibilidad de control sobre el ritmo" id="ep7" <?php echo in_array("Autonomia personal: Imposibilidad de control sobre el ritmo", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep7">Autonomia personal: Imposibilidad de control sobre el ritmo</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo a turnos" id="ep8" <?php echo in_array("Organización del Trabajo: Trabajo a turnos", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep8">Organización del Trabajo: Trabajo a turnos</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo nocturno" id="ep9" <?php echo in_array("Organización del Trabajo: Trabajo nocturno", $factorpsico_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep9">Organización del Trabajo: Trabajo nocturno</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="factorpsico_pc[]" value="Organización del Trabajo: Trabajo en solitario" id="ep10" <?php echo in_array("Organización del Trabajo: Trabajo en solitario", $factorpsico_pc1) ? 'checked' : ''; ?>>
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
                                                                    <?php
                                                                    $metodos_pc_string = $metodos_pc; // Variable que contiene los datos en formato de cadena
                                                                    $metodos_pc1 = array_map('trim', explode(',', $metodos_pc_string)); // Convertir a array
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="">Métodos operativos específicos</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Mantenimiento preventivo" id="ep1" <?php echo in_array("Mantenimiento preventivo", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep1">Mantenimiento preventivo</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Comprobación de energías" id="ep2" <?php echo in_array("Comprobación de energías", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep2">Comprobación de energías</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Consignación de equipos de Tº" id="ep3" <?php echo in_array("Consignación de equipos de Tº", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep3">Consignación de equipos de Tº</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Rampas de las embarcaciones" id="ep4" <?php echo in_array("Rampas de las embarcaciones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep4">Rampas de las embarcaciones</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en espacios cerrados" id="ep5" <?php echo in_array("Trabajos en espacios cerrados", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep5">Trabajos en espacios cerrados</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Ordenam. amarre y atraque" id="ep6" <?php echo in_array("Ordenam. amarre y atraque", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep6">Ordenam. amarre y atraque</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Acceso embarcaciones" id="ep7" <?php echo in_array("Acceso embarcaciones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep7">Acceso embarcaciones</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Limpieza de embarcaciones" id="ep8" <?php echo in_array("Limpieza de embarcaciones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep8">Limpieza de embarcaciones</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Conexiones electr. y agua en embarcaciones" id="ep9" <?php echo in_array("Conexiones electr. y agua en embarcaciones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep9">Conexion electr. y agua en emb.</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tratamientos de superficies O.V." id="ep10" <?php echo in_array("Tratamientos de superficies O.V.", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep10">Tratamientos de superficies O.V.</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Traslado embarcación a área reparado" id="ep11" <?php echo in_array("Traslado embarcación a área reparado", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep11">Traslado emb. a área reparado</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Apuntalamiento embarcaciones" id="ep12" <?php echo in_array("Apuntalamiento embarcaciones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep12">Apuntalamiento embarcaciones</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tratamiento superficies emb. fondeadas" id="ep13" <?php echo in_array("Tratamiento superficies emb. fondeadas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep13">Tº superfic. emb. fondeadas</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Manipulación de bidones" id="ep14" <?php echo in_array("Manipulación de bidones", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep14">Manipulación de bidones</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso herramientas manuales" id="ep15" <?php echo in_array("Uso herramientas manuales", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep15">Uso herramientas manuales</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de herramientas portátiles" id="ep16" <?php echo in_array("Uso de herramientas portátiles", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep16">Uso de herramientas portátiles</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de escaleras manuales" id="ep17" <?php echo in_array("Uso de escaleras manuales", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep17">Uso de escaleras manuales</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios de borriquetas" id="ep18" <?php echo in_array("Andamios de borriquetas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep18">Andamios de borriquetas</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios tubulares" id="ep19" <?php echo in_array("Andamios tubulares", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep19">Andamios tubulares</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso Plataformas elevadoras móviles personas" id="ep20" <?php echo in_array("Uso Plataformas elevadoras móviles personas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep20">Uso PEMP</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos verticales" id="ep21" <?php echo in_array("Trabajos verticales", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep21">Trabajos verticales</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en cubiertas" id="ep22" <?php echo in_array("Trabajos en cubiertas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep22">Trabajos en cubiertas</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Operativa en bodega" id="ep23" <?php echo in_array("Operativa en bodega", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep23">Operativa en bodega</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos en fosos" id="ep24" <?php echo in_array("Trabajos en fosos", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep24">Trabajos en fosos</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Andamios de borriquetas" id="ep25" <?php echo in_array("Andamios de borriquetas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep25">Trabajos de soldadura</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Trabajos eléctricos" id="ep26" <?php echo in_array("Trabajos eléctricos", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep26">Trabajos eléctricos</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Guía uso de guantes" id="ep27" <?php echo in_array("Guía uso de guantes", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep27">Guía uso de guantes</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="(manual de gestión de buque)" id="ep28" <?php echo in_array("(manual de gestión de buque)", $metodos_pc1) ? 'checked' : ''; ?>>
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
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Prevención de accidentes in itinere" id="ep29" <?php echo in_array("Prevención de accidentes in itinere", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep29">Prevención de accidentes in itinere</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Vigilancia de la salud" id="ep30" <?php echo in_array("Vigilancia de la salud", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep30">Vigilancia de la salud</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Golpe de Calor- RAD UV" id="ep31" <?php echo in_array("Golpe de Calor- RAD UV", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep31">Golpe de Calor- RAD UV</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Tr. sensibles: embarazadas, menores o trab. Con rest. médi" id="ep32" <?php echo in_array("Tr. sensibles: embarazadas, menores o trab. Con rest. médi", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep32">Tr. sensibles: embarazadas, menores o trab. Con rest. médic</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="EPIS" id="ep33" <?php echo in_array("EPIS", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep33">EPIS</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""></label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Sistema de etiquetado Productos químicos" id="ep34" <?php echo in_array("Sistema de etiquetado Productos químicos", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep34">Sistema de etiquetado Productos químicos</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Manipulación manual de cargas" id="ep35" <?php echo in_array("Manipulación manual de cargas", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep35">Manipulación manual de cargas</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso escaleras de mano" id="ep36" <?php echo in_array("Uso escaleras de mano", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep36">Uso escaleras de mano</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Diseño seguro de trabajos" id="ep37" <?php echo in_array("Diseño seguro de trabajos", $metodos_pc1) ? 'checked' : ''; ?>>
                                                                                    <label class="form-check-label" for="ep37">Diseño seguro de trabajos</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="metodos_pc[]" value="Uso de herramientas manuales" id="ep38" <?php echo in_array("Uso de herramientas manuales", $metodos_pc1) ? 'checked' : ''; ?>>
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

                        <!--fin modal-->


                    </div>

                </div>

            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <dl>
                            <dt><b class="border-bottom border-primary">EPIS </b></dt>
                            <dd><?php echo htmlspecialchars($epis_pc, ENT_QUOTES, 'UTF-8'); ?></dd>

                        </dl>
                    </div>

                    <div class="col-md-4">
                        <dl>
                            <dt><b class="border-bottom border-primary">Equipos Tº</b></dt>
                            <dd><?php echo htmlspecialchars($equipos_pc, ENT_QUOTES, 'UTF-8'); ?></dd>

                            <dd></dd>



                        </dl>
                    </div>
                    <div class="col-md-4">
                        <dl>
                            <dt><b class="border-bottom border-primary">Prod. Q. </b></dt>
                            <dd><?php echo htmlspecialchars($prodquim_pc, ENT_QUOTES, 'UTF-8'); ?></dd>

                            <dd></dd>
                        </dl>
                    </div> <!--boton modal modificar proyecto-->

                </div>

            </div>

        </div>


    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header col-md-12">
                <?php
                $contador_riesgos = 0;
                foreach ($filaseval_datos as $filaseval_dato) {
                    $contador_riesgos++;
                } ?>
                <h3 class="card-title"><b>Riesgos y Medidas :</b> <?php echo $contador_riesgos ?></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoriesgo">Nuevo Riesgo</button>
                </div>
            </div>
            <!--inicio modal nuevo RIESGO-->
            <div class="modal fade" id="modal-nuevoriesgo">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:whitesmoke">
                            <h5 class="modal-title" id="modal-nuevoriesgo"><i class="bi bi-plus-lg"></i> Nuevo Riesgo - Evaluacion: <?php echo $codigo_er ?> - Puesto / Area: <?php echo $puestoarea_pc ?></h5>
                            <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="../../app/controllers/evaluacion/create_filariesgo.php" method="post" enctype="multipart/form-data">

                            <div class="modal-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="identificacion-tab" data-toggle="tab" href="#identificacion" role="tab" aria-controls="identificacion" aria-selected="true">Identificación de riesgos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="planificacion-tab" data-toggle="tab" href="#planificacion" role="tab" aria-controls="planificacion" aria-selected="false">Planificación + Imágenes</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="identificacion" role="tabpanel" aria-labelledby="identificacion-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $id_evaluacion ?>" name="id_evaluacion" class="form-control" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $id_puestocentro ?>" name="puestocentro_fer" class="form-control" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                    <label style="text-align: center; color: #ffffff;">
                                                        <h5 style="margin: 0;">Identificación de riesgos:</h5>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <label for="riesgo">Riesgo</label>
                                                <div class="input-group">
                                                    <select name="riesgo_fer" id="id_riesgo" class="id_riesgo">
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
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <textarea class="form-control" name="frasefila_fer" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="probabilidad_fer">Probabilidad</label>
                                                    <select name="probabilidad_fer" id="probabilidad_fer" class="form-control">
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
                                                    <select name="gravedad_fer" id="gravedad_fer" class="form-control">
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
                                                    <input type="text" id="nivelriesgo_fer" name="nivelriesgo_fer" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="riesgo">Medidas</label>
                                                <div class="input-group">
                                                    <select name="medida_fm[]" id="medida_fm" class="medida_fm" multiple="multiple">
                                                        <option value="">Seleccione Medidas</option>
                                                        <?php
                                                        foreach ($medidas_datos as $medidas_dato) { ?>
                                                            <option value="<?php echo $medidas_dato['id_medida']; ?>">
                                                                <?php echo $medidas_dato['codigomedida']; ?> - <?php echo  $medidas_dato['frasemedida'];  ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-secondary" id="openNewTabButton" style="padding: 2px 10px; font-size: 14px;"><i class="bi bi-plus-lg"></i> Añadir medida</button>
                                                <button type="button" class="btn btn-sm btn-primary" id="updateMedidasButton" style="padding: 2px 10px; font-size: 14px;"><i class="bi bi-arrow-repeat"></i> Actualizar</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="tab-pane fade" id="planificacion" role="tabpanel" aria-labelledby="planificacion-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                                                    <label style="text-align: center; color: #ffffff;">
                                                        <h5 style="margin: 0;">Planificación actividad preventiva:</h5>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="planresponsable_fer">Responsable</label>
                                                    <select name="planresponsable_fer" id="planresponsable_fer" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Trabajador">Trabajador</option>
                                                        <option value="Responsable departamento">Responsable departamento</option>
                                                        <option value="Gerencia empresa">Gerencia empresa</option>
                                                        <option value="Trabajador designado">Trabajador designado</option>
                                                        <option value="SPA">SPA</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="">Coste</label>
                                                    <input type="text" name="plancoste_fer" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="planaccion_fer">Acción</label>
                                                    <select name="planaccion_fer" id="planaccion_fer" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Durante los trabajos">Durante los trabajos</option>
                                                        <option value="Previo a los trabajos">Previo a los trabajos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="planprioridad_fer">Prioridad</label>
                                                    <select name="planprioridad_fer" id="planprioridad_fer" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Periodica">Periodica</option>
                                                        <option value="Urgente">Urgente</option>
                                                        <option value="Alta">Alta</option>
                                                        <option value="Media">Media</option>
                                                        <option value="Baja">Baja</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="planmetodo_fer">Método Operativo</label>
                                                    <select name="planmetodo_fer" id="planmetodo_fer" class="planmetodo_fer">
                                                        <option value="">Seleccione</option>
                                                        <option value="N/A">N/A</option>
                                                        <option style="color:#ffffff; background-color: #808080" value="">MÉTODOS ESPECÍFICOS</option>
                                                        <option value="Mantenimiento preventivo">Mantenimiento preventivo</option>
                                                        <option value="Comprobación de energías">Comprobación de energías</option>
                                                        <option value="Consignación de equipos de Tº">Consignación de equipos de Tº</option>
                                                        <option value="Rampas de las embarcaciones">Rampas de las embarcaciones</option>
                                                        <option value="Trabajos en espacios cerrados">Trabajos en espacios cerrados</option>
                                                        <option value="Ordenam. amarre y atraque">Ordenam. amarre y atraque</option>
                                                        <option value="Acceso embarcaciones">Acceso embarcaciones</option>
                                                        <option value="Limpieza de embarcaciones">Limpieza de embarcaciones</option>
                                                        <option value="Conexion electr. y agua en emb.">Conexion electr. y agua en emb.</option>
                                                        <option value="Tratamientos de superficies O.V.">Tratamientos de superficies O.V.</option>
                                                        <option value="Traslado emb. a área reparado">Traslado emb. a área reparado</option>
                                                        <option value="Apuntalamiento embarcaciones">Apuntalamiento embarcaciones</option>
                                                        <option value="Tº superfic. emb. fondeadas">Tº superfic. emb. fondeadas</option>
                                                        <option value="Manipulación de bidones">Manipulación de bidones</option>
                                                        <option value="Uso herramientas manuales">Uso herramientas manuales</option>
                                                        <option value="Uso de herramientas portátiles">Uso de herramientas portátiles</option>
                                                        <option value="Uso de escaleras manuales">Uso de escaleras manuales</option>
                                                        <option value="Andamios de borriquetas">Andamios de borriquetas</option>
                                                        <option value="Andamios tubulares">Andamios tubulares</option>
                                                        <option value="Uso PEMP">Uso PEMP</option>
                                                        <option value="Trabajos verticales">Trabajos verticales</option>
                                                        <option value="Trabajos en cubiertas">Trabajos en cubiertas</option>
                                                        <option value="Operativa en bodega">Operativa en bodega</option>
                                                        <option value="Trabajos en fosos">Trabajos en fosos</option>
                                                        <option value="Trabajos de soldadura">Trabajos de soldadura</option>
                                                        <option value="Trabajos eléctricos">Trabajos eléctricos</option>
                                                        <option value="Guía uso de guantes">Guía uso de guantes</option>
                                                        <option value="SGS(Manual de gestión de buque)">SGS(Manual de gestión de buque)</option>
                                                        <option style="color:#ffffff; background-color: #808080" value="">MÉTODOS GENERALES</option>
                                                        <option value="Prevención de accidentes in itinere">Prevención de accidentes in itinere</option>
                                                        <option value="Vigilancia de la salud">Vigilancia de la salud</option>
                                                        <option value="Golpe de Calor- RAD UV">Golpe de Calor- RAD UV</option>
                                                        <option value="Tr. sensibles: embarazadas, menores o trab. Con rest. médic">Tr. sensibles: embarazadas, menores o trab. Con rest. médic</option>
                                                        <option value="EPIS">EPIS</option>
                                                        <option value="Sistema de etiquetado Productos químicos">Sistema de etiquetado Productos químicos</option>
                                                        <option value="Manipulación manual de cargas">Manipulación manual de cargas</option>
                                                        <option value="Uso escaleras de mano">Uso escaleras de mano</option>
                                                        <option value="Diseño seguro de trabajos">Diseño seguro de trabajos</option>
                                                        <option value="Uso de herramientas manuales">Uso de herramientas manuales</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="planformacion_fer">Formación</label>
                                                    <select name="planformacion_fer" id="planformacion_fer" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Si">Si</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="planinformacion_fer">Información</label>
                                                    <select name="planinformacion_fer" id="planinformacion_fer" class="form-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Si">Si</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-outline card-primary" id="headingfour">
                                            <div class="card-header">
                                                <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> Imágenes</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="collapseFour" class="collapse show" aria-labelledby="headingfour">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="file1">Imagen del Riesgo</label>
                                                                    <input type="file" name="imgriesgo_fer" class="form-control" id="file1">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" title="Reduce tamaño imagen" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <div id="list1"></div>
                                                                    <script>
                                                                        function archivo1(evt) {
                                                                            var files = evt.target.files;
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
                                                                    <label for="">Imagen Preventiva</label>
                                                                    <input type="file" name="imgplan_fer" class="form-control" id="file2">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" title="Reduce tamaño imagen" role="button" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <output id="list2"></output>
                                                                    <script>
                                                                        function archivo2(evt) {
                                                                            var files = evt.target.files;
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
                                            </div>
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
        </div>
    </div>


    <div class="card-body">
        <table id="example1" class="table compact stripe hover">
            <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="35%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="6%">
            </colgroup>
            <thead class="table-secondary">
                <tr>
                    <th style="text-align: center">#</th>
                    <th style="text-align: left">RIESGO</th>
                    <th style="text-align: left">Descripcion</th>
                    <th style="text-align: center">Probabilidad</th>
                    <th style="text-align: center">Consecuencias</th>
                    <th style="text-align: center">Nivel Riesgo</th>
                    <th style="text-align: center">-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador_riesgos = 0;
                foreach ($filaseval_datos as $filaseval_dato) {
                    $contador_riesgos++;
                    $id_filaeval = $filaseval_dato['id_filaeval'];
                ?>
                    <tr>
                        <td style="text-align: center; color:#ffffff; background-color: #0080c0"><?php echo $contador_riesgos ?></td>
                        <td style="text-align: left"><b><?php echo $filaseval_dato['codigoriesgo']; ?> - <?php echo $filaseval_dato['fraseriesgo']; ?></b></td>
                        <td style="text-align: left"><?php echo $filaseval_dato['frasefila_fer']; ?></td>
                        <td style="text-align: center"><?php echo $filaseval_dato['probabilidad_fer']; ?></td>
                        <td style="text-align: center"><?php echo $filaseval_dato['gravedad_fer']; ?></td>
                        <td style="text-align: center">
                            <?php
                            $nivelriesgo = $filaseval_dato['nivelriesgo_fer'];
                            switch ($nivelriesgo) {
                                case 'Riesgo Trivial':
                                    echo "<span class='badge-wh-1'><h6><b>Riesgo Trivial</b></h6></span>";
                                    break;
                                case 'Riesgo Tolerable':
                                    echo "<span class='badge-wh-2'><h6><b>Riesgo Tolerable</b></h6></span>";
                                    break;
                                case 'Riesgo Moderado':
                                    echo "<span class='badge-wh-3'><h6><b>Riesgo Moderado</b></h6></span>";
                                    break;
                                case 'Riesgo Importante':
                                    echo "<span class='badge-wh-4'><h6><b>Riesgo Importante</b></h6></span>";
                                    break;
                                case 'Riesgo Intolerable':
                                    echo "<span class='badge-wh-5'><h6><b>Riesgo Intolerable</b></h6></span>";
                                    break;
                                default:
                                    echo "<span class='badge-wh-6'><h6><b>Desconocido</b></h6></span>";
                                    break;
                            }
                            ?>
                        </td>
                        </td>
                        <td style="text-align: left">
                            <!-- Contenedor que hace que los botones estén uno al lado del otro -->
                            <div class="d-inline-flex">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#measures-<?php echo $contador_riesgos; ?>, #planificacion-<?php echo $contador_riesgos; ?>">
                                    <i class="bi bi-caret-down-fill"></i>

                                </button>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-editarriesgo-<?php echo $id_filaeval ?>" title="Editar riesgo"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal para editar riesgo -->
                                <?php include('../../app/controllers/evaluacion/datos_filariesgo.php'); ?>
                                <div class="modal fade" id="modal-editarriesgo-<?php echo $id_filaeval ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:gold">
                                                <h5 class="modal-title"><i class="bi bi-plus-lg"></i> Editar Riesgo</h5>
                                                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">



                                                <form id="form-editarriesgo-<?php echo $id_filaeval ?>" action="../../app/controllers/evaluacion/update_filariesgo.php" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Riesgo: <?php echo $filariesgo_dato['id_filaeval'] ?></label>
                                                                <input type="text" value="<?php echo $id_filaeval ?>" name="id_filaeval" class="form-control" hidden>
                                                                <input type="text" value="<?php echo $id_evaluacion ?>" name="id_evaluacion" class="form-control" hidden>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Puesto: <?php echo $puestoarea_pc ?></label>
                                                                <label for="">Riesgo: <?php echo $riesgo_fer ?></label>
                                                                <input type="text" value="<?php echo $id_puestocentro ?>" name="puestocentro_fer" class="form-control" hidden>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <label for="riesgo_fer">Riesgo</label>
                                                            <div class="input-group">
                                                                <select name="riesgo_fer" id="riesgo_fer" class="form-control">
                                                                    <?php
                                                                    // Asegúrate de que la variable $riesgo_fer esté definida y tenga el valor deseado
                                                                    $selected_riesgo_id = isset($riesgo_fer) ? $riesgo_fer : ''; // Valor a preseleccionar

                                                                    foreach ($riesgos_datos as $riesgos_dato) {
                                                                        $fraseriesgo = $riesgos_dato['fraseriesgo'];
                                                                        $codigoriesgo = $riesgos_dato['codigoriesgo'];
                                                                        $riesgo_id = $riesgos_dato['id_riesgo']; // Suponiendo que 'id' es la clave primaria en tu tabla

                                                                        // Mostrar la opción seleccionada
                                                                        $is_selected = ($riesgo_id == $selected_riesgo_id) ? 'selected="selected"' : '';
                                                                    ?>

                                                                        <option value="<?php echo $riesgo_id; ?>" <?php echo $is_selected; ?>
                                                                            fraseriesgo="<?php echo $fraseriesgo; ?>"
                                                                            codigoriesgo="<?php echo $codigoriesgo; ?>">
                                                                            <?php echo $codigoriesgo; ?> - <?php echo $fraseriesgo; ?>
                                                                        </option>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </br>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="">Descripción</label>
                                                            <textarea class="form-control" name="frasefila_fer" value="" rows="3"><?php echo $frasefila_fer ?></textarea>

                                                        </div>
                                                    </div>



                                                    <!-- Nueva sección para Probabilidad, Gravedad y Nivel de Riesgo -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="probabilidad_fer_edit">Probabilidad</label>
                                                                <select name="probabilidad_fer" id="probabilidad_fer_edit_<?php echo $id_filaeval; ?>" class="form-select">
                                                                    <option value="Baja" <?php echo $probabilidad_fer == 'Baja' ? 'selected' : ''; ?>>Baja</option>
                                                                    <option value="Media" <?php echo $probabilidad_fer == 'Media' ? 'selected' : ''; ?>>Media</option>
                                                                    <option value="Alta" <?php echo $probabilidad_fer == 'Alta' ? 'selected' : ''; ?>>Alta</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gravedad_fer_edit">Consecuencias</label>
                                                                <select name="gravedad_fer" id="gravedad_fer_edit_<?php echo $id_filaeval; ?>" class="form-select">

                                                                    <option value="Ligeramente Dañino" <?php echo $gravedad_fer == 'Ligeramente Dañino' ? 'selected' : ''; ?>>Ligeramente Dañino</option>
                                                                    <option value="Dañino" <?php echo $gravedad_fer == 'Dañino' ? 'selected' : ''; ?>>Dañino</option>
                                                                    <option value="Extremadamente Dañino" <?php echo $gravedad_fer == 'Extremadamente Dañino' ? 'selected' : ''; ?>>Extremadamente Dañino</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="nivelriesgo_fer_edit">Nivel de Riesgo</label>
                                                                <input type="text" id="nivelriesgo_fer_edit_<?php echo $id_filaeval; ?>" name="nivelriesgo_fer" class="form-control" readonly>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="background-color: #0080c0; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                                                                <label style="text-align: center; color: #ffffff;">
                                                                    <h5 style="margin: 0;">Planificación actividad preventiva:</h5>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="planresponsable_fer">Responsable</label>
                                                                <select name="planresponsable_fer" id="planresponsable_fer" class="form-select">
                                                                    <option value="Trabajador" <?php echo $planresponsable_fer == 'Trabajador' ? 'selected' : ''; ?>>Trabajador</option>
                                                                    <option value="Responsable departamento" <?php echo $planresponsable_fer == 'Responsable departamento' ? 'selected' : ''; ?>>Responsable departamento</option>
                                                                    <option value="Gerencia empresa" <?php echo $planresponsable_fer == 'Gerencia empresa' ? 'selected' : ''; ?>>Gerencia empresa</option>
                                                                    <option value="Trabajador designado" <?php echo $planresponsable_fer == 'Trabajador designado' ? 'selected' : ''; ?>>Trabajador designado</option>
                                                                    <option value="SPA" <?php echo $planresponsable_fer == 'SPA' ? 'selected' : ''; ?>>SPA</option>
                                                                    <option value="Otros" <?php echo $planresponsable_fer == 'Otros' ? 'selected' : ''; ?>>Otros</option>
                                                                </select>

                                                            </div>
                                                        </div>


                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="">Coste</label>
                                                                <input type="text" name="plancoste_fer" value="<?php echo $plancoste_fer ?>" class="form-control">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="planaccion_fer">Accion</label>
                                                                <select name="planaccion_fer" id="planaccion_fer" class="form-select">
                                                                    <option value="Durante los trabajos" <?php echo $planaccion_fer == 'Durante los trabajos' ? 'selected' : ''; ?>>Previo a los trabajos</option>
                                                                    <option value="Previo a los trabajos" <?php echo $planaccion_fer == 'Previo a los trabajos' ? 'selected' : ''; ?>>Previo a los trabajos</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="planprioridad_fer">Prioridad</label>
                                                                <select name="planprioridad_fer" id="planprioridad_fer" class="form-select">
                                                                    <option value="Periodica" <?php echo $planprioridad_fer == 'Periodica' ? 'selected' : ''; ?>>Periodica</option>
                                                                    <option value="Urgente" <?php echo $planprioridad_fer == 'Urgente' ? 'selected' : ''; ?>>Urgente</option>
                                                                    <option value="Alta" <?php echo $planprioridad_fer == 'Alta' ? 'selected' : ''; ?>>Alta</option>
                                                                    <option value="Media" <?php echo $planprioridad_fer == 'Media' ? 'selected' : ''; ?>>Media</option>
                                                                    <option value="Baja" <?php echo $planprioridad_fer == 'Baja' ? 'selected' : ''; ?>>Baja</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="planmetodo_fer">Metodo Operativo</label>
                                                                <select name="planmetodo_fer" id="planmetodo_fer2" class="form-select">
                                                                    <option value="N/A" <?php echo $planmetodo_fer == 'Baja' ? 'selected' : ''; ?>>N/A</option>
                                                                    <option style="color:#ffffff; background-color: #808080" value="">METODOS ESPECÍFICOS</option>
                                                                    <option value="Mantenimiento preventivo" <?php echo $planmetodo_fer == 'Mantenimiento preventivo' ? 'selected' : ''; ?>>Mantenimiento preventivo</option>
                                                                    <option value="Comprobación de energías" <?php echo $planmetodo_fer == 'Comprobación de energías' ? 'selected' : ''; ?>>Comprobación de energías</option>
                                                                    <option value="Consignación de equipos de Tº" <?php echo $planmetodo_fer == 'Consignación de equipos de Tº' ? 'selected' : ''; ?>>Consignación de equipos de Tº</option>
                                                                    <option value="Rampas de las embarcaciones" <?php echo $planmetodo_fer == 'Rampas de las embarcaciones' ? 'selected' : ''; ?>>Rampas de las embarcaciones</option>
                                                                    <option value="Trabajos en espacios cerrados" <?php echo $planmetodo_fer == 'Trabajos en espacios cerrados' ? 'selected' : ''; ?>>Trabajos en espacios cerrados</option>
                                                                    <option value="Ordenam. amarre y atraque" <?php echo $planmetodo_fer == 'Ordenam. amarre y atraque' ? 'selected' : ''; ?>>Ordenam. amarre y atraque</option>
                                                                    <option value="Acceso embarcaciones" <?php echo $planmetodo_fer == 'Acceso embarcaciones' ? 'selected' : ''; ?>>Acceso embarcaciones</option>
                                                                    <option value="Limpieza de embarcaciones" <?php echo $planmetodo_fer == 'Limpieza de embarcaciones' ? 'selected' : ''; ?>>Limpieza de embarcaciones</option>
                                                                    <option value="Conexion electr. y agua en emb." <?php echo $planmetodo_fer == 'Conexion electr. y agua en emb.' ? 'selected' : ''; ?>>Conexion electr. y agua en emb.</option>
                                                                    <option value="Tratamientos de superficies O.V." <?php echo $planmetodo_fer == 'Tratamientos de superficies O.V.' ? 'selected' : ''; ?>>Tratamientos de superficies O.V.</option>
                                                                    <option value="Traslado emb. a área reparado" <?php echo $planmetodo_fer == 'Traslado emb. a área reparado' ? 'selected' : ''; ?>>Traslado emb. a área reparado</option>
                                                                    <option value="Apuntalamiento embarcaciones" <?php echo $planmetodo_fer == 'Apuntalamiento embarcaciones' ? 'selected' : ''; ?>>Apuntalamiento embarcaciones</option>
                                                                    <option value="Tº superfic. emb. fondeadas" <?php echo $planmetodo_fer == 'Tº superfic. emb. fondeadas' ? 'selected' : ''; ?>>Tº superfic. emb. fondeadas</option>
                                                                    <option value="Manipulación de bidones" <?php echo $planmetodo_fer == 'Manipulación de bidones' ? 'selected' : ''; ?>>Manipulación de bidonesos</option>
                                                                    <option value="Uso herramientas manuales" <?php echo $planmetodo_fer == 'Uso herramientas manuales' ? 'selected' : ''; ?>>Uso herramientas manuales</option>
                                                                    <option value="Uso de herramientas portátiles" <?php echo $planmetodo_fer == 'Uso de herramientas portátiles' ? 'selected' : ''; ?>>Uso de herramientas portátiles</option>
                                                                    <option value="Uso de escaleras manuales" <?php echo $planmetodo_fer == 'Uso de escaleras manuales' ? 'selected' : ''; ?>>Uso de escaleras manuales</option>
                                                                    <option value="Andamios de borriquetas" <?php echo $planmetodo_fer == 'Andamios de borriquetas' ? 'selected' : ''; ?>>Andamios de borriquetas</option>
                                                                    <option value="Andamios tubulares" <?php echo $planmetodo_fer == 'Andamios tubulares' ? 'selected' : ''; ?>>Andamios tubulares</option>
                                                                    <option value="Uso PEMP" <?php echo $planmetodo_fer == 'Uso PEMP' ? 'selected' : ''; ?>>Uso PEMP</option>
                                                                    <option value="Trabajos verticales" <?php echo $planmetodo_fer == 'Trabajos verticales' ? 'selected' : ''; ?>>Trabajos verticales</option>
                                                                    <option value="Trabajos en cubiertas" <?php echo $planmetodo_fer == 'Trabajos en cubiertas' ? 'selected' : ''; ?>>Trabajos en cubiertas</option>
                                                                    <option value="Operativa en bodega" <?php echo $planmetodo_fer == 'Operativa en bodega' ? 'selected' : ''; ?>>Operativa en bodega</option>
                                                                    <option value="Trabajos en fosos" <?php echo $planmetodo_fer == 'Trabajos en fosos' ? 'selected' : ''; ?>>Trabajos en fosos</option>
                                                                    <option value="Trabajos de soldadura" <?php echo $planmetodo_fer == 'Trabajos de soldadura' ? 'selected' : ''; ?>>Trabajos de soldadura</option>
                                                                    <option value="Trabajos eléctricos" <?php echo $planmetodo_fer == 'Trabajos eléctricos' ? 'selected' : ''; ?>>Trabajos eléctricos</option>
                                                                    <option value="Guía uso de guantes" <?php echo $planmetodo_fer == 'Guía uso de guantes' ? 'selected' : ''; ?>>Guía uso de guantes</option>
                                                                    <option value="SGS(Manual de gestión de buque)" <?php echo $planmetodo_fer == 'SGS(Manual de gestión de buque)' ? 'selected' : ''; ?>>SGS(Manual de gestión de buque)</option>
                                                                    <option style="color:#ffffff; background-color: #808080" value="">METODOS GENERALES</option>
                                                                    <option value="Prevención de accidentes in itinere" <?php echo $planmetodo_fer == 'Baja' ? 'selected' : ''; ?>>Prevención de accidentes in itinere</option>
                                                                    <option value="Vigilancia de la salud" <?php echo $planmetodo_fer == 'Prevención de accidentes in itinere' ? 'selected' : ''; ?>>Vigilancia de la salud</option>
                                                                    <option value="Golpe de Calor- RAD UV" <?php echo $planmetodo_fer == 'Golpe de Calor- RAD UV' ? 'selected' : ''; ?>>Golpe de Calor- RAD UV</option>
                                                                    <option value="Tr. sensibles: embarazadas, menores o trab. Con rest. médic" <?php echo $planmetodo_fer == 'Tr. sensibles: embarazadas, menores o trab. Con rest. médic' ? 'selected' : ''; ?>>Tr. sensibles: embarazadas, menores o trab. Con rest. médic</option>
                                                                    <option value="EPIS" <?php echo $planmetodo_fer == 'EPIS' ? 'selected' : ''; ?>>EPIS</option>
                                                                    <option value="Sistema de etiquetado Productos químicos" <?php echo $planmetodo_fer == 'Sistema de etiquetado Productos químicos' ? 'selected' : ''; ?>>Sistema de etiquetado Productos químicos</option>
                                                                    <option value="Manipulación manual de cargas" <?php echo $planmetodo_fer == 'Manipulación manual de cargas' ? 'selected' : ''; ?>>Manipulación manual de cargas</option>
                                                                    <option value="Uso escaleras de mano" <?php echo $planmetodo_fer == 'Uso escaleras de mano' ? 'selected' : ''; ?>>Uso escaleras de mano</option>
                                                                    <option value="Diseño seguro de trabajos" <?php echo $planmetodo_fer == 'Diseño seguro de trabajos' ? 'selected' : ''; ?>>Diseño seguro de trabajos</option>
                                                                    <option value="Uso de herramientas manuales" <?php echo $planmetodo_fer == 'Uso de herramientas manuales' ? 'selected' : ''; ?>>Uso de herramientas manuales</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="planformacion_fer">Formacion</label>
                                                                <select name="planformacion_fer" id="planformacion_fer" class="form-select">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Si">Si</option>
                                                                    <option value="N/A">N/A</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="planinformacion_fer">Informacion</label>
                                                                <select name="planinformacion_fer" id="planinformacion_fer" class="form-select">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Si">Si</option>
                                                                    <option value="N/A">N/A</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                    </div>


                                                    <div class="card card-outline card-primary" id="headingfour">
                                                        <div class="card-header">
                                                            <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> Imagenes</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="collapseFour" class="collapse" aria-labelledby="headingfour">
                                                            <div class="card-body">


                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-10">
                                                                                <label for="">Imagen del Riesgo </label>
                                                                                <input type="file" name="imgriesgo_fer" class="form-control" id="file1">
                                                                                <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" title="Reduce tamaño imagen" target="_blank">
                                                                                    Max. 1Mb
                                                                                </a>
                                                                                <br>
                                                                                <output id="list1">
                                                                                    <img src="<?php echo $URL . '/admin/evaluacion/image/' . $imgriesgo_fer; ?>" width="100%" alt="Imagen del Riesgo">

                                                                                </output>
                                                                                <script>
                                                                                    function archivo1(evt) {
                                                                                        var files = evt.target.files; // FileList object
                                                                                        // Obtenemos la imagen del campo "file1".
                                                                                        for (var i = 0, f; f = files[i]; i++) {
                                                                                            //Solo admitimos imágenes.
                                                                                            if (!f.type.match('image.*')) {
                                                                                                continue;
                                                                                            }
                                                                                            var reader = new FileReader();
                                                                                            reader.onload = (function(theFile) {
                                                                                                return function(e) {
                                                                                                    // Insertamos la imagen
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
                                                                            <div class="col-md-10">
                                                                                <label for="">Imagen Preventiva </label>
                                                                                <input type="file" name="imgplan_fer" class="form-control" id="file2">
                                                                                <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" title="Reduce tamaño imagen" role="button" target="_blank">
                                                                                    Max. 1Mb
                                                                                </a>
                                                                                <br>
                                                                                <output id="list2">
                                                                                    <img src="<?php echo $URL . '/admin/evaluacion/image/' . $imgplan_fer; ?>" width="100%" alt="Imagen del Riesgo">

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
                                <!-- Modal para ver y actualizar imágenes -->
                                <div class="modal fade" id="modal-verimagenes-<?php echo $id_filaeval; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#007bff">
                                                <h5 class="modal-title"><i class="bi bi-plus-lg"></i> Imágenes</h5>
                                                <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- Formulario que envía las imágenes al controlador update_filariesgoimagen.php -->
                                            <form action="../../app/controllers/evaluacion/update_filariesgoimagen.php" method="POST" enctype="multipart/form-data">

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Input oculto para enviar el ID de la fila y otros datos necesarios -->
                                                        <input type="hidden" name="id_filaeval" value="<?php echo $id_filaeval; ?>">
                                                        <input type="hidden" name="id_evaluacion" value="<?php echo $id_evaluacion; ?>">
                                                        <input type="hidden" name="puestocentro_fer" value="<?php echo $puestocentro_fer; ?>">

                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-md-10">
                                                                    <label for="">Imagen del Riesgo </label>
                                                                    <input type="file" name="imgriesgo_fer" class="form-control" id="file1">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" role="button" title="Reduce tamaño imagen" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <output id="list1">
                                                                        <img src="<?php echo $URL . '/admin/evaluacion/image/' . $imgriesgo_fer; ?>" width="100%" alt="Imagen del Riesgo">
                                                                    </output>
                                                                    <!-- Campo oculto para guardar el nombre de la imagen actual -->
                                                                    <input type="hidden" name="imgriesgo_fer_existente" value="<?php echo $imgriesgo_fer; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-md-10">
                                                                    <label for="">Imagen Preventiva </label>
                                                                    <input type="file" name="imgplan_fer" class="form-control" id="file2">
                                                                    <a href="https://www.iloveimg.com/es/comprimir-imagen/comprimir-jpg" class="btn btn-outline-danger btn-small" title="Reduce tamaño imagen" role="button" target="_blank">
                                                                        Max. 1Mb
                                                                    </a>
                                                                    <br>
                                                                    <output id="list2">
                                                                        <img src="<?php echo $URL . '/admin/evaluacion/image/' . $imgplan_fer; ?>" width="100%" alt="Imagen Preventiva">
                                                                    </output>
                                                                    <!-- Campo oculto para guardar el nombre de la imagen actual -->
                                                                    <input type="hidden" name="imgplan_fer_existente" value="<?php echo $imgplan_fer; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Footer con los botones para cerrar o guardar los cambios -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="div">
                                    <a class="btn btn-danger btn-sm" href="../../app/controllers/evaluacion/delete_filariesgo.php?id_filaeval=<?php echo $id_filaeval; ?>&id_puestocentro=<?php echo $id_puestocentro; ?>&id_evaluacion=<?php echo $id_evaluacion; ?>"
                                        onclick="return confirm('¿Realmente desea eliminar el Puesto / Area evaluado?')" title="Eliminar Puesto / Area evaluada">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>

                            </div>
                        </td>
                    </tr>
                    <!-- Fila para las medidas preventivas -->
                    <tr id="measures-<?php echo $contador_riesgos; ?>" class="collapse">
                        <td colspan="8" style="text-align: left; background-color: #eaeaea; border: 1px solid #ddd;">
                            <strong style="color: #007bff;">Medidas preventivas:</strong><br>
                            <?php foreach ($filaseval_dato['medidas'] as $medida) { ?>
                                <div style="border-bottom: 1px solid #ccc; padding: 5px 0; display: flex; justify-content: space-between; align-items: center;">
                                    <!-- Mostrar la frasemedida -->
                                    <span><?php echo nl2br(htmlspecialchars($medida['frasemedida'], ENT_QUOTES, 'UTF-8')); ?></span>

                                    <!-- Preparar la frasemedida para JavaScript -->
                                    <?php $frasemedida_js = str_replace(array("\r", "\n"), array("\\r", "\\n"), addslashes($medida['frasemedida'])); ?>

                                    <!-- Contenedor de botones para asegurar la alineación -->
                                    <div style="display: flex; gap: 5px;">
                                        <!-- Botón para editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMedidaModal"
                                            onclick="loadMedidaData(<?php echo $medida['id_medida']; ?>, '<?php echo addslashes($medida['codigomedida']); ?>', '<?php echo $frasemedida_js; ?>')">
                                            <i class="fas fa-pencil-alt"></i> <!-- Ícono de lápiz -->
                                        </button>

                                        <!-- Botón para eliminar -->
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $medida['id_medida']; ?>)">
                                            <i class="fas fa-trash-alt"></i> <!-- Ícono de papelera -->
                                        </button>

                                    </div>
                                </div>
                            <?php } ?>
                        </td>

                    </tr>

                    <!-- Fila para las planificacion -->
                    <tr id="planificacion-<?php echo $contador_riesgos; ?>" class="collapse">
                        <td colspan="8" style="text-align: left; background-color: #f1e7cd; border: 1px solid #ddd;">
                            <strong style="color: #007bff;">Planificación actividad preventiva:</strong><br>

                            <!-- Aquí agregamos las nuevas columnas -->
                            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                <div style="flex: 10;">
                                    <strong>Responsable:</strong>
                                    <p><?php echo $filaseval_dato['planresponsable_fer']; ?></p>
                                </div>
                                <div style="flex: 3;">
                                    <strong>Coste:</strong>
                                    <p><?php echo $filaseval_dato['plancoste_fer']; ?></p>
                                </div>
                                <div style="flex: 15;">
                                    <strong>Acción:</strong>
                                    <p><?php echo $filaseval_dato['planaccion_fer']; ?></p>
                                </div>
                                <div style="flex: 10;">
                                    <strong>Prioridad:</strong>
                                    <p><?php echo $filaseval_dato['planprioridad_fer']; ?></p>
                                </div>
                                <div style="flex: 25;">
                                    <strong>Método:</strong>
                                    <p><?php echo $filaseval_dato['planmetodo_fer']; ?></p>
                                </div>
                                <div style="flex: 10;">
                                    <strong>Formación:</strong>
                                    <p><?php echo $filaseval_dato['planformacion_fer']; ?></p>
                                </div>
                                <div style="flex: 10;">
                                    <strong>Información:</strong>
                                    <p><?php echo $filaseval_dato['planinformacion_fer']; ?></p>
                                </div>

                                <div style="flex: 5;">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-verimagenes-<?php echo $id_filaeval ?>"><i class="bi bi-eye"></i>imagenes</button>



                                </div>
                                <div style="flex: 5;">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-planificar-<?php echo $medida['id_medida']; ?>"><i class="bi bi-eye"></i>Enviar a planificacion</button>
                                </div>
                                <!--inicio modal nuev accion prl-->
                                <div class="modal fade" id="modal-planificar-<?php echo $medida['id_medida']; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                                <h5 class="modal-title" id="modal-planificar-<?php echo $medida['id_medida']; ?>">Nuevo Accion Correctora o Preventiva</h5>
                                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="../../app/controllers/actividad/create_accion.php" method="post" enctype="multipart/form-data">


                                                    <div class="well">
                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label for="nombre" class="col-form-label col-sm-3">Accion Nº:</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" name="codigo_acc" id="" value="" placeholder="" tabindex="1">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label for="nombre" class="col-form-label col-sm-3">Fecha:</label>
                                                                    <div class="col-sm-5">
                                                                        <input type="date" name="fecha_acc" id="fecha_acc" value="" class="form-control" tabindex="1">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="row">


                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                                                                    <div class="col-sm-7">
                                                                        <select name="centro_acc" id="btn_centro" class="form-control" required>
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

                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label for="prioridad" class="col-form-label col-sm-3">Prioridad:</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-select" name="prioridad_acc" aria-label="Default select example">
                                                                            <option value="-">Selecciona lugar</option>

                                                                            <option value="Baja">Baja (< 3 meses)</option>
                                                                            <option value="Media">Media (< 1 meses)</option>
                                                                            <option value="Alta">Alta (< 10 dias)</option>
                                                                            <option value="Urgente">Urgente (< 24 - 48 hrs)</option>
                                                                        </select>




                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">

                                                                    <label for="" class="col-form-label col-sm-3">Responsable *</label>
                                                                    <div class="col-sm-9">
                                                                        <select name="responsable_acc" id="" class="form-control" required>
                                                                            <option value="">--Seleccione Responsable--</option>
                                                                            <?php
                                                                            foreach ($responsables_datos as $responsables_dato) { ?>
                                                                                <option value="<?php echo $responsables_dato['id_responsable']; ?>"><?php echo $responsables_dato['nombre_resp']; ?> | <?php echo $responsables_dato['cargo_resp']; ?> </option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div id="accordion">

                                                                <div class="card card-outline card-primary" id="panelsStayOpen-headingone">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"><i class="bi bi-person-fill" style="text-align: left;"></i> 1. Detalles / Descripción</h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                                                                <i class="fas fa-list"></i>
                                                                            </button>
                                                                        </div>

                                                                        <div class="row">

                                                                        </div>

                                                                    </div>
                                                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">


                                                                        <div class="card-body">
                                                                            <div class="row">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label for="descripcion_acc" class="col-form-label col-sm-2">Descripcion:</label>
                                                                                            <div class="col-sm-12">
                                                                                                <textarea class="form-control" name="descripcion_acc" value="" rows="3"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-5">
                                                                                    <div class="form-group row">
                                                                                        <label for="origen_acc" class="col-form-label col-sm-3">Origen:</label>
                                                                                        <div class="col-sm-9">
                                                                                            <select class="form-select" name="origen_acc" aria-label="Default select example">

                                                                                                <option value="-">Seleccione</option>

                                                                                                <option value="Evaluacion de riesgos">Evaluacion de riesgos</option>
                                                                                                <option value="Accidente de trabajo">Accidente de trabajo</option>
                                                                                                <option value="Propuesta de mejora">Propuesta de mejora</option>
                                                                                                <option value="Comunicado de riesgos">Comunicado de riesgos</option>
                                                                                                <option value="Otros">Otros</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-7">
                                                                                    <div class="form-group row">
                                                                                        <label for="detalleorigen_acc" class="col-form-label col-sm-5">Informe procedencia / detalles:</label>
                                                                                        <div class="col-sm-7">
                                                                                            <input type="text" name="detalleorigen_acc" id="" class="form-control" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="card card-outline card-primary" id="headingtwo">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"><i class="fa fa-book" style="text-align: left;"></i> 2. Medidas preventivas / correctoras</h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>

                                                                        <div class="row">

                                                                        </div>

                                                                    </div>
                                                                    <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label for="accpropuesta_acc" class="col-form-label col-sm-2">Accion propuesta:</label>
                                                                                        <div class="col-sm-12">
                                                                                            <textarea class="form-control" name="accpropuesta_acc" value="" rows="2"></textarea>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">



                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label for="accrealizada_acc" class="col-form-label col-sm-2">Acción realizada:</label>
                                                                                        <div class="col-sm-12">
                                                                                            <textarea class="form-control" name="accrealizada_acc" value="" rows="2"></textarea>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="card card-outline card-primary" id="headingthree">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"><i class="bi bi-geo-alt-fill" style="text-align: left;"></i> 3. Seguimiento</h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>

                                                                        <div class="row">

                                                                        </div>

                                                                    </div>
                                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingthree">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">

                                                                                        <label for="fechaprevista_acc" class="col-form-label col-sm-6">Fecha cierre prevista:</label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="date" name="fechaprevista_acc" id="fechaprevista_acc" value="" class="form-control" tabindex="1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">

                                                                                        <label for="fechaprevista_acc" class="col-form-label col-sm-6">Fecha cierre real:</label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="date" name="fecharea_acc" id="fecharea_acc" value="" class="form-control" tabindex="1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">

                                                                                        <label for="fechaveri_acc" class="col-form-label col-sm-6">Fecha verificación:</label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="date" name="fechaveri_acc" id="fechaveri_acc" value="<?php echo $fechaveri_acc ?>" class="form-control" tabindex="1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">
                                                                                        <label for="recursos_acc" class="col-form-label col-sm-5">Recursos (Eur):</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" name="recursos_acc" id="" value="" class="form-control" tabindex="1">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">
                                                                                        <label for="avance_acc" class="col-form-label col-sm-3">Avance:</label>
                                                                                        <div class="col-sm-6">
                                                                                            <select class="form-select" name="avance_acc" aria-label="Default select example">
                                                                                                <option value="-">-</option>

                                                                                                <option value="0%">0%</option>
                                                                                                <option value="25%">25%</option>
                                                                                                <option value="50%">50%</option>
                                                                                                <option value="85%">85%</option>
                                                                                                <option value="100%">100%</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group row">
                                                                                        <label for="estado_acc" class="col-form-label col-sm-3">Estado:</label>
                                                                                        <div class="col-sm-7">
                                                                                            <select class="form-select" name="estado_acc" aria-label="Default select example">
                                                                                                <option value="-">-</option>

                                                                                                <option value="Abierta">Abierta</option>
                                                                                                <option value="Comunicada">Comunicada</option>
                                                                                                <option value="En curso">En curso</option>
                                                                                                <option value="Finalizada">Finalizada</option>
                                                                                                <option value="Cerrada">Cerrada</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label for="seguimiento_acc" class="col-form-label col-sm-3">Seguimiento acción: (fecha y detalles)</label>
                                                                                        <div class="col-sm-9">
                                                                                            <textarea class="form-control" name="seguimiento_acc" value="" rows="4"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="card card-outline card-primary" id="headingfour">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"><i class="bi bi-plus-square-fill" style="text-align: left;"></i> 4. Comentarios y imagenes</h3>
                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingfour">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label for="accrealizada_acc" class="col-form-label col-sm-6">Comentarios y anotaciones:</label>
                                                                                        <div class="col-sm-12">
                                                                                            <textarea class="form-control" name="accrealizada_acc" value="" rows="2"></textarea>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>


                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-8">
                                                                                            <label for="">Imagen 1 </label>
                                                                                            <input type="file" name="imagen1_acc" class="form-control" id="file1">
                                                                                            <br>
                                                                                            <output id="list1">
                                                                                            </output>
                                                                                            <script>
                                                                                                function archivo1(evt) {
                                                                                                    var files = evt.target.files; // FileList object
                                                                                                    // Obtenemos la imagen del campo "file1".
                                                                                                    for (var i = 0, f; f = files[i]; i++) {
                                                                                                        //Solo admitimos imágenes.
                                                                                                        if (!f.type.match('image.*')) {
                                                                                                            continue;
                                                                                                        }
                                                                                                        var reader = new FileReader();
                                                                                                        reader.onload = (function(theFile) {
                                                                                                            return function(e) {
                                                                                                                // Insertamos la imagen
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
                                                                                            <input type="file" name="imagen2_acc" class="form-control" id="file2">
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



                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <!-- Modal para editar la medida -->
            <div class="modal fade" id="editMedidaModal" tabindex="-1" aria-labelledby="editMedidaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMedidaModalLabel">Editar Medida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editMedidaForm">
                                <input type="hidden" name="id_medida" id="id_medida">

                                <div class="mb-3">
                                    <label for="codigomedida" class="form-label">Código Medida</label>
                                    <input type="text" class="form-control" id="codigomedida" name="codigomedida" required>
                                </div>


                                <div class="mb-3">
                                    <label for="frasemedida" class="form-label">Frase Medida</label>
                                    <textarea class="form-control" id="frasemedida" name="frasemedida" rows="10" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>





        </table>
    </div>

</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar todos los select2 dentro del modal
        $('#id_riesgo, #planmetodo_fer, #medida_fm').select2({
            dropdownParent: $('#modal-nuevoriesgo'),
            theme: 'bootstrap4',
            placeholder: "Seleccione", // Esto añade el texto placeholder
            allowClear: true,
            width: '100%' // Asegura que el Select2 ocupe el 100% del ancho de su contenedor

        });
    });



    document.getElementById('openNewTabButton').addEventListener('click', function() {
        // Definir las dimensiones de la nueva ventana
        const width = 800; // Ancho de la ventana
        const height = 600; // Alto de la ventana

        // Abrir una nueva ventana con las dimensiones especificadas
        window.open('../maestros/evaluacion/solomedidas.php', '_blank', `width=${width},height=${height}`);
    });

    $(document).ready(function() {
        $('#updateMedidasButton').on('click', function() {
            $.ajax({
                url: '../../app/controllers/maestros/evaluacion/listado_medidasajax.php', // Asegúrate de que esta ruta sea correcta
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiar las opciones existentes
                    $('#medida_fm').empty().append('<option value="">Seleccione Medidas</option>');

                    // Agregar las nuevas opciones
                    $.each(data, function(index, medida) {
                        $('#medida_fm').append('<option value="' + medida.id_medida + '">' + medida.codigomedida + ' - ' + medida.frasemedida + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error al actualizar las medidas: ", error);
                }
            });
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        const probabilidad = document.getElementById('probabilidad_fer');
        const gravedad = document.getElementById('gravedad_fer');
        const nivelRiesgo = document.getElementById('nivelriesgo_fer');

        function actualizarNivelRiesgo() {
            const probabilidadValue = probabilidad.value;
            const gravedadValue = gravedad.value;

            let riesgoValue = '';
            let riesgoColor = '';

            if (probabilidadValue === 'Baja' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Trivial';
                riesgoColor = '#fff9b1';
            } else if (probabilidadValue === 'Baja' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = '#fdea00';
            } else if (probabilidadValue === 'Baja' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Tolerable';
                riesgoColor = '#fdea00';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidadValue === 'Media' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = '#cacaca';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Ligeramente Dañino') {
                riesgoValue = 'Riesgo Moderado';
                riesgoColor = '#fd8c7a';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Dañino') {
                riesgoValue = 'Riesgo Importante';
                riesgoColor = '#cacaca';
            } else if (probabilidadValue === 'Alta' && gravedadValue === 'Extremadamente Dañino') {
                riesgoValue = 'Riesgo Intolerable';
                riesgoColor = '#ff2300';
            }

            nivelRiesgo.value = riesgoValue;
            nivelRiesgo.style.backgroundColor = riesgoColor;
            nivelRiesgo.style.color = (riesgoValue === 'Riesgo Intolerable') ? 'white' : 'black';
            // Hacer el texto en negrita
            nivelRiesgo.style.fontWeight = 'bold';
        }

        // Actualizar el nivel de riesgo cuando cambien los valores
        probabilidad.addEventListener('change', actualizarNivelRiesgo);
        gravedad.addEventListener('change', actualizarNivelRiesgo);

        // Actualizar el nivel de riesgo al cargar la página con los valores ya definidos
        actualizarNivelRiesgo();
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Función para calcular el nivel de riesgo
        function calcularNivelRiesgo(probabilidad, gravedad) {
            if (probabilidad === 'Baja' && gravedad === 'Ligeramente Dañino') return 'Riesgo Trivial';
            if (probabilidad === 'Baja' && gravedad === 'Dañino') return 'Riesgo Tolerable';
            if (probabilidad === 'Baja' && gravedad === 'Extremadamente Dañino') return 'Riesgo Moderado';
            if (probabilidad === 'Media' && gravedad === 'Ligeramente Dañino') return 'Riesgo Tolerable';
            if (probabilidad === 'Media' && gravedad === 'Dañino') return 'Riesgo Moderado';
            if (probabilidad === 'Media' && gravedad === 'Extremadamente Dañino') return 'Riesgo Importante';
            if (probabilidad === 'Alta' && gravedad === 'Ligeramente Dañino') return 'Riesgo Moderado';
            if (probabilidad === 'Alta' && gravedad === 'Dañino') return 'Riesgo Importante';
            if (probabilidad === 'Alta' && gravedad === 'Extremadamente Dañino') return 'Riesgo Intolerable';
            return '';
        }

        // Función para asignar el color de fondo basado en el nivel de riesgo
        function asignarColorFondo(nivelRiesgoInput, nivelRiesgo) {
            let riesgoColor = '';
            let textoColor = 'black';

            switch (nivelRiesgo) {
                case 'Riesgo Trivial':
                    riesgoColor = 'lightgreen';

                    break;
                case 'Riesgo Tolerable':
                    riesgoColor = 'lightyellow';
                    break;
                case 'Riesgo Moderado':
                    riesgoColor = 'yellow';
                    break;
                case 'Riesgo Importante':
                    riesgoColor = 'grey';
                    textoColor = 'white';
                    break;
                case 'Riesgo Intolerable':
                    riesgoColor = 'red';
                    textoColor = 'white';
                    break;
            }

            nivelRiesgoInput.style.backgroundColor = riesgoColor;
            nivelRiesgoInput.style.color = textoColor;
        }

        // Función para actualizar el nivel de riesgo y aplicar el color
        function actualizarNivelRiesgo(idFilaEval) {
            const probabilidadSelect = document.getElementById(`probabilidad_fer_edit_${idFilaEval}`);
            const gravedadSelect = document.getElementById(`gravedad_fer_edit_${idFilaEval}`);
            const nivelRiesgoInput = document.getElementById(`nivelriesgo_fer_edit_${idFilaEval}`);

            if (probabilidadSelect && gravedadSelect && nivelRiesgoInput) {
                const nivelRiesgo = calcularNivelRiesgo(probabilidadSelect.value, gravedadSelect.value);
                nivelRiesgoInput.value = nivelRiesgo;

                // Asignar el color de fondo basado en el nivel de riesgo
                asignarColorFondo(nivelRiesgoInput, nivelRiesgo);

            }
        }

        // Añadir event listeners a todos los selects de probabilidad y gravedad
        document.querySelectorAll('[id^="probabilidad_fer_edit_"], [id^="gravedad_fer_edit_"]').forEach(select => {
            select.addEventListener('change', function() {
                const idFilaEval = this.id.split('_').pop();
                actualizarNivelRiesgo(idFilaEval);
            });
        });

        // Inicializar todos los niveles de riesgo al cargar la página
        document.querySelectorAll('[id^="nivelriesgo_fer_edit_"]').forEach(input => {
            const idFilaEval = input.id.split('_').pop();
            actualizarNivelRiesgo(idFilaEval);
        });
    });

    function loadMedidaData(id_medida, codigomedida, frasemedida) {
        document.getElementById('id_medida').value = id_medida;
        document.getElementById('codigomedida').value = codigomedida;
        document.getElementById('frasemedida').value = frasemedida;
    }

    document.getElementById('editMedidaForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('guardar_nueva_medida.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Medida actualizada correctamente');
                    location.reload(); // Recarga la página para reflejar los cambios
                } else {
                    alert('Error al actualizar la medida');
                }
            })
            .catch(error => console.error('Error:', error));
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Evento clic del botón que abre el modal
        document.querySelectorAll('.btn-ver-fila').forEach(button => {
            button.addEventListener('click', function() {
                const idFilaEval = this.getAttribute('data-id_filaeval');
                fetch(`get_filariesgo.php?id_filaeval=${idFilaEval}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Datos recibidos:', data); // Añadido para depuración
                        if (data.error) {
                            console.error('Error:', data.error);
                            return;
                        }

                        // Rellena los campos del modal con los datos obtenidos
                        document.querySelector('#modal-verriesgo [name="id_evaluacion"]').value = data.fila.id_evaluacion || '';
                        document.querySelector('#modal-verriesgo [name="puestocentro_fer"]').value = data.fila.puestocentro_fer || '';
                        document.querySelector('#modal-verriesgo [name="riesgo_fer"]').value = data.fila.riesgo_fer || '';
                        document.querySelector('#modal-verriesgo [name="frasefila_fer"]').value = data.fila.frasefila_fer || '';
                        document.querySelector('#modal-verriesgo [name="probabilidad_fer"]').value = data.fila.probabilidad_fer || '';
                        document.querySelector('#modal-verriesgo [name="gravedad_fer"]').value = data.fila.gravedad_fer || '';
                        document.querySelector('#modal-verriesgo [name="nivelriesgo_fer"]').value = data.fila.nivelriesgo_fer || '';
                        document.querySelector('#modal-verriesgo [name="planresponsable_fer"]').value = data.fila.planresponsable_fer || '';
                        document.querySelector('#modal-verriesgo [name="plancoste_fer"]').value = data.fila.plancoste_fer || '';
                        document.querySelector('#modal-verriesgo [name="planaccion_fer"]').value = data.fila.planaccion_fer || '';
                        document.querySelector('#modal-verriesgo [name="planprioridad_fer"]').value = data.fila.planprioridad_fer || '';
                        document.querySelector('#modal-verriesgo [name="planmetodo_fer"]').value = data.fila.planmetodo_fer || '';
                        document.querySelector('#modal-verriesgo [name="planformacion_fer"]').value = data.fila.planformacion_fer || '';
                        document.querySelector('#modal-verriesgo [name="planinformacion_fer"]').value = data.fila.planinformacion_fer || '';

                        // Selecciona las medidas
                        const medidaSelect = document.querySelector('#modal-verriesgo [name="medida_fm[]"]');
                        medidaSelect.querySelectorAll('option').forEach(option => {
                            option.selected = data.medidas.includes(option.value);
                        });

                        // Abre el modal
                        $('#modal-verriesgo').modal('show');
                    })
                    .catch(error => console.error('Error en la solicitud:', error));
            });
        });
    });




    $(function() {
        $("#example1").DataTable({
            "pageLength": 15,
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





<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>