<?php
include('../../app/config.php');

$id_trabajador = $_GET['id_trabajador'];

include('../../admin/layout/parte1.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/trabajadores/listado_tr_noformado.php');
include('../../app/controllers/maestros/categorias/listado_categorias.php');
include('../../app/controllers/maestros/documentos/listado_infoprl.php');
?>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Trabajadores de la empresa</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control trabajadores</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    $contador_de_trabajadores = $contador_de_trabajadores + 1;
                }
                ?>
                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores registrados</p>
            </div>
            <div class="icon">
                <i class="ion bi-people"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores activos</p>
            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['nombre_tc'] == 'Edificio' and $trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Pers. tierra</p>
            </div>
            <div class="icon">
                <i class="ion bi-buildings"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-1 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['nombre_tc'] == 'Embarcacion' and $trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Embarcados</p>
            </div>
            <div class="icon">
                <i class="fas fa-ship"></i>
            </div>

        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
           <!-- contador trabajadores no formados -->
           <?php
                $contador_tr_no_formados = 0;
                $contador_tr_formados = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'Si') {
                        $contador_tr_formados = $contador_tr_formados + 1;
                    } elseif ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'No') {
                        $contador_tr_no_formados = $contador_tr_no_formados + 1;
                    }
                }

                ?>
                <!-- fin contador trabajadores no formados -->
        <div class="small-box bg-<?php echo ($contador_tr_no_formados > 0) ? 'warning' : 'light'; ?> shadow-sm border">
        <div class="inner">
              

                <h2><?php echo $contador_tr_no_formados; ?><sup style="font-size: 20px"></h2>
                <p>Pendientes Formar</p>

            </div>
            <div class="icon">
                <i class="fas fa-book" data-toggle="modal" data-target="#modal-pendientesformar"></i>
            </div>

            <!-- inicio modal nuevo trabajador-->
            <div class="modal fade" id="modal-pendientesformar">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#138fec ;color:black">
                            <h5 class="modal-title" id="modal-pendientesformar">TRABAJADORES PENDIENTES FORMAR</h5>
                            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="" class="table table-sm">
                                <colgroup>
                                    <col width="40%">
                                    <col width="20%">
                                    <col width="30%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>

                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Categoria</th>
                                        <th style="text-align: center">Centro</th>
                                        <th style="text-align: center">Empresa</th>
                                        <th style="text-align: center">-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($trabajadores_noformados as $trabajador_noformados) {
                                        $contador = $contador + 1;
                                    ?>

                                        <tr>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_tr']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cat']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cen']; ?></td>
                                            <td style="text-align: center"><?php echo $trabajador_noformados['nombre_emp']; ?></td>
                                            <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_noformados['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles"></i> Ver</a>


                                        <?php
                                    }
                                        ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
            <!--fin modal-->

        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                $contador_de_trabajadores = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1) {
                        $contador_de_trabajadores = $contador_de_trabajadores + 1;
                    }
                }
                ?>

                <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                <p>Trabajadores activos</p>
            </div>
            <div class="icon">
                <i class="ion bi-person-arms-up"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-1 col-6">



    </div>
    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

        <div class="col-lg-1 col-6">
            <div class="btn-text-center">
                <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#modal-nuevotrabajador" title="Añadir nuevo trabajador"><i class="bi bi-person-plus-fill"></i>AÑADIR NUEVO TRABAJADOR</button>

            </div>
            <div class="row">

                <div class="btn-text-center">

                </div>

            </div>




            <!-- inicio modal nuevo trabajador-->
            <div class="modal fade" id="modal-nuevotrabajador">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#ffd900 ;color:black">
                            <h5 class="modal-title" id="modal-nuevotrabajador">Nuevo Trabajador</h5>
                            <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="../../app/controllers/trabajadores/create.php" method="post" enctype="multipart/form-data">


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Codigo</label>
                                            <input type="text" name="codigo_tr" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">DNI/NIE</label>
                                            <input type="text" name="dni_tr" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">APELLIDOS, NOMBRE</label>
                                            <input type="text" name="nombre_tr" class="form-control" required>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault1" value="Hombre" checked>
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                <b>Hombre</b>
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault2" value="Mujer">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                <b>Mujer</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Fecha Nacimiento</label>
                                            <input type="date" name="fechanac_tr" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Fecha Inicio</label>
                                            <input type="date" name="inicio_tr" class="form-control" required>
                                        </div>

                                    </div>
                                    <!--
                                <div class="col-md-2">
                                    <label for="">Sexo</label>
                                    <select class="form-select form-select-sm" name="sexo_tr" aria-label=".form-select-sm example">
                                        <option>Seleccione</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>

                                </div>-->
                                    <div class="col-md-1">
                                    </div>



                                    <div class="col-md-3">
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault3" value="No" checked>
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                <b>NO FORMADO PRL</b>
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault4" value="Si">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                <b>FORMADO PRL</b>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault3" value="No" checked>
                                            <label class="form-check-label" for="flexRadioDefault5">
                                                <b>NO INFORMADO PRL</b>
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault4" value="Si">
                                            <label class="form-check-label" for="flexRadioDefault6">
                                                <b>INFORMADO PRL</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Centro Trabajo</label>
                                            <select name="centro_tr" id="" class="form-control">
                                            <option value="0">--Seleccione centro--</option>
                                                <?php
                                                foreach ($centros_datos as $centros_dato) { ?>
                                                    <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?> - <?php echo $centros_dato['nombre_emp']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Categoria</label>
                                            <select name="categoria_tr" id="" class="form-control">
                                                <option value="0">--Seleccione categoria--</option>
                                                <?php
                                                foreach ($categorias_datos as $categorias_dato) { ?>
                                                    <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_cat']; ?> </option>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">ANOTACIONES</label>
                                            <input type="text" name="anotaciones_tr" class="form-control">
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
    <?php endif ?>

</div>



</html>

<div class="row">
    <div class="col-md-5">
        <?php include('../../app/controllers/trabajadores/datos_trabajador.php');
        include('../../app/controllers/trabajadores/trabajador_formacion.php');
        include('../../app/controllers/trabajadores/trabajador_informacion.php');
        include('../../app/controllers/trabajadores/trabajador_accidentes.php');
        include('../../app/controllers/trabajadores/trabajador_reconocimiento.php'); ?>
        <div class="card card-outline card-black">
            <div class="card-header col-md-12" style="background-color:black">
                <h3 class="card-title text-white"><b>Detalles trabajador: <?php echo $trabajador_dato['nombre_tr'] ?></b> - <?php $trabajador_dato['activo_tr'];
                                                                                                                            if ($trabajador_dato['activo_tr'] == 1) { ?>
                        <span class='badge badge-success'>ACTIVO</span>
                    <?php
                                                                                                                            } else { ?>
                        <span class='badge badge-danger'>INACTIVO</span>
                    <?php
                                                                                                                            }
                    ?>
                    <?php $trabajador_dato['formacionpdt_tr'];
                    if ($trabajador_dato['formacionpdt_tr'] == 'No') { ?>
                        <span class='badge badge-danger'>NO FORMADO</span>
                    <?php
                    }
                    ?>
                    <?php $trabajador_dato['informacion_tr'];
                    if ($trabajador_dato['informacion_tr'] <> 'Si') { ?>
                        <span class='badge badge-danger'>NO INFORMADO</span>
                    <?php
                    }
                    ?>
                </h3>


            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Código</label>
                            <input type="text" value="<?php echo $trabajador_dato['codigo_tr'] ?>" name="codigo_tr" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">DNI/NIE</label>
                            <input type="text" value="<?php echo $trabajador_dato['dni_tr'] ?>" name="dni_tr" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre completo</label>
                            <input type="text" value="<?php echo $trabajador_dato['nombre_tr'] ?>" name="fechanac_tr" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha Nac.</label>
                            <input type="date" value="<?php echo $trabajador_dato['fechanac_tr'] ?>" name="fechanac_tr" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sexo</label>
                            <input type="text" value="<?php echo $trabajador_dato['sexo_tr'] ?>" name="dni_tr" class="form-control" disabled>
                        </div>
                    </div>




                </div>

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha Inicio</label>
                            <input type="date" value="<?php echo $trabajador_dato['inicio_tr'] ?>" name="inicio_tr" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Empresa</label>
                            <input type="text" value="<?php echo $trabajador_dato['nombre_emp'] ?>" name="nombre_emp" class="form-control" disabled>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Centro Trabajo</label>
                            <input type="text" value="<?php echo $trabajador_dato['nombre_cen'] ?>" name="centro_tr" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Categoria</label>
                            <input type="text" value="<?php echo $trabajador_dato['nombre_cat'] ?>" name="categoria_tr" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-md-1">
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                            <div class="form-group" style="text-align: right;">
                                <br>
                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" title="Modificar detalles" data-target="#modal-modificartrabajador<?php echo $id_trabajador; ?>"><i class="bi bi-pencil-square"></i> Editar</button>
                            </div>
                            <!--inicio modal modificar trabajador-->
                            <div class="modal fade" id="modal-modificartrabajador<?php echo $id_trabajador; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:gold">
                                            <h5 class="modal-title" id="modal-nuevtrabajador" style="color: black;"><i class="bi bi-person-lines-fill"></i>Num. <?php echo $trabajador_dato['codigo_tr'] ?> - <?php echo $trabajador_dato['nombre_tr'] ?> - Detalles</h5>
                                            <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="../../app/controllers/trabajadores/update2.php" method="post" enctype="multipart/form-data">


                                                <div class="row">

                                                    <div class="col-md-2">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="activo_tr" id="flexRadioDefault3" value="1" <?php if ($trabajador_dato['activo_tr'] == "1") {
                                                                                                                                                                echo 'Checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <b><?php $trabajador_dato['activo_tr'];
                                                                    if ($trabajador_dato['activo_tr'] == 1) { ?>
                                                                        <span class='badge badge-success'>ACTIVO</span>
                                                                    <?php } else {
                                                                        echo "Activo";
                                                                    }
                                                                    ?></b>

                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="activo_tr" id="flexRadioDefault4" value="0" <?php if ($trabajador_dato['activo_tr'] == "0") {
                                                                                                                                                                echo 'Checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <b><?php $trabajador_dato['activo_tr'];
                                                                    if ($trabajador_dato['activo_tr'] == 0) { ?>
                                                                        <span class='badge badge-danger'>BAJA</span>
                                                                    <?php } else {
                                                                        echo "Baja";
                                                                    }
                                                                    ?></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault3" value="Si" <?php if ($trabajador_dato['formacionpdt_tr'] == "Si") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault5">
                                                                <b><?php $trabajador_dato['formacionpdt_tr'];
                                                                    if ($trabajador_dato['formacionpdt_tr'] == "Si") { ?>
                                                                        <span class='badge badge-success'>FORMADO</span>
                                                                    <?php } else {
                                                                        echo "Formado";
                                                                    }
                                                                    ?></b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault4" value="No" <?php if ($trabajador_dato['formacionpdt_tr'] == "No") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault6">
                                                                <b><?php $trabajador_dato['formacionpdt_tr'];
                                                                    if ($trabajador_dato['formacionpdt_tr'] == "No") { ?>
                                                                        <span class='badge badge-danger'>NO FORMADO</span>
                                                                    <?php } else {
                                                                        echo "No Formado";
                                                                    }
                                                                    ?></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault5" value="Si" <?php if ($trabajador_dato['informacion_tr'] == "Si") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault5">
                                                                <b><?php $trabajador_dato['informacion_tr'];
                                                                    if ($trabajador_dato['informacion_tr'] == "Si") { ?>
                                                                        <span class='badge badge-success'>INFORMADO</span>
                                                                    <?php } else {
                                                                        echo "Informado";
                                                                    }
                                                                    ?></b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault6" value="No" <?php if ($trabajador_dato['informacion_tr'] == "No") {
                                                                                                                                                                        echo 'Checked';
                                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault6">
                                                                <b><?php $trabajador_dato['informacion_tr'];
                                                                    if ($trabajador_dato['informacion_tr'] == "No") { ?>
                                                                        <span class='badge badge-danger'>NO INFORMADO</span>
                                                                    <?php } else {
                                                                        echo "No Informado";
                                                                    }
                                                                    ?></b>
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault1" value="Hombre" <?php if ($trabajador_dato['sexo_tr'] == "Hombre") {
                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <b>Hombre</b>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault2" value="Mujer" <?php if ($trabajador_dato['sexo_tr'] == "Mujer") {
                                                                                                                                                                    echo 'Checked';
                                                                                                                                                                } ?>>
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <b>Mujer</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Codigo</label>
                                                            <input type="text" value="<?php echo $trabajador_dato['codigo_tr'] ?>" name="codigo_tr" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" hidden>
                                                        <div class="form-group">
                                                            <input type="text" value="<?php echo $trabajador_dato['id_trabajador'] ?>" name="id_trabajador" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Apellidos, Nombre</label>
                                                            <input type="text" value="<?php echo $trabajador_dato['nombre_tr'] ?>" name="nombre_tr" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">DNI/NIE</label>
                                                            <input type="text" value="<?php echo $trabajador_dato['dni_tr'] ?>" name="dni_tr" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Fecha Nac.</label>
                                                            <input type="date" value="<?php echo $trabajador_dato['fechanac_tr'] ?>" name="fechanac_tr" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Fecha Inicio</label>
                                                            <input type="date" value="<?php echo $trabajador_dato['inicio_tr'] ?>" name="inicio_tr" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"> </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Centro Trabajo</label>
                                                            <select name="centro_tr" id="" class="form-control">
                                                                <?php
                                                                foreach ($centros_datos as $centros_dato) {
                                                                    $centro_tabla = $centros_dato['nombre_cen'];
                                                                    $id_centro = $centros_dato['id_centro']; ?>
                                                                    <option value="<?php echo $id_centro; ?>" <?php if ($centro_tabla == $centro_tr) { ?> selected="selected" <?php } ?>>
                                                                        <?php echo  $centro_tabla; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Categoria</label>
                                                            <select name="categoria_tr" id="" class="form-control">
                                                                <?php
                                                                foreach ($categorias_datos as $categorias_dato) {
                                                                    $categoria_tabla = $categorias_dato['nombre_cat'];
                                                                    $id_categoria = $categorias_dato['id_categoria']; ?>
                                                                    <option value="<?php echo $id_categoria; ?>" <?php if ($categoria_tabla == $categoria_tr) { ?> selected="selected" <?php } ?>>
                                                                        <?php echo  $categoria_tabla; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">

                                                    <strong style="text-align: left"><i class="far fa-file-alt mr-1"></i> Notas / Detalles</strong>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="anotaciones_tr" rows="10"><?php echo $trabajador_dato['anotaciones_tr']; ?></textarea>
                                                        </div>


                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>


                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>

                </div>

                <hr>



                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: left">
                                        <h5 strong style="text-align: left"><i class="fas fa-book mr-1"></i> Formación recibida </h5 strong>
                                    </td>
                                    <td></td>
                                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                        <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: right"> <a href="../formacion/create.php" style="text-align: right;" class="btn btn-outline-primary btn-sm" title="Ver detalles"><i class="bi bi-plus"></i> Crear</a></td>
                                    <?php endif ?>

                                </tr>
                            </table>
                        </div>


                        <table id="" class="table table-sm">
                            <colgroup>
                                <col width="60%">
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>

                                    <th style="text-align: center">Tipo Form.</th>
                                    <th style="text-align: center">Fecha Form.</th>
                                    <th style="text-align: center">Fecha Caduc.</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($trabajador_formaciones as $trabajador_formacion) {
                                    $contador = $contador + 1;
                                ?>

                                    <tr>
                                        <td style="text-align: center"><?php echo $trabajador_formacion['nombre_tf']; ?></td>
                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_formacion['fecha_fr'])) ?></td>
                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_formacion['fechacad_fr'])) ?></td>

                                        <td style="text-align: center">
                                            <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                <a href="../formacion/show.php?id_formacion=<?php echo  $trabajador_formacion['id_formacion']; ?>" class="btn btn-primary btn-sm" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                            <?php endif ?>

                                        </td>
                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table border="0">
                                <tr>
                                    <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: left">
                                        <h5 strong style="text-align: left"><i class="fas bi bi-file-text-fill"></i> Información PRL</h5 strong>
                                    </td>
                                    <td></td>
                                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                        <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: right"><button type="button" style="text-align: right;" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-nuevaentregainfoprl">+ Crear</button></td>
                                    <?php endif ?>

                                </tr>
                            </table>

                        </div>

                        <table id="" class="table table-sm">
                            <colgroup>
                                <col width="10%">
                                <col width="35%">
                                <col width="35%">
                                <col width="20%">

                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Tipo</th>
                                    <th style="text-align: left">Info PRL</th>
                                    <th style="text-align: left"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($trabajador_informaciones as $trabajador_informacion) {
                                ?>

                                    <tr>

                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_informacion['fechaentrega'])) ?></td>
                                        <td style="text-align: center"><?php echo $trabajador_informacion['tipoinfo_ifd']; ?></td>
                                        <td style="text-align: left"><?php echo $trabajador_informacion['nombre_ifd']; ?></td>
                                        <td style="text-align: center">
                                                <a href="../maestros/documentos/pdf_infoprl_trasmapi.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>

                                                
                                        </td>

                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table border="0">
                                <tr>
                                    <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: left">
                                        <h5 strong style="text-align: left"><i class="fas bi bi-heart-pulse-fill mr-1"></i> Reconocimientos médicos</h5 strong>
                                    </td>
                                    <td></td>
                                    <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                        <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: right"><button type="button" style="text-align: right;" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoreconocimiento">+ Crear</button></td>
                                    <?php endif ?>

                                </tr>
                            </table>

                        </div>

                        <table id="" class="table table-sm">
                            <colgroup>
                                <col width="45%">
                                <col width="15%">
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="text-align: center">Vigente</th>
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Fecha Caduc.</th>
                                    <th style="text-align: center">Citado</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($trabajador_reconocimientos as $trabajador_reconocimiento) {
                                ?>

                                    <tr>
                                        <td style="text-align: center"><?php $trabajador_reconocimiento['vigente_rm'];
                                                                        if ($trabajador_reconocimiento['vigente_rm'] == 1 and $trabajador_reconocimiento['caducidad_rm'] > $fechahora) { ?>
                                                <span class='badge badge-success'>VIGENTE</span>
                                            <?php
                                                                        } elseif ($trabajador_reconocimiento['vigente_rm'] == 1 and $trabajador_reconocimiento['caducidad_rm'] < $fechahora) { ?>
                                                <span class='badge badge-warning'>VIGENTE - CADUCADO</span>
                                            <?php
                                                                        } else { ?>
                                                <span class='badge badge-danger'>NO VIGENTE</span>
                                            <?php
                                                                        }
                                            ?>
                                        </td>
                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_reconocimiento['fecha_rm'])) ?></td>
                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_reconocimiento['caducidad_rm'])) ?></td>
                                        <td style="text-align: center"><?php echo $trabajador_reconocimiento['cita_rm']; ?></td>
                                        <td style="text-align: center">
                                            <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                <a href="../reconocimientos/index.php" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                            <?php endif ?>

                                        </td>
                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table border="0">
                                <tr>
                                    <td style="height: 30px; width: 50%; background-color: #ffffff; text-align: left">
                                        <h5 strong style="text-align: left"><i class="bi bi-bandaid-fill"></i> Accidentes</h5 strong>
                                    </td>
                                    <td></td>

                                </tr>
                            </table>
                        </div>
                        <table id="" class="table table-sm">
                            <colgroup>
                                <col width="15%">
                                <col width="25%">
                                <col width="30%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Tipo Acc.</th>
                                    <th style="text-align: center">Centro</th>
                                    <th style="text-align: center">Fecha Baja</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contadoracc = 0;
                                foreach ($trabajador_accidentes as $trabajador_accidente) {
                                    $contadoracc = $contadoracc + 1;
                                ?>

                                    <tr>
                                        <td style="text-align: center"><?php echo $newdate = date("d-m-Y", strtotime($trabajador_accidente['fecha_ace'])) ?></td>
                                        <td style="text-align: center"><?php echo $trabajador_accidente['tipoaccidente_ta']; ?></td>
                                        <td style="text-align: center"><?php echo $trabajador_accidente['nombre_cen']; ?></td>

                                        <td style="text-align: center">
                                            <?php if ($trabajador_accidente['fechabaja_ace'] == NULL) { ?>
                                                <span class='badge badge-success'>VIGENTE</span>
                                            <?php } else { ?>
                                                <?php echo date("d-m-Y", strtotime($trabajador_accidente['fechabaja_ace'])); ?>
                                            <?php } ?>
                                        </td>

                                        <td style="text-align: center">
                                            <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                                                <a href="../accidentes/show.php?id_accidente=<?php echo $trabajador_accidente['id_accidente'] ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                            <?php endif ?>

                                        </td>
                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong style="text-align: left"><i class="far fa-file-alt mr-1"></i> Notas / Detalles</strong>

                        <div class="form-group">
                            <textarea class="form-control" rows="2" disabled><?php echo $trabajador_dato['anotaciones_tr']; ?></textarea>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <strong style="text-align: left"><i class="bi bi-printer-fill"></i> Imprimir Documentos</strong>
                    <div class="form-group d-flex justify-content-start">
                        <!-- Primer botón desplegable (Dosier) -->
                        <div class="dropdown mr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dosier
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_dosier.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Dosier Trasmapi</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_infoprl_mediterranea.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Dosier Mediterranea</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_infoprl_discover.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Dosier Discover</a></li>
                            </ul>
                        </div>

                        <!-- Segundo botón desplegable (Entrega EPIs) -->
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Entrega EPIs
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_amarrador.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Amarrador</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_auxiliarpasaje.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Aux. Pasaje</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_capitan.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Capitán</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_jefemaquinas.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Jefe maq.</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_limpieza.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Limpieza</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_marinero.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Marinero</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_marineromaquinas.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Marinero maq.</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_oficialcarga-amarrador.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Of. carga</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_primeroficial.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Primer of.</a></li>
                                <li><a class="dropdown-item" href="../maestros/documentos/pdf_epi_taller.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>">Epis Taller</a></li>
                            </ul>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR'): ?>

                            <a class="btn btn-danger btn-sm btn-font-size" href="../../app/controllers/trabajadores/borrar_trabajador.php?id_trabajador=<?php echo $trabajador_dato['id_trabajador']; ?>" style="text-align: right" onclick="return confirm('¿Realmente desea eliminar el registro?')" title="Eliminar Trabajador"><i class="bi bi-trash-fill"></i> Eliminar Trabajador</a>
                        <?php endif ?>

                    </div>
                    <div class="col-md-6 btn-text-right">

                        <style>
                            .btn-text-right {
                                text-align: right;
                            }
                        </style>
                        <?php $siguientetr = $id_trabajador + 1;
                        $anteriortr = $id_trabajador - 1; ?>

                        <a class="btn btn-text-right btn-outline-dark btn-sm" title="Ver anterior" href="../trabajadores/trabajadorshow.php?id_trabajador=<?php echo $anteriortr ?>">Ver Anterior</a>
                        <a class="btn btn-text-right btn-outline-dark btn-sm" title="Ver siguiente" href="../trabajadores/trabajadorshow.php?id_trabajador=<?php echo $siguientetr ?>">Ver Siguiente</a>


                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- inicio modal nuevo reconocimiento-->
    <div class="modal fade" id="modal-nuevoreconocimiento">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#ffd900 ;color:black">
                    <h5 class="modal-title" id="modal-nuevoreconocimiento">Nuevo Reconocimiento</h5>
                    <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="../../app/controllers/reconocimientos/create.php" method="post" enctype="multipart/form-data">


                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Nombre completo</label>
                                    <input type="text" value="<?php echo $trabajador_dato['nombre_tr'] ?>" class="form-control" readonly>
                                    <input type="text" value="<?php echo $trabajador_dato['id_trabajador'] ?>" name="trabajador_rm" class="form-control" hidden>
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha Reconocimiento</label>
                                    <input type="date" name="fecha_rm" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Valido hasta</label>
                                    <input type="date" name="caducidad_rm" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <br>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" value="1" name="vigente_rm" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <b>Vigente</b>
                                    </label>

                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="0" name="vigente_rm" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <b>No Vigente</b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" value="1" name="cita_rm" id="citaRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <b>Citado</b>
                                    </label>

                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="0" name="cita_rm" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <b>No Citado</b>
                                    </label>
                                </div>

                            </div>


                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Anotaciones / restricciones</label>
                                    <textarea class="form-control" name="anotaciones_rm" rows="6"></textarea>
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

    <!-- inicio modal nuevo reconocimiento-->
    <div class="modal fade" id="modal-nuevaentregainfoprl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0080c0 ;color:white">
                    <h5 class="modal-title" id="modal-nuevaentregainfoprl">Nuevo entrega info PRL</h5>
                    <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="../../app/controllers/trabajadores/create_entregainfo.php" method="post" enctype="multipart/form-data">


                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Trabajador</label>
                                    <input type="text" value="<?php echo $trabajador_dato['nombre_tr'] ?>" class="form-control" readonly>
                                    <input type="text" value="<?php echo $trabajador_dato['id_trabajador'] ?>" name="id_trabajador" class="form-control" hidden>
                                </div>
                            </div>

                        </div>



                        <div class="row">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <select name="id_infodoc" id="" class="form-control">
                                        <?php
                                        foreach ($info_documentos_datos as $info_documentos_dato) { ?>
                                            <option value="<?php echo $info_documentos_dato['id_infodoc']; ?>"><?php echo $info_documentos_dato['tipoinfo_ifd']; ?> - <?php echo $info_documentos_dato['nombre_ifd']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha entrega</label>
                                    <input type="date" name="fechaentrega" class="form-control">
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
    </div>
    <!--fin modal-->






    <div class="col-md-7">
        <div class="card">
            <div class="card-header col-md-12 bg-primary">
                <h3 class="card-title"><b>Trabajadores registrados</b></h3>
                <?php include('../../app/controllers/trabajadores/listado_trabajadores.php'); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example2" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="25%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="3%">
                                <col width="3%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="text-align: center">N.</th>
                                    <th style="text-align: center">DNI</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Empresa</th>
                                    <th style="text-align: center">Centro</th>
                                    <th style="text-align: center">Categoria</th>
                                    <th style="text-align: center">Estado</th>
                                    <th style="text-align: center" title="Formacion PRL">F</th>
                                    <th style="text-align: center" title="Informacion PRL">I</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($trabajadores as $trabajador) {
                                    $contador = $contador + 1;
                                    $id_trabajador = $trabajador['id_trabajador'];
                                ?>

                                    <tr>
                                        <td style="text-align: center"><?php echo $trabajador['codigo_tr']; ?></td>
                                        <td style="text-align: center"><?php echo $trabajador['dni_tr']; ?></td>
                                        <td><?php echo $trabajador['nombre_tr']; ?></td>
                                        <td><?php echo $trabajador['nombre_emp']; ?></td>
                                        <td><?php echo $trabajador['nombre_cen']; ?></td>
                                        <td><?php echo $trabajador['nombre_cat']; ?></td>
                                        <td style="text-align: center;"><?php $trabajador['activo_tr'];
                                                                        if ($trabajador['activo_tr'] == 1) { ?>
                                                <span class='badge badge-success' style="font-size: 15px;">Activo</span>
                                            <?php
                                                                        } else { ?>
                                                <span class='badge badge-danger' style="font-size: 15px;">Baja</span>
                                            <?php
                                                                        }
                                            ?>


                                        </td>
                                        <td><?php if ($trabajador['formacionpdt_tr'] == "Si") { ?>
                                                <span class='badge badge-success' style="font-size: 10px; color:#25aa3f">S</span>
                                            <?php
                                            } else { ?>
                                                <span class='badge badge-danger' style="font-size: 10px; color:crimson">N</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php if ($trabajador['informacion_tr'] == "Si") { ?>
                                                <span class='badge badge-success' style="font-size: 10px; color:#25aa3f">S</span>
                                            <?php
                                            } else { ?>
                                                <span class='badge badge-danger' style="font-size: 10px; color:crimson">N</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $id_trabajador; ?>" class="btn btn-primary btn-sm" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
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
        $("#example2").DataTable({
            "pageLength": 10,
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