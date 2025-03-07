<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/evaluacion/listado_evaluacion_equipos.php');
include('../../app/controllers/maestros/centros/listado_centros.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
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
                <h3 class="m-0">Evaluaciones de equipos de trabajo</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Evaluaciones</a></li>
                    <li class="breadcrumb-item active">Indice</li>
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
                <h3 class="card-title"><b>Evaluacion de equipos de trabajo</b></h3>
                <style>
                    .btn-text-right {
                        text-align: right;
                    }
                </style>
                <!--boton modal-->
                <div class="btn-text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-font-size" data-toggle="modal" data-target="#modal-nuevaevaluacion">NUEVA EVALUACION</button>
                </div>

                <!--inicio modal nuev accion prl-->
                <div class="modal fade" id="modal-nuevaevaluacion">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#0000a0;color:white">
                                <h5 class="modal-title" id="modal-nuevaevaluacion">Nueva Evaluación de equipos de trabajo</h5>
                                <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="../../app/controllers/evaluacion/create_evaluacion_maquina.php" method="post" enctype="multipart/form-data">

                                    <div class="well">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="fecha_er" class="col-form-label col-sm-3">Fecha:</label>
                                                    <div class="col-sm-5">
                                                        <input type="date" name="fecha_er" id="fecha_er" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="centro_er" class="col-form-label col-sm-3">Centro: *</label>
                                                    <div class="col-sm-7">
                                                        <select name="centro_er" id="centro_er" class="form-control" required>
                                                            <option value="0">--Seleccione centro--</option>
                                                            <?php
                                                            foreach ($centros_datos as $centros_dato) { ?>
                                                                <option value="<?php echo $centros_dato['id_centro']; ?>">
                                                                    <?php echo $centros_dato['nombre_cen']; ?>
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
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="descripcion_er" class="col-form-label col-sm-2">Descripción:</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="descripcion_er" id="descripcion_er" rows="3" class="form-control" placeholder="Breve descripción de la revisión" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table id="example1" class="table tabe-hover table-condensed">
                        <colgroup>
                            <col width="10%">
                            <col width="10%">
                            <col width="30%">
                            <col width="40%">
                            <col width="10%">




                        </colgroup>
                        <thead class="table-dark">

                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Centro</th>
                                <th>Descripción</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($er_equipos_centro as $evaluacion): ?>
                                <?php $id = htmlspecialchars($evaluacion['id_equiposcentro']); ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= htmlspecialchars($evaluacion['fecha']) ?></td>
                                    <td><?= htmlspecialchars($evaluacion['nombre_cen']) ?></td>
                                    <td><?= htmlspecialchars($evaluacion['descripcion']) ?></td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group">
                                        <a href="show_equiposcentro.php?id=<?php echo $evaluacion['id_equiposcentro']; ?>" class="btn btn-primary btn-sm btn-font-size" title="Ver detalles"><i class="bi bi-folder-fill"></i> Ver</a>
                                            <a href="../../app/controllers/evaluacion/delete_er_equiposcentro.php?id=<?= $id ?>" class="btn btn-danger btn-sm btn-font-size" onclick="return confirm('¿Realmente desea eliminar la evaluación?')" title="Eliminar evaluación equipos">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>


                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>