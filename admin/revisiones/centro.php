<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/reconocimientos/listado_reconocimientos.php');
include('../../app/controllers/trabajadores/listado_trabajadores_alfabet.php');
include('../../app/controllers/reconocimientos/listado_citasrm.php');
include('../../app/controllers/maestros/emailsinteres/listado_emailsinteres.php');
?>
<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .dropdown-font-size {
            font-size: 12px;
        }

        .vencido {
            background-color: red;
            color: white;
        }

        .badge-wh-1 {
            display: inline-block;
            min-width: 1px;
            padding: 1px 1px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            background-color: #f58da3;
            line-height: 6;
            vertical-align: bottom;
            white-space: nowrap;
            text-align: center;
            border-radius: 5px;
        }

        .highlight {
            border-top: 3px solid #ff0000;
            /* Puedes ajustar el color y el estilo del borde */
        }
        </style>

</head>
<html>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0"><b>Reconocimientos médicos realizados</b></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Control reconocimientos médicos</li>
                </ol>
            </div><!-- /.col -->
            <hr>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión Periódica de las Condiciones de Trabajo</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Revisión Periódica de las Condiciones de Trabajo</h1>
    <form action="procesar_formulario.php" method="POST">

        <!-- Información general del centro -->
        <div class="mb-3">
            <label for="centro_trabajo" class="form-label">Centro de Trabajo:</label>
            <input type="text" id="centro_trabajo" name="centro_trabajo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="uso_centro" class="form-label">Uso del Centro:</label>
            <input type="text" id="uso_centro" name="uso_centro" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="inspector" class="form-label">Inspección realizada por:</label>
            <input type="text" id="inspector" name="inspector" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>

        <!-- Sección desplegable: Condiciones Generales -->
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        2. Condiciones Generales
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <!-- Pregunta 2.1.1 -->
                        <p>2.1.1 ¿Ofrece seguridad frente a los siguientes peligros?</p>
                        <label for="resbalones">Resbalones o caídas:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="resbalones" id="resbalones_si" value="Sí" required>
                            <label class="form-check-label" for="resbalones_si">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="resbalones" id="resbalones_no" value="No">
                            <label class="form-check-label" for="resbalones_no">No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="resbalones" id="resbalones_na" value="N/A">
                            <label class="form-check-label" for="resbalones_na">N/A</label>
                        </div>

                        <!-- Pregunta 2.1.2 -->
                        <p class="mt-3">2.1.2 ¿Facilita la rápida y segura evacuación de los trabajadores?</p>
                        <label for="evacuacion">Evacuación segura:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="evacuacion" id="evacuacion_si" value="Sí" required>
                            <label class="form-check-label" for="evacuacion_si">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="evacuacion" id="evacuacion_no" value="No">
                            <label class="form-check-label" for="evacuacion_no">No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="evacuacion" id="evacuacion_na" value="N/A">
                            <label class="form-check-label" for="evacuacion_na">N/A</label>
                        </div>

                        <!-- Añadir más preguntas según sea necesario -->
                    </div>
                </div>
            </div>

            <!-- Sección 2.4: Zonas de Riesgo -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2.4 Zonas de Riesgo
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- Pregunta 2.4.1 -->
                        <p>2.4.1 ¿Se adoptan medidas para la protección de los trabajadores autorizados al acceso a dichas zonas?</p>
                        <label for="zonas_riesgo">Medidas adoptadas:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="zonas_riesgo" id="zonas_riesgo_si" value="Sí" required>
                            <label class="form-check-label" for="zonas_riesgo_si">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="zonas_riesgo" id="zonas_riesgo_no" value="No">
                            <label class="form-check-label" for="zonas_riesgo_no">No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="zonas_riesgo" id="zonas_riesgo_na" value="N/A">
                            <label class="form-check-label" for="zonas_riesgo_na">N/A</label>
                        </div>

                        <!-- Añadir más preguntas según sea necesario -->
                    </div>
                </div>
            </div>

        </div>

        <!-- Botón de envío -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
include('../../admin/layout/parte2.php');
include('../../admin/layout/mensaje.php');
?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>
