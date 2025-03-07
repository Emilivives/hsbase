<?php
require_once('../../../app/config.php');

// Validación de parámetros
if (!isset($_GET['id_revision'], $_GET['id_maquina'])) {
    die("Error: Faltan parámetros necesarios.");
}

$id_revision = filter_var($_GET['id_revision'], FILTER_SANITIZE_NUMBER_INT);
$id_maquina = filter_var($_GET['id_maquina'], FILTER_SANITIZE_NUMBER_INT);

// Consulta para obtener los detalles de la máquina
$query_maquina = "SELECT maq.marca_maq AS marca, 
                         maq.modelo_maq AS modelo, 
                         maq.numserie_maq AS num_serie, 
                         tm.nombre_tm AS nombre_tipo_maquina
                  FROM er_revision_maquina AS rev
                  INNER JOIN inv_maquinaria AS maq ON rev.id_maquina = maq.id_maquina
                  INNER JOIN tipomaquinas AS tm ON maq.tipo_maq = tm.id_tipomaquina
                  WHERE rev.id_revision = :id_revision AND rev.id_maquina = :id_maquina";
$stmt_maquina = $pdo->prepare($query_maquina);
$stmt_maquina->execute([':id_revision' => $id_revision, ':id_maquina' => $id_maquina]);
$maquina = $stmt_maquina->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener las preguntas
$sql = "SELECT 
            id_elemento,
            grupo,
            descripcion,
            tipo 
        FROM er_elementos_revisionmaq 
        ORDER BY grupo, id_elemento";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener grupos únicos para las tabs
$grupos = array_unique(array_column($preguntas, 'grupo'));
// Añadir el grupo de EVALUACION FINAL
$grupos[] = 'EVALUACION FINAL';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión Máquina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .pregunta-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .pregunta-item:hover {
            background-color: #f0f0f0;
        }

        .form-select,
        .form-control {
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
        }

        .nav-tabs .nav-link {
            color: #495057;
            border: 1px solid transparent;
            border-radius: 0;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
            isolation: isolate;
        }

        .nav-tabs .nav-link.active {
            color: #0056b3;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
            font-weight: 500;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            background-color: #fff;
        }

        .tab-pane {
            padding: 15px 0;
        }

        .form-container {
            max-width: 1200px;
            margin: 1rem auto;
            padding: 0 1rem;
        }

        h5 {
            margin-bottom: 1rem;
            margin-top: 1;
        }

        .nav-link.inactive {
            background-color: #f0f0f0;
            color: #6c757d;
        }

        .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        .nivel-riesgo-select {
            display: none;
            margin-top: 0.5rem;
            max-width: 200px;
            position: relative;
            z-index: 1056;
        }

        .nivel-riesgo-select.visible {
            display: block;
        }

        .modal-body {
            overflow: visible !important;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h5>Equipo: <?php echo $maquina['nombre_tipo_maquina'] ?> | <?php echo $maquina['marca'] ?> | <?php echo $maquina['modelo'] ?> | <?php echo $maquina['num_serie'] ?></h5>

        <form id="formRevision" action="../../app/controllers/evaluacion/guardar_respuestas_maq.php" method="POST">
            <input type="hidden" name="id_revision" value="<?= htmlspecialchars($id_revision) ?>">
            <input type="hidden" name="id_maquina" value="<?= htmlspecialchars($id_maquina) ?>">

            <!-- Navegación de tabs -->
            <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                <?php foreach ($grupos as $index => $grupo):
                    if ($grupo === 'EVALUACION FINAL'): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link inactive"
                                id="tab_evaluacion_final"
                                data-bs-toggle="tab"
                                data-bs-target="#panel_evaluacion_final"
                                type="button"
                                role="tab"
                                aria-selected="false">
                                <?= htmlspecialchars($grupo) ?>
                            </button>
                        </li>
                    <?php else:
                        $grupo_id = 'grupo_' . $index; ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?= $index === 0 ? 'active' : 'inactive' ?>"
                                id="tab_<?= $grupo_id ?>"
                                data-bs-toggle="tab"
                                data-bs-target="#panel_<?= $grupo_id ?>"
                                type="button"
                                role="tab"
                                aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <?= htmlspecialchars($grupo) ?>
                            </button>
                        </li>
                <?php endif;
                endforeach; ?>
            </ul>

            <!-- Contenido de los tabs -->
            <div class="tab-content" id="myTabContent">
                <?php
                $grupo_actual = '';
                foreach ($preguntas as $index => $pregunta):
                    if ($grupo_actual !== $pregunta['grupo']):
                        if ($grupo_actual !== ''): ?>
            </div>
        <?php endif;
                        $grupo_actual = $pregunta['grupo'];
                        $grupo_id = 'grupo_' . array_search($grupo_actual, $grupos);
        ?>
        <div class="tab-pane fade <?= $grupo_id === 'grupo_0' ? 'show active' : '' ?>"
            id="panel_<?= $grupo_id ?>"
            role="tabpanel"
            tabindex="0">
        <?php endif; ?>

        <div class="pregunta-item">
            <label class="form-label fw-bold">
                <?= htmlspecialchars($pregunta['descripcion']) ?>
            </label>

            <?php if ($pregunta['tipo'] === 'RESPUESTA'): ?>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <select
                        name="respuestas[<?= $pregunta['id_elemento'] ?>]"
                        class="form-select"
                        style="width: 140px;"
                        required>
                        <option value="">Seleccione...</option>
                        <option value="SI">Sí</option>
                        <option value="NO">No</option>
                        <option value="N/A">N/A</option>
                    </select>

                    <input
                        type="text"
                        name="observaciones[<?= $pregunta['id_elemento'] ?>]"
                        class="form-control"
                        style="max-width: 400px;"
                        placeholder="Observación...">

                    <div class="form-check ms-2">
                        <input
                            type="checkbox"
                            class="form-check-input planificacion-check"
                            name="planificaciones[<?= $pregunta['id_elemento'] ?>]"
                            value="1">
                        <label class="form-check-label">A planificar</label>
                    </div>

                    <select
                        name="nivel_riesgo[<?= $pregunta['id_elemento'] ?>]"
                        class="form-select nivel-riesgo-select"
                        style="width: 140px;">
                        <option value="">Seleccione nivel...</option>
                        <option value="Trivial">Trivial</option>
                        <option value="Tolerable">Tolerable</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Importante">Importante</option>
                        <option value="Intolerable">Intolerable</option>
                    </select>
                </div>

            <?php elseif ($pregunta['tipo'] === 'OBSERVACION'): ?>
                <textarea
                    name="observaciones[<?= $pregunta['id_elemento'] ?>]"
                    class="form-control"
                    rows="2"
                    placeholder="Ingrese una observación..."></textarea>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
        </div>

        <!-- Pestaña de EVALUACION FINAL -->
        <div class="tab-pane fade" id="panel_evaluacion_final" role="tabpanel" tabindex="0">
            <div class="pregunta-item">
                <label class="form-label fw-bold">
                    Valoración del equipo:
                </label>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valoracion_equipo" value="Bien" checked>
                        <label class="form-check-label">Bien</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valoracion_equipo" value="Aceptable">
                        <label class="form-check-label">Aceptable</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valoracion_equipo" value="Deficiente">
                        <label class="form-check-label">Deficiente</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valoracion_equipo" value="Muy deficiente">
                        <label class="form-check-label">Muy Deficiente</label>
                    </div>
                </div>
            </div>

            <div class="pregunta-item">
                <label class="form-label fw-bold">
                    Evaluación general del equipo:
                </label>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="evaluacion_final[]" value="No se observan disconformidades destacables que requieran efectuar correcciones técnicas">
                        <label class="form-check-label">No se observan disconformidades destacables que requieran efectuar correcciones técnicas</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="evaluacion_final[]" value="Para obtener un nivel de riesgo aceptable o superior, se aplicarán las medidas correctoras propuestas">
                        <label class="form-check-label">Para obtener un nivel de riesgo aceptable o superior, se aplicarán las medidas correctoras propuestas</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="evaluacion_final[]" value="La complejidad de las disconformidades detectadas requiere que se efectué un estudio específico de adecuación al RD 1215/97; hasta
la realización del estudio se deberán ir implantando las medidas correctoras propuestas">
                        <label class="form-check-label">La complejidad de las disconformidades detectadas requiere que se efectué un estudio específico de adecuación al RD 1215/97; hasta
                        la realización del estudio se deberán ir implantando las medidas correctoras propuestas</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="evaluacion_final[]" value="La complejidad de las disconformidades detectadas requiere, con prioridad máxima, efectuar un estudio específico de adecuación al
RD 1215/97">
                        <label class="form-check-label">La complejidad de las disconformidades detectadas requiere, con prioridad máxima, efectuar un estudio específico de adecuación al
                        RD 1215/97</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-3 text-end">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Guardar Respuestas
        </button>
    </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validación del formulario
            const form = document.getElementById('formRevision');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });

            // Controlar visibilidad del select de nivel de riesgo
            const checkboxes = document.querySelectorAll('.planificacion-check');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const nivelRiesgoSelect = this.closest('.d-flex').querySelector('.nivel-riesgo-select');
                    if (this.checked) {
                        nivelRiesgoSelect.classList.add('visible');
                        nivelRiesgoSelect.required = true;
                    } else {
                        nivelRiesgoSelect.classList.remove('visible');
                        nivelRiesgoSelect.required = false;
                        nivelRiesgoSelect.value = '';
                    }
                });
            });
        });
    </script>
</body>

</html>