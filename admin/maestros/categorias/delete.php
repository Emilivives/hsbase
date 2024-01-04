<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');

$id_categoria = $_GET['id_categoria'];
include('../../../app/controllers/maestros/categorias/datos_categoria.php');

?>

<div class="container-fluid">
    <br>
    <h2>CATEGORIA: <?php echo $id_categoria; ?> - <?php echo $nombre_cat ?></h2>
    <br>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>¿Está seguro eliminar esta categoria?</b></h3>

                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre categoria </label>
                                <input type="text" value="<?php echo $nombre_cat ?>" name="nombre_cat" class="form-control" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Descripcion categoria <b>*</b></label>
                                <textarea class="form-control" id="descripcion_cat" name="descripcion_cat" rows="20" disabled><?php echo $descripcion_cat; ?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6 align-center">
                        <div class="form-group">

                            <form action="<?php echo $URL; ?>/app/controllers/maestros/categorias/delete.php" method="post">
                                <input type="text" value="<?php echo $id_categoria; ?>" name="id_categoria" hidden>
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                


            </div>

        </div>

    </div>

</div>


</div>


<?php
include('../../../admin/layout/parte2.php');
include('../../../admin/layout/mensaje.php');
?>