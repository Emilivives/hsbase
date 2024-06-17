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
                    <form action="../../../app/controllers/maestros/empresas/update.php" method="post">

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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Logo Empresa</label>
                                    <input type="file" name="" class="form-control" id="file">
                                    <input type="text" name="logo_emp" value="<?php echo $logo_emp; ?>" hidden>
                                    <br>
                                    <output id="list" >
                                        <img src="<?php echo $URL . "/admin/maestros/centros/img/" . $logo_emp; ?>" width="100%" alt="">
                                    </output>
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object
                                            // Obtenemos la imagen del campo "file".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>

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