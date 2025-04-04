<?php
include('../../config.php');

$sql = "SELECT tr.id_trabajador, tr.codigo_tr, tr.dni_tr, tr.nombre_tr, cat.nombre_cat,
               tr.sexo_tr, tr.fechanac_tr, tr.inicio_tr, tr.activo_tr,
               tr.formacionpdt_tr, tr.informacion_tr, cen.nombre_cen, emp.nombre_emp
        FROM trabajadores as tr
        INNER JOIN categorias as cat ON tr.categoria_tr = cat.id_categoria
        INNER JOIN centros as cen ON tr.centro_tr = cen.id_centro
        INNER JOIN empresa as emp ON cen.empresa_cen = emp.id_empresa
        ORDER BY tr.nombre_tr ASC";

try {
    $query = $pdo->prepare($sql);
    $query->execute();
    $trabajadores = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Log error or display user-friendly message
    error_log("Database error: " . $e->getMessage());
    die("Sorry, there was an error loading employee data.");
}
?>

<table id="tablaTrabajadores" class="table table-striped">
    <thead class="table-primary">
        <!-- In your head section, add these links -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<!-- Resto de scripts de DataTables -->
        <tr>
            <th>Código</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trabajadores as $trabajador) { ?>
            <tr>
                <td class="codigo"><?= $trabajador['codigo_tr']; ?></td>
                <td class="dni"><?= $trabajador['dni_tr']; ?></td>
                <td class="nombre"><?= $trabajador['nombre_tr']; ?></td>
                <td class="categoria"><?= $trabajador['nombre_cat']; ?></td>
                <td>
                <button class="btn btn-info btn-sm toggle-details" 
        data-bs-toggle="collapse"
        data-bs-target="#info-<?= $trabajador['id_trabajador']; ?>"
        aria-expanded="false">
    Ver más/Menos
</button>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div id="info-<?= $trabajador['id_trabajador']; ?>" class="collapse">
                        <div class="card card-body">
                            <ul class="nav nav-tabs" id="tab-<?= $trabajador['id_trabajador']; ?>" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#datos-<?= $trabajador['id_trabajador']; ?>" role="tab">Datos Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#formaciones-<?= $trabajador['id_trabajador']; ?>" role="tab">Formaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#informaciones-<?= $trabajador['id_trabajador']; ?>" role="tab">Informaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#reconocimientos-<?= $trabajador['id_trabajador']; ?>" role="tab">Reconocimientos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#accidentes-<?= $trabajador['id_trabajador']; ?>" role="tab">Accidentes</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="datos-<?= $trabajador['id_trabajador']; ?>" role="tabpanel">
                                    <p><strong>Empresa:</strong> <?= $trabajador['nombre_emp']; ?></p>
                                    <p><strong>Centro:</strong> <?= $trabajador['nombre_cen']; ?></p>
                                    <p><strong>Inicio:</strong> <?= $trabajador['inicio_tr']; ?></p>
                                    <p><strong>Estado:</strong> <?= ($trabajador['activo_tr'] == 1) ? 'Activo' : 'Baja'; ?></p>
                                </div>
                                <div class="tab-pane fade" id="formaciones-<?= $trabajador['id_trabajador']; ?>" role="tabpanel">
                                    <?php
                                    $id_trabajador = $trabajador['id_trabajador'];
                                    include 'partials/trabajador_formacion.php';
                                    ?>
                                </div>
                                <div class="tab-pane fade" id="informaciones-<?= $trabajador['id_trabajador']; ?>" role="tabpanel">
                                    <?php
                                    $id_trabajador = $trabajador['id_trabajador'];
                                    include 'partials/trabajador_informacion.php';
                                    ?>
                                </div>
                                <div class="tab-pane fade" id="reconocimientos-<?= $trabajador['id_trabajador']; ?>" role="tabpanel">
                                    <?php
                                    $id_trabajador = $trabajador['id_trabajador'];
                                    include 'partials/trabajador_reconocimientos.php';
                                    ?>
                                </div>
                                <div class="tab-pane fade" id="accidentes-<?= $trabajador['id_trabajador']; ?>" role="tabpanel">
                                    <?php
                                    $id_trabajador = $trabajador['id_trabajador'];
                                    include 'partials/trabajador_accidentes.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<!-- At the end of your body, add these scripts -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Configuración de DataTables con traducción local
    var spanishTranslation = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };

    // Inicializar DataTables con traducción manual
    var table = $('#tablaTrabajadores').DataTable({
        language: spanishTranslation,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,
        // Deshabilitar advertencias
        "oLanguage": {
            "sEmptyTable": "No hay datos disponibles en la tabla"
        }
    });

    // Gestión del botón de acordeón más robusta
    $(document).on('click', '.toggle-details', function() {
        var $button = $(this);
        var $row = $button.closest('tr');
        var $detailsRow = $row.next('tr');
        var $detailsCollapse = $detailsRow.find('.collapse');

        // Toggle manual del colapso
        $detailsCollapse.collapse('toggle');

        // Cambiar texto del botón
        if ($detailsCollapse.hasClass('show')) {
            $button.text('Ocultar');
        } else {
            $button.text('Ver más');
        }
    });
});
</script>