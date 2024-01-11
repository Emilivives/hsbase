<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');
include('../../../app/controllers/maestros/accidentes/listado_actividadfisica.php');
include('../../../app/controllers/maestros/accidentes/listado_agentematerial.php');
include('../../../app/controllers/maestros/accidentes/listado_desviacion.php');
include('../../../app/controllers/maestros/accidentes/listado_formacontacto.php');
include('../../../app/controllers/maestros/accidentes/listado_gravedad.php');
include('../../../app/controllers/maestros/accidentes/listado_partecuerpo.php');
include('../../../app/controllers/maestros/accidentes/listado_tipolesion.php');
include('../../../app/controllers/maestros/accidentes/listado_tipotrabajo.php');


?>
<br>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>TABLAS MAESTRAS</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Maestros</a></li>
                    <li class="breadcrumb-item active">Tablas Varias</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">


    <div class="row">

        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Actividad fisica</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo actividad fisica</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_actividadfisica_datos as $ace_actividadfisica_dato) {
                                $contador = $contador + 1;
                                $id_actividadfisica = $ace_actividadfisica_dato['id_actividadfisica'];
                            ?>
                                <tr>
                                    <td><?php echo $ace_actividadfisica_dato['codactivfis_af']; ?></td>
                                    <td><?php echo $ace_actividadfisica_dato['activfisica_af']; ?></td>



                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Agente material</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo agente material</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_agentematerial_datos as $ace_agentematerial_dato) {
                                $contador = $contador + 1;
                                $id_responsable = $ace_agentematerial_dato['id_agentematerial'];
                            ?>
                                <tr>

                                    <td><?php echo $ace_agentematerial_dato['codagentemat_am']; ?></td>
                                    <td><?php echo $ace_agentematerial_dato['agentematerial_am']; ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Desviacion</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example3" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo Desviacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_desviacion_datos as $ace_desviacion_dato) {
                                $contador = $contador + 1;
                                $id_desviacion = $ace_desviacion_dato['id_desviacion'];
                            ?>
                                <tr>

                                    <td><?php echo $ace_desviacion_dato['coddesviacion_des']; ?></td>
                                    <td><?php echo $ace_desviacion_dato['desviacion_des']; ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>
        <div class="col-md-2">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Gravedad</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example5" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo gravedad</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_gravedad_datos as $ace_gravedad_dato) {
                                $contador = $contador + 1;
                                $id_gravedad = $ace_gravedad_dato['id_gravedad'];
                            ?>
                                <tr>
                                    <td><?php echo $ace_gravedad_dato['codgravedad_gr']; ?></td>
                                    <td><?php echo $ace_gravedad_dato['gravedad_gr']; ?></td>

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

    <div class="row">

        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Forma de contacto</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Num.</th>
                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo Forma de contacto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_formacontacto_datos as $ace_formacontacto_dato) {
                                $contador = $contador + 1;
                                $id_formacontacto = $ace_formacontacto_dato['id_formacontacto'];
                            ?>
                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $ace_formacontacto_dato['codformacont_fc']; ?></td>
                                    <td><?php echo $ace_formacontacto_dato['formacontacto_fc']; ?></td>



                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Parte cuerpo</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example6" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Parte cuerpo</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_partecuerpo_datos as $ace_partecuerpo_dato) {
                                $contador = $contador + 1;
                                $id_partecuerpo = $ace_partecuerpo_dato['id_partecuerpo'];
                            ?>
                                <tr>
                                    <td><?php echo $ace_partecuerpo_dato['codpartecuerpo_pc']; ?></td>
                                    <td><?php echo $ace_partecuerpo_dato['partecuerpo_pc']; ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>
        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Tipo Lesión</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example7" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo Lesión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_tipolesion_datos as $ace_tipolesion_dato) {
                                $contador = $contador + 1;
                                $id_tipolesion = $ace_tipolesion_dato['id_tipolesion'];
                            ?>
                                <tr>
                                    <td><?php echo $ace_tipolesion_dato['codtipolesion_tl']; ?></td>
                                    <td><?php echo $ace_tipolesion_dato['tipolesion_tl']; ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>
        <div class="col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header col-md-12">
                    <h3 class="card-title"><b>Tipo Trabajo</b></h3>
                    <style>
                        .btn-text-right {
                            text-align: right;
                        }
                    </style>
                    <!-- Button trigger modal -->
                    <div class="btn-text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevoresponsable">Añadir</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-nuevoresponsable">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#808000 ;color:white">
                                <h5 class="modal-title" id="modal-nuevoresponsable">Tipo de Formación</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../../app/controllers/maestros/ace_actividadfisica/create.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre Responsable <b>*</b></label>
                                                <input type="text" name="nombre_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo_resp" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">email <b>*</b></label>
                                                <input type="text" name="email_resp" class="form-control" required>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!--fin modal-->

                <div class="card-body">
                    <table id="example8" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">Cód.</th>
                                <th style="text-align: center">Tipo Trabajo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($ace_tipotrabajo_datos as $ace_tipotrabajo_dato) {
                                $contador = $contador + 1;
                                $id_tipotrabajo = $ace_tipotrabajo_dato['id_tipotrabajo'];
                            ?>
                                <tr>
                                    <td><?php echo $ace_tipotrabajo_dato['codigo_tt']; ?></td>
                                    <td><?php echo $ace_tipotrabajo_dato['descripcion_tt']; ?></td>

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
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
</script>

<script>
    $(function() {
        $("#example2").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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
            }],
        }).buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example3").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example3_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example4").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example4_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example5").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ r.",
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

            ],
        }).buttons().container().appendTo("#example5_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example6").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example6_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example7").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example7_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    $(function() {
        $("#example8").DataTable({
            "pageLength": 4,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtrado de MAX total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
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

            ],
        }).buttons().container().appendTo("#example8_wrapper .col-md-6:eq(0)");
    });
</script>