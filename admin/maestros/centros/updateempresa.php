<?php
include('../../../app/config.php');
include('../../../admin/layout/parte1.php');

include('../../../app/controllers/maestros/empresas/listado_empresas.php');

$id_empresa = $_GET['id_empresa'];

include('../../../app/controllers/maestros/empresas/datos_empresa.php');
?>

<div class="container-fluid">

    <h1>Modificar datos de la empresa <?php echo $nombre_emp; ?></h1>

    <div class="row">
        </br>
        <div class="col-md-6">

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Detalles de la empresa</b></h3>

                </div>
                <div class="card-body">
                    <form action="../../../app/controllers/maestros/empresas/updtate.php" method="post" enctype="multipart/form-data">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre Empresa <b>*</b></label>
                                    <input type="text" name="nombre_emp" value="<?php echo $nombre_emp ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cif Empresa <b>*</b></label>
                                    <input type="text" name="cif_emp" value="<?php echo $cif_emp ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Dirección <b>*</b></label>
                                    <input type="text" name="direccion_emp" value="<?php echo $direccion_emp ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Razon Social (nombre completo) <b>*</b></label>
                                    <input type="text" name="razonsocial_emp" value="<?php echo $razonsocial_emp ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Modalidad preventiva <b>*</b></label>
                                    <input type="text" name="modalidadprl_emp" value="<?php echo $modalidadprl_emp ?>" class="form-control" required>
                                </div>
                            </div>
                            <!-- Subida de Imagen con Vista Previa -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Logo Empresa</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <input type="hidden" name="logo_actual" value="<?php echo $logo_emp; ?>">

                                    <br>
                                    <div id="preview">
                                        <img id="logoPreview" src="<?php echo $URL . "/admin/maestros/centros/img/" . $logo_emp; ?>" width="100%" alt="">
                                    </div>
                                </div>
                            </div>
                            <!-- JavaScript para Vista Previa de Imagen -->
                            <script>
                                document.getElementById('image').addEventListener('change', function(event) {
                                    var files = event.target.files;
                                    if (files.length > 0) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById('logoPreview').src = e.target.result;
                                        };
                                        reader.readAsDataURL(files[0]);
                                    }
                                });
                            </script>

                            <hr>
                            <div class="row">

                                <input type="text" name="id_empresa" value="<?php echo $id_empresa; ?>" hidden>
                                <hr>
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


    <?php
    include('../../../admin/layout/parte2.php');
    include('../../../admin/layout/mensaje.php');
    ?>