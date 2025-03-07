<?php

session_start();
include('../../app/config.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login.php');
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página
if ($_SESSION['perfil_usr'] !== 'ADMINISTRADOR' && $_SESSION['perfil_usr'] !== 'USUARIO_PRL') {
    // Si el usuario no es administrador, redirigirlo a su dashboard de usuario
    header('Location: ' . $URL . '/admin/acceso_nopermitido.php');
    exit();
}

include('../../admin/layout/parte1.php');

// Consulta SQL para obtener trabajadores, formaciones y categorías
$sql = " SELECT 
        t.id_trabajador, 
        t.nombre_tr, 
        t.activo_tr,  
        c.nombre_cat,
        em.nombre_emp,
        tf.nombre_tf, 
            f.id_formacion,  -- Añadimos el id_formacion aquí
        MAX(f.fechacad_fr) AS fechacad_fr  -- Usamos MAX() para obtener la fecha de caducidad más reciente
    FROM 
        trabajadores t
    LEFT JOIN 
        categorias c ON t.categoria_tr = c.id_categoria
    LEFT JOIN 
        centros ce ON t.centro_tr = ce.id_centro
    LEFT JOIN 
        empresa em ON ce.empresa_cen = em.id_empresa
    LEFT JOIN 
        form_asistencia fa ON t.id_trabajador = fa.idtrabajador_fas
    LEFT JOIN 
        formacion f ON fa.nroformacion = f.nroformacion
    LEFT JOIN 
        tipoformacion tf ON f.tipo_fr = tf.id_tipoformacion
    GROUP BY 
    t.id_trabajador, tf.nombre_tf, f.id_formacion  -- Añadimos f.id_formacion al GROUP BY
    ORDER BY 
        t.id_trabajador, tf.nombre_tf
";


// Preparar y ejecutar la consulta
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializamos arrays
$trabajadores = [];
$formaciones = [];

// Procesamos los resultados
foreach ($result as $row) {
    $trabajador_id = $row['id_trabajador'];

    // Si es un nuevo trabajador, lo agregamos al array
    if (!isset($trabajadores[$trabajador_id])) {
        $trabajadores[$trabajador_id] = [
            'id_trabajador' => $row['id_trabajador'],
            'nombre_tr' => $row['nombre_tr'],
            'nombre_cat' => $row['nombre_cat'],
            'activo_tr' => $row['activo_tr'],  // Guardamos el valor de activo_tr
            'nombre_emp' => $row['nombre_emp'],  // Guardamos el valor de nombre empresa
            'formaciones' => []
        ];
    }

    // Asignamos la formación (puede estar vacía)
    $formacion = $row['nombre_tf'];
    $fecha_caducidad = $row['fechacad_fr'] ?: 'No formado';

    if ($formacion) {
        $trabajadores[$trabajador_id]['formaciones'][$formacion] = $fecha_caducidad;
    }
}

// Obtener todas las formaciones posibles
$sqlFormaciones = "SELECT nombre_tf FROM tipoformacion";
$stmtFormaciones = $pdo->prepare($sqlFormaciones);
$stmtFormaciones->execute();
$formacionesResult = $stmtFormaciones->fetchAll(PDO::FETCH_ASSOC);

foreach ($formacionesResult as $row) {
    $formaciones[] = $row['nombre_tf'];
}

// Inicializamos el contador de estados C (formaciones caducadas)
$contadorEstadoC = 0;

// Modificamos el procesamiento de resultados para contar los estados C
foreach ($result as $row) {
    $trabajador_id = $row['id_trabajador'];

    // Si es un nuevo trabajador, lo agregamos al array
    if (!isset($trabajadores[$trabajador_id])) {
        $trabajadores[$trabajador_id] = [
            'id_trabajador' => $row['id_trabajador'],
            'nombre_tr' => $row['nombre_tr'],
            'nombre_cat' => $row['nombre_cat'],
            'activo_tr' => $row['activo_tr'],  // Guardamos el valor de activo_tr
            'nombre_emp' => $row['nombre_emp'],  // Guardamos el valor de nombre empresa
            'formaciones' => []
        ];
    }

    // Asignamos la formación (puede estar vacía)
    $formacion = $row['nombre_tf'];
    $fecha_caducidad = $row['fechacad_fr'] ?: 'No formado';

    if ($formacion) {
        // Guardamos también el id_formacion
        $trabajadores[$trabajador_id]['formaciones'][$formacion] = [
            'fecha' => $fecha_caducidad,
            'id_formacion' => $row['id_formacion']  // Guardamos el id_formacion
        ];

        if ($fecha_caducidad != 'No formado' && $fecha_caducidad < date('Y-m-d')) {
            $contadorEstadoC++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores - Formaciones</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <style>
        /* Estilos solo para las celdas de estado */
        td.status {
            width: 30px !important;
            text-align: center !important;
            font-weight: bold !important;
        }

        td.status.estado-N {
            background-color: #ffffff !important;
            /* Rojo */
            color: red !important;
        }

        td.status.estado-V {
            background-color: #008000 !important;
            /* Verde */
            color: white !important;
        }

        td.status.estado-C {
            background-color: #FFA500 !important;
            /* Naranja */
            color: white !important;
        }

        /* Ancho de columnas */
        th:nth-child(1),
        td:nth-child(1) {
            width: 15% !important;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 10% !important;
        }

        /* Estilos para la tabla */
        table {
            width: 100% !important;
        }

        /* Estilos para los botones de DataTables */
        .dt-buttons {
            margin-bottom: 15px !important;
        }

        .dt-button {
            padding: 5px 15px !important;
            margin-right: 5px !important;
        }

        /* Estilos para el contador */
        .estado-counter {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .counter-badge {
            background-color: #FFA500;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            margin-left: 5px;
        }

        /* Estilos para la etiqueta de "Baja" */
        .badge-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 0.85em;
            margin-left: 5px;
        }
    </style>
</head>


<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0"><b>Trabajadores de la empresa</b></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Control trabajadores</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-body">
                <div class="estado-counter">
                    <strong>Total de formaciones caducadas:</strong>
                    <span class="counter-badge"><?php echo $contadorEstadoC; ?></span>
                </div>
                <table id="trabajadoresTable" class="table table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Empresa</th>
                            <?php foreach ($formaciones as $formacion): ?>
                                <th class="status"></th>
                                <th><?php echo $formacion; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trabajadores as $trabajador): ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $trabajador['nombre_tr'];

                                    // Verificamos si está de baja (activo_tr = 0)
                                    if ($trabajador['activo_tr'] == 0): ?>
                                        <span class="badge badge-danger">Baja</span>
                                    <?php endif; ?>
                                    <a href="../trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador['id_trabajador']; ?>" style="text-align: right;" class="btn btn-outline-link btn-sm" title="Ver"><i class="fa-solid fa-up-right-from-square"></i></a>

                                </td>

                                <td><?php echo $trabajador['nombre_cat'] ?: 'Sin categoría'; ?></td>
                                <td><?php echo $trabajador['nombre_emp'] ?: 'Sin empresa'; ?></td>
                                <?php foreach ($formaciones as $formacion): ?>
                                    <?php
                                    $fecha = isset($trabajador['formaciones'][$formacion]) ? $trabajador['formaciones'][$formacion]['fecha'] : 'No formado';
                                    $id_formacion = isset($trabajador['formaciones'][$formacion]) ? $trabajador['formaciones'][$formacion]['id_formacion'] : null;
                                    $estado = '';
                                    $estadoClass = '';

                                    if ($fecha == 'No formado') {
                                        $estado = 'N';
                                        $estadoClass = 'estado-N';
                                    } elseif ($fecha != 'No formado' && $fecha < date('Y-m-d')) {
                                        $estado = 'C';
                                        $estadoClass = 'estado-C';
                                    } elseif ($fecha != 'No formado' && $fecha >= date('Y-m-d')) {
                                        $estado = 'V';
                                        $estadoClass = 'estado-V';
                                    }

                                    // Convertir la fecha a formato día/mes/año si no es "No formado"
                                    if ($fecha != 'No formado') {
                                        $fechaFormateada = date('d/m/Y', strtotime($fecha));
                                        $fecha = "<a href='show.php?id_formacion=$id_formacion' style='text-decoration: none;'>$fechaFormateada</a>";
                                    }
                                    ?>
                                    <td class="status <?php echo $estadoClass; ?>"><?php echo $estado; ?></td>
                                    <td><?php echo $fecha; ?></td>
                                <?php endforeach; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Botones DataTables JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <!-- JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- PDFMake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#trabajadoresTable').DataTable({
                "pageLength": 20,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Acciones PRL",
                    "infoEmpty": "Mostrando 0 a 0 de 0 acciones PRL",
                    "infoFiltered": "(Filtrado de _MAX_ total registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Acciones",
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
                "dom": 'Bfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: 'Reportes',
                        orientation: "landscape",
                        buttons: [{
                                extend: 'copy',
                                text: 'Copiar'
                            },
                            {
                                extend: 'excel',
                                text: 'Excel'
                            },
                            {
                                extend: 'csv',
                                text: 'CSV'
                            },
                            {
                                extend: 'pdf',
                                text: 'PDF'
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir'
                            }
                        ]
                    },
                    {
                        extend: 'colvis',
                        text: 'Visor de columnas'
                    }
                ]
            }).buttons().container().appendTo('#trabajadoresTable_wrapper .col-md-6:eq(0)'); // Esto es clave
        });
    </script>
</body>

</html>