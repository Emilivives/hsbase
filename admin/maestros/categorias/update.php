<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');

include('../../../app/controllers/maestros/categorias/listado_categorias.php');

$id_categoria = $_GET['id_categoria'];
include('../../../app/controllers/maestros/categorias/datos_categoria.php');
?>

<div class="container-fluid">
    <br>
    <h1>Modificar datos de la categoria <?php echo $nombre_cat; ?></h1>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Detalles de la categoria</b></h3>

                </div>
                <div class="card-body">
                    <form action="../../../app/controllers/maestros/categorias/update.php" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre Categoria <b>*</b></label>
                                    <input type="text" name="nombre_cat" value="<?php echo $nombre_cat; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descripcion categoria <b>*</b></label>
                                        <textarea class="form-control" id="descripcion_cat" name="descripcion_cat" rows="20"><?php echo $descripcion_cat; ?></textarea>

                                    </div>
                                </div>
                            </div>


                            <input type="text" name="id_categoria" value="<?php echo $id_categoria; ?>" hidden>
                   
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                    <input type="submit" class="btn btn-warning" value="Actualizar datos">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>


    </div>
</div>


<?php
include('../../../admin/layout/parte2.php');
include('../../../admin/layout/mensaje.php');
?>