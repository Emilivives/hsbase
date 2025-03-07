<?php
require_once('../../../app/config.php');

if (!isset($_GET['id_revision'], $_GET['id_maquina'])) {
    die("Error: Faltan parámetros necesarios para cargar las respuestas.");
}

$id_revision = $_GET['id_revision'];
$id_maquina = $_GET['id_maquina'];

// Obtener las respuestas con la información de los elementos
$sql = "SELECT er.*, e.descripcion, e.grupo, e.tipo, er.id_respuesta
        FROM er_revision_maquina rm
        JOIN er_revisionmaq_respuestas er ON rm.id_revision_maquina = er.id_revision_maquina
        JOIN er_elementos_revisionmaq e ON er.id_elemento = e.id_elemento
        WHERE rm.id_revision = :id_revision 
        AND rm.id_maquina = :id_maquina
        ORDER BY e.grupo, e.id_elemento";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id_revision' => $id_revision,
    ':id_maquina' => $id_maquina
]);

$respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener la evaluación final y valoración del equipo
$sql_evaluacion = "SELECT valoracion_equipo, evaluacion_final 
                   FROM er_revision_maquina 
                   WHERE id_revision = :id_revision 
                   AND id_maquina = :id_maquina";

$stmt_eval = $pdo->prepare($sql_evaluacion);
$stmt_eval->execute([
    ':id_revision' => $id_revision,
    ':id_maquina' => $id_maquina
]);

$evaluacion = $stmt_eval->fetch(PDO::FETCH_ASSOC);
$valoracion_equipo = $evaluacion['valoracion_equipo'] ?? '';
$evaluacion_final = explode(',', $evaluacion['evaluacion_final'] ?? '');

// Agrupar respuestas por grupo
$grupos = [];
foreach ($respuestas as $respuesta) {
    $grupos[$respuesta['grupo']][] = $respuesta;
}

if (empty($grupos)) {
    echo "<p>No se encontraron respuestas registradas para esta máquina.</p>";
    exit();
}
?>

<style>
    .mi-select {
        width: 80px;
    }
</style>

<form id="formEditarRespuestas" method="POST" action="../../app/controllers/evaluacion/actualizar_respuestas_maq.php">
    <input type="hidden" name="id_revision" value="<?= htmlspecialchars($id_revision) ?>">
    <input type="hidden" name="id_maquina" value="<?= htmlspecialchars($id_maquina) ?>">

    <!-- Pestaña de Evaluación Final -->
    <div class="d-flex">
    <!-- Div de Valoración del equipo con 1/4 de ancho -->
    <div class="mb-3 w-25 pe-2">
        <label class="form-label fw-bold">Valoración del equipo:</label>
        <div class="d-flex flex-column gap-2">
            <?php 
            $opciones_valoracion = ["Bien", "Aceptable", "Deficiente", "Muy deficiente"];
            foreach ($opciones_valoracion as $opcion): ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="valoracion_equipo" 
                        value="<?= $opcion ?>" <?= ($valoracion_equipo === $opcion) ? 'checked' : '' ?>>
                    <label class="form-check-label"><?= $opcion ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Div de Evaluación general del equipo con 3/4 de ancho -->
    <div class="mb-3 w-75 ps-2">
        <label class="form-label fw-bold">Evaluación general del equipo:</label>
        <div class="d-flex flex-column gap-2">
            <?php 
            $opciones_evaluacion = [
                "No se observan disconformidades destacables que requieran efectuar correcciones técnicas",
                "Para obtener un nivel de riesgo aceptable o superior, se aplicarán las medidas correctoras propuestas",
                "La complejidad de las disconformidades detectadas requiere que se efectúe un estudio específico de adecuación al RD 1215/97; hasta la realización del estudio se deberán ir implantando las medidas correctoras propuestas",
                "La complejidad de las disconformidades detectadas requiere, con prioridad máxima, efectuar un estudio específico de adecuación al RD 1215/97"
            ];
            foreach ($opciones_evaluacion as $opcion): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="evaluacion_final[]" 
                        value="<?= $opcion ?>" <?= in_array($opcion, $evaluacion_final) ? 'checked' : '' ?>>
                    <label class="form-check-label"><?= $opcion ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


    <!-- Acordeón para las respuestas -->
    <div class="accordion" id="acordeonRespuestas">
        <?php $index = 0; ?>
        <?php foreach ($grupos as $grupo => $respuestasGrupo): ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-<?= $index ?>">
                    <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" 
                        type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse-<?= $index ?>" 
                        aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" 
                        aria-controls="collapse-<?= $index ?>">
                        <?= htmlspecialchars($grupo) ?>
                    </button>
                </h2>
                <div id="collapse-<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                    aria-labelledby="heading-<?= $index ?>" data-bs-parent="#acordeonRespuestas">
                    <div class="accordion-body">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th>Observación</th>
                                    <th>Planificación</th>
                                    <th>Nivel de Riesgo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($respuestasGrupo as $respuesta): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($respuesta['descripcion']) ?></td>
                                        <td>
                                            <input type="hidden" name="respuestas[<?= $respuesta['id_respuesta'] ?>][id_elemento]" 
                                                value="<?= htmlspecialchars($respuesta['id_elemento']) ?>">
                                            <?php if ($respuesta['tipo'] === 'RESPUESTA'): ?>
                                                <select name="respuestas[<?= $respuesta['id_respuesta'] ?>][respuesta]" class="form-select mi-select">
                                                    <option value="SI" <?= $respuesta['respuesta'] === 'SI' ? 'selected' : '' ?>>SI</option>
                                                    <option value="NO" <?= $respuesta['respuesta'] === 'NO' ? 'selected' : '' ?>>NO</option>
                                                    <option value="N/A" <?= $respuesta['respuesta'] === 'N/A' ? 'selected' : '' ?>>N/A</option>
                                                </select>
                                            <?php else: ?>
                                                <textarea name="respuestas[<?= $respuesta['id_respuesta'] ?>][respuesta]" class="form-control" rows="1"><?= htmlspecialchars($respuesta['respuesta']) ?></textarea>
                                            <?php endif; ?>
                                        </td>
                                        <td><textarea name="respuestas[<?= $respuesta['id_respuesta'] ?>][observacion]" class="form-control" rows="2"><?= htmlspecialchars($respuesta['observacion'] ?? '') ?></textarea></td>
                                        <td><input type="checkbox" name="respuestas[<?= $respuesta['id_respuesta'] ?>][planificacion]" value="1" <?= isset($respuesta['planificacion']) && $respuesta['planificacion'] == 1 ? 'checked' : '' ?>></td>
                                        <td>
                                            <select name="respuestas[<?= $respuesta['id_respuesta'] ?>][gradoriesgo]" class="form-select">
                                                <option value="">Seleccione...</option>
                                                <option value="Trivial" <?= $respuesta['gradoriesgo'] === 'Trivial' ? 'selected' : '' ?>>Trivial</option>
                                                <option value="Tolerable" <?= $respuesta['gradoriesgo'] === 'Tolerable' ? 'selected' : '' ?>>Tolerable</option>
                                                <option value="Moderado" <?= $respuesta['gradoriesgo'] === 'Moderado' ? 'selected' : '' ?>>Moderado</option>
                                                <option value="Importante" <?= $respuesta['gradoriesgo'] === 'Importante' ? 'selected' : '' ?>>Importante</option>
                                                <option value="Intolerable" <?= $respuesta['gradoriesgo'] === 'Intolerable' ? 'selected' : '' ?>>Intolerable</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
</form>
