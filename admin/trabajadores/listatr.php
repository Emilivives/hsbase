<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection first
require_once('../../app/config.php');


// Check if it's an AJAX request
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if ($isAjax) {
    // AJAX Request Handler
    header('Content-Type: application/json');

    try {
        // Verify database connection
        if (!isset($pdo)) {
            throw new Exception('Error de conexión a la base de datos');
        }

        if (!isset($_GET['action'])) {
            throw new Exception('No se especificó ninguna acción');
        }

        switch ($_GET['action']) {
            case 'get_worker_details':
                if (!isset($_GET['id'])) {
                    throw new Exception('ID de trabajador no proporcionado');
                }

                $id_trabajador = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                if (!$id_trabajador) {
                    throw new Exception('ID de trabajador inválido');
                }

                // Main worker details
                $sql_details = "SELECT 
                    tr.id_trabajador, 
                    tr.codigo_tr, 
                    tr.dni_tr, 
                    tr.nombre_tr, 
                    tr.fechanac_tr, 
                    tr.sexo_tr, 
                    tr.inicio_tr, 
                    tr.activo_tr, 
                    tr.formacionpdt_tr, 
                    tr.informacion_tr,
                    cat.nombre_cat, 
                    cen.nombre_cen, 
                    emp.nombre_emp, 
                    emp.razonsocial_emp, 
                    emp.direccion_emp, 
                    emp.logo_emp
                FROM trabajadores tr
                INNER JOIN categorias cat ON tr.categoria_tr = cat.id_categoria
                INNER JOIN centros cen ON tr.centro_tr = cen.id_centro
                INNER JOIN empresa emp ON cen.empresa_cen = emp.id_empresa
                WHERE tr.id_trabajador = :id";

                $query_details = $pdo->prepare($sql_details);
                $query_details->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
                $query_details->execute();
                $trabajador_dato = $query_details->fetch(PDO::FETCH_ASSOC);

                if (!$trabajador_dato) {
                    throw new Exception('Trabajador no encontrado');
                }

                // Get accidents
                $sql_accidents = "SELECT 
                    ace.*,
                    ta.tipoaccidente_ta,
                    cen.nombre_cen
                FROM accidentes ace
                INNER JOIN ace_tipoaccidente ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
                INNER JOIN centros cen ON ace.centro_ace = cen.id_centro
                WHERE ace.trabajador_ace = :id
                ORDER BY ace.fecha_ace DESC";

                $query_accidents = $pdo->prepare($sql_accidents);
                $query_accidents->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
                $query_accidents->execute();
                $accidents = $query_accidents->fetchAll(PDO::FETCH_ASSOC);

                // Get training
                $sql_training = "SELECT 
                    fr.*,
                    tf.nombre_tf,
                    tf.duracion_tf,
                    tf.detalles_tf
                FROM formacion fr
                INNER JOIN tipoformacion tf ON fr.tipo_fr = tf.id_tipoformacion
                INNER JOIN form_asistencia fas ON fas.nroformacion = fr.nroformacion
                WHERE fas.idtrabajador_fas = :id
                ORDER BY fr.fecha_fr DESC";

                $query_training = $pdo->prepare($sql_training);
                $query_training->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
                $query_training->execute();
                $training = $query_training->fetchAll(PDO::FETCH_ASSOC);

                // Get medical examinations
                $sql_medical = "SELECT *
                FROM reconocimientos
                WHERE trabajador_rm = :id
                ORDER BY fecha_rm DESC";

                $query_medical = $pdo->prepare($sql_medical);
                $query_medical->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
                $query_medical->execute();
                $medical = $query_medical->fetchAll(PDO::FETCH_ASSOC);

                // Prepare JSON response
                $response = [
                    'worker' => $trabajador_dato,
                    'accidents' => $accidents,
                    'training' => $training,
                    'medical' => $medical
                ];

                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                exit;

            default:
                throw new Exception('Acción no válida');

                // Añadir este case en el switch de las acciones AJAX

            case 'update_worker_details':
                if (!isset($_POST['id'])) {
                    throw new Exception('ID de trabajador no proporcionado');
                }

                $id_trabajador = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

                if (!$id_trabajador) {
                    throw new Exception('ID de trabajador inválido');
                }

                // Validar y sanitizar los datos recibidos
                $datos = [
                    'codigo_tr' => filter_input(INPUT_POST, 'codigo_tr', FILTER_SANITIZE_STRING),
                    'dni_tr' => filter_input(INPUT_POST, 'dni_tr', FILTER_SANITIZE_STRING),
                    'nombre_tr' => filter_input(INPUT_POST, 'nombre_tr', FILTER_SANITIZE_STRING),
                    'fechanac_tr' => filter_input(INPUT_POST, 'fechanac_tr', FILTER_SANITIZE_STRING),
                    'sexo_tr' => filter_input(INPUT_POST, 'sexo_tr', FILTER_SANITIZE_STRING),
                    'categoria_tr' => filter_input(INPUT_POST, 'categoria_tr', FILTER_VALIDATE_INT),
                    'centro_tr' => filter_input(INPUT_POST, 'centro_tr', FILTER_VALIDATE_INT),
                    'activo_tr' => filter_input(INPUT_POST, 'activo_tr', FILTER_VALIDATE_INT)
                ];

                // Construir la consulta SQL
                $sql_update = "UPDATE trabajadores SET 
        codigo_tr = :codigo_tr,
        dni_tr = :dni_tr,
        nombre_tr = :nombre_tr,
        fechanac_tr = :fechanac_tr,
        sexo_tr = :sexo_tr,
        categoria_tr = :categoria_tr,
        centro_tr = :centro_tr,
        activo_tr = :activo_tr
    WHERE id_trabajador = :id";

                $query_update = $pdo->prepare($sql_update);
                $query_update->bindParam(':id', $id_trabajador, PDO::PARAM_INT);

                foreach ($datos as $key => $value) {
                    $query_update->bindValue(":$key", $value);
                }

                if ($query_update->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente']);
                } else {
                    throw new Exception('Error al actualizar los datos');
                }
                exit;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
        exit;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}



// If not AJAX request, show the page
if (!$isAjax) {
    include('../../admin/layout/parte1.php');
    include('../../app/controllers/maestros/centros/listado_centros.php');
    include('../../app/controllers/trabajadores/listado_trabajadores.php');
    include('../../app/controllers/trabajadores/listado_tr_noformado.php');
    include('../../app/controllers/maestros/categorias/listado_categorias.php');
    include('../../app/controllers/maestros/documentos/listado_infoprl.php');

    // Main query for workers list
    try {
        $sql = "SELECT 
            tr.id_trabajador,
            tr.codigo_tr,
            tr.dni_tr,
            tr.nombre_tr,
            tr.activo_tr,
            tr.formacionpdt_tr,
            tr.informacion_tr,
            cat.nombre_cat,
            cen.nombre_cen,
            emp.nombre_emp,
            (SELECT MAX(rm.caducidad_rm) 
             FROM reconocimientos rm 
             WHERE rm.trabajador_rm = tr.id_trabajador 
             AND rm.vigente_rm = 1) as ultimo_reconocimiento
        FROM trabajadores tr
        INNER JOIN categorias cat ON tr.categoria_tr = cat.id_categoria
        INNER JOIN centros cen ON tr.centro_tr = cen.id_centro
        INNER JOIN empresa emp ON cen.empresa_cen = emp.id_empresa
        ORDER BY tr.nombre_tr ASC";

        $query = $pdo->prepare($sql);
        $query->execute();
        $trabajadores = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        $trabajadores = [];
    }
}
?>

<!-- Rest of your HTML code remains the same -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Trabajadores</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
</head>

<body>
    <div class="content-wrapper">
        <br>
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <?php
                        $contador_de_trabajadores = 0;
                        foreach ($trabajadores as $trabajador) {
                            $contador_de_trabajadores = $contador_de_trabajadores + 1;
                        }
                        ?>
                        <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                        <p>Trabajadores registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion bi-people"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-1 col-6">
                <!-- small box -->
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <?php
                        $contador_de_trabajadores = 0;
                        foreach ($trabajadores as $trabajador) {
                            if ($trabajador['activo_tr'] == 1) {
                                $contador_de_trabajadores = $contador_de_trabajadores + 1;
                            }
                        }
                        ?>

                        <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                        <p>Trabajadores activos</p>
                    </div>
                    <div class="icon">
                        <i class="ion bi-person-arms-up"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->


            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <!-- contador trabajadores no formados -->
                <?php
                $contador_tr_no_formados = 0;
                $contador_tr_formados = 0;
                foreach ($trabajadores as $trabajador) {
                    if ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'Si') {
                        $contador_tr_formados = $contador_tr_formados + 1;
                    } elseif ($trabajador['activo_tr'] == 1 and $trabajador['formacionpdt_tr'] == 'No') {
                        $contador_tr_no_formados = $contador_tr_no_formados + 1;
                    }
                }

                ?>
                <!-- fin contador trabajadores no formados -->
                <div class="small-box bg-<?php echo ($contador_tr_no_formados > 0) ? 'warning' : 'light'; ?> shadow-sm border">
                    <div class="inner">


                        <h2><?php echo $contador_tr_no_formados; ?><sup style="font-size: 20px"></h2>
                        <p>Pendientes Formar</p>

                    </div>
                    <div class="icon">
                        <i class="fas fa-book" data-toggle="modal" data-target="#modal-pendientesformar"></i>
                    </div>

                    <!-- inicio modal nuevo trabajador-->
                    <div class="modal fade" id="modal-pendientesformar">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#138fec ;color:black">
                                    <h5 class="modal-title" id="modal-pendientesformar">TRABAJADORES PENDIENTES FORMAR</h5>
                                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="" class="table table-sm">
                                        <colgroup>
                                            <col width="40%">
                                            <col width="20%">
                                            <col width="30%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                            <tr>

                                                <th style="text-align: center">Nombre</th>
                                                <th style="text-align: center">Categoria</th>
                                                <th style="text-align: center">Centro</th>
                                                <th style="text-align: center">Empresa</th>
                                                <th style="text-align: center">-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador = 0;
                                            foreach ($trabajadores_noformados as $trabajador_noformados) {
                                                $contador = $contador + 1;
                                            ?>

                                                <tr>
                                                    <td style="text-align: center"><?php echo $trabajador_noformados['nombre_tr']; ?></td>
                                                    <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cat']; ?></td>
                                                    <td style="text-align: center"><?php echo $trabajador_noformados['nombre_cen']; ?></td>
                                                    <td style="text-align: center"><?php echo $trabajador_noformados['nombre_emp']; ?></td>
                                                    <td style="text-align: center;"> <a href="../../admin/trabajadores/trabajadorshow.php?id_trabajador=<?php echo $trabajador_noformados['id_trabajador']; ?>" class="btn btn-primary btn-sm" title="Ver detalles"></i> Ver</a>


                                                    <?php
                                                }
                                                    ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!--fin modal-->

                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <?php
                        $contador_de_trabajadores = 0;
                        foreach ($trabajadores as $trabajador) {
                            if ($trabajador['activo_tr'] == 1) {
                                $contador_de_trabajadores = $contador_de_trabajadores + 1;
                            }
                        }
                        ?>

                        <h2><?php echo $contador_de_trabajadores; ?><sup style="font-size: 20px"></h2>
                        <p>Trabajadores activos</p>
                    </div>
                    <div class="icon">
                        <i class="ion bi-person-arms-up"></i>
                    </div>

                </div>
            </div>
            <div class="col-lg-1 col-6">



            </div>
            <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>

                <div class="col-lg-1 col-6">
                    <div class="btn-text-center">
                        <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#modal-nuevotrabajador" title="Añadir nuevo trabajador"><i class="bi bi-person-plus-fill"></i>AÑADIR NUEVO TRABAJADOR</button>

                    </div>
                    <div class="row">

                        <div class="btn-text-center">

                        </div>

                    </div>




                    <!-- inicio modal nuevo trabajador-->
                    <div class="modal fade" id="modal-nuevotrabajador">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#ffd900 ;color:black">
                                    <h5 class="modal-title" id="modal-nuevotrabajador">Nuevo Trabajador</h5>
                                    <button type="button" class="close" style="color: black;" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="../../app/controllers/trabajadores/create.php" method="post" enctype="multipart/form-data">


                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Codigo</label>
                                                    <input type="text" name="codigo_tr" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">DNI/NIE</label>
                                                    <input type="text" name="dni_tr" class="form-control" required>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">APELLIDOS, NOMBRE</label>
                                                    <input type="text" name="nombre_tr" class="form-control" required>
                                                </div>

                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault1" value="Hombre" checked>
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        <b>Hombre</b>
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo_tr" id="flexRadioDefault2" value="Mujer">
                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        <b>Mujer</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Fecha Nacimiento</label>
                                                    <input type="date" name="fechanac_tr" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Fecha Inicio</label>
                                                    <input type="date" name="inicio_tr" class="form-control" required>
                                                </div>

                                            </div>
                                            <!--
                                <div class="col-md-2">
                                    <label for="">Sexo</label>
                                    <select class="form-select form-select-sm" name="sexo_tr" aria-label=".form-select-sm example">
                                        <option>Seleccione</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>

                                </div>-->
                                            <div class="col-md-1">
                                            </div>



                                            <div class="col-md-3">
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault3" value="No" checked>
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        <b>NO FORMADO PRL</b>
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="formacionpdt_tr" id="flexRadioDefault4" value="Si">
                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        <b>FORMADO PRL</b>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault3" value="No" checked>
                                                    <label class="form-check-label" for="flexRadioDefault5">
                                                        <b>NO INFORMADO PRL</b>
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="informacion_tr" id="flexRadioDefault4" value="Si">
                                                    <label class="form-check-label" for="flexRadioDefault6">
                                                        <b>INFORMADO PRL</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Centro Trabajo</label>
                                                    <select name="centro_tr" id="" class="form-control">
                                                        <option value="0">--Seleccione centro--</option>
                                                        <?php
                                                        foreach ($centros_datos as $centros_dato) { ?>
                                                            <option value="<?php echo $centros_dato['id_centro']; ?>"><?php echo $centros_dato['nombre_cen']; ?> - <?php echo $centros_dato['nombre_emp']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Categoria</label>
                                                    <select name="categoria_tr" id="" class="form-control">
                                                        <option value="0">--Seleccione categoria--</option>
                                                        <?php
                                                        foreach ($categorias_datos as $categorias_dato) { ?>
                                                            <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_cat']; ?> </option>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">ANOTACIONES</label>
                                                    <input type="text" name="anotaciones_tr" class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--fin modal-->

                </div>
            <?php endif ?>

        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="workers-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Código</th>
                                            <th>DNI</th>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Centro</th>
                                            <th>Categoría</th>
                                            <th>Estado</th>
                                            <th>Formación</th>
                                            <th>Información</th>
                                            <th>Rec. Médico</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" placeholder="Filtrar codigo" /></th>
                                            <th>
                                                <input type="text" placeholder="Filtrar dni" />
                                            </th>
                                            </th>
                                            <th>
                                                <input type="text" placeholder="Filtrar nombre" />
                                            </th>
                                            </th>
                                            <th><input type="text" placeholder="Filtrar empresa" /></th>
                                            <th><input type="text" placeholder="Filtrar Centro" /></th>
                                            <th><input type="text" placeholder="Filtrar categoria" /></th>
                                            <th>
                                                <select>
                                                    <option value="">Todos</option>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select>
                                                    <option value="">Todos</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select>
                                                    <option value="">Todos</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </th>

                                            <th colspan="2" align="center">
                                                <button id="clearFilters" style="
            background-color:rgb(139, 137, 138); 
            color: white; 
            padding: 5px 10px; 
            border: none; 
            border-radius: 4px;
            cursor: pointer;
            margin-top: 2px;
        ">
                                                    Limpiar Filtros
                                                </button>
                                            </th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($trabajadores as $index => $trabajador): ?>
                                            <tr data-worker-id="<?= $trabajador['id_trabajador'] ?>">
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($trabajador['codigo_tr']) ?></td>
                                                <td><?= htmlspecialchars($trabajador['dni_tr']) ?></td>
                                                <td><?= htmlspecialchars($trabajador['nombre_tr']) ?></td>
                                                <td><?= htmlspecialchars($trabajador['nombre_emp']) ?></td>
                                                <td><?= htmlspecialchars($trabajador['nombre_cen']) ?></td>
                                                <td><?= htmlspecialchars($trabajador['nombre_cat']) ?></td>
                                                <td>
                                                    <?= $trabajador['activo_tr'] == 1 ?
                                                        '<span class="badge badge-success">Activo</span>' :
                                                        '<span class="badge badge-danger">Inactivo</span>' ?>
                                                </td>
                                                <td>
                                                    <?= $trabajador['formacionpdt_tr'] == 1 ?
                                                        '<span class="badge badge-success">Sí</span>' :
                                                        '<span class="badge badge-warning">No</span>' ?>
                                                </td>
                                                <td>
                                                    <?= $trabajador['informacion_tr'] == 1 ?
                                                        '<span class="badge badge-success">Sí</span>' :
                                                        '<span class="badge badge-warning">No</span>' ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $reconocimiento = $trabajador['ultimo_reconocimiento'];
                                                    if ($reconocimiento) {
                                                        $fecha_cad = new DateTime($reconocimiento);
                                                        $hoy = new DateTime();

                                                        if ($fecha_cad > $hoy) {
                                                            echo '<span class="badge badge-success">' . $fecha_cad->format('d/m/Y') . '</span>';
                                                        } else {
                                                            echo '<span class="badge badge-danger">Caducado</span>';
                                                        }
                                                    } else {
                                                        echo '<span class="badge badge-warning">Sin datos</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info btn-view-worker">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="worker-details-container" class="card" style="display:none;">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title">Detalles del Trabajador</h3>
                            </div>
                            <div class="card-body" id="worker-details-content">
                                <!-- Worker details will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Añadir este HTML después del div worker-details-container -->


    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            // Initialize DataTable
            $('#workers-table').DataTable({
                initComplete: function() {
                    var table = this.api();

                    // Aplicar búsqueda por columna
                    table.columns().every(function(index) {
                        var column = this;
                        var input = $('tfoot th:eq(' + index + ') input, tfoot th:eq(' + index + ') select');

                        // No configuramos el filtro para la columna de acciones
                        if (index === 10) return;

                        input.on('keyup change', function() {
                            column.search($(this).val()).draw();
                        });
                    });



                    // Evento para limpiar filtros
                    $('#clearFilters').on('click', function() {
                        $('#workers-table tfoot input, #workers-table tfoot select').val('');
                        table.columns().search('').draw(); // Resetea los filtros en DataTable
                    });

                    // Estilos para los filtros
                    $('#workers-table tfoot th').css('padding', '10px 5px');

                    $('#workers-table tfoot input, #workers-table tfoot select').css({
                        'width': '100%',
                        'font-size': '12px',
                        'border': '4px solid #ddd',
                        'border-radius': '4px',
                        'padding': '5px'
                    });
                },
                responsive: true,
                language: {
                    url: '../../assets/json/dataTables.spanish.json'
                }
            });



            // Worker details loading

            $('.btn-view-worker').on('click', function() {
                const workerId = $(this).closest('tr').data('worker-id');
                const detailsContainer = $('#worker-details-container');
                const detailsContent = $('#worker-details-content');

                // Oculta cualquier detalle abierto antes de abrir uno nuevo
                if (detailsContainer.is(':visible')) {
                    detailsContainer.slideUp(300);
                }

                // Agrega el spinner de carga mientras se obtiene la información
                detailsContent.html(`
            <div class="text-center p-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
                <p class="mt-2">Cargando datos del trabajador...</p>
            </div>
        `);

                console.log('Requesting worker details for ID:', workerId);

                $.ajax({
                    url: window.location.href,
                    method: 'GET',
                    data: {
                        action: 'get_worker_details',
                        id: workerId
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        console.log('Response received:', response);

                        if (!response || !response.worker) {
                            throw new Error('Respuesta inválida del servidor');
                        }

                        const worker = response.worker;
                        const medical = response.medical || [];
                        const training = response.training || [];

                        const formatDate = (dateString) => dateString ? new Date(dateString).toLocaleDateString('es-ES') : 'N/A';

                        let detailsHtml = `
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Información del Trabajador</h5>
                        <button class="btn btn-sm btn-danger btn-close-details">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td><strong>Nombre:</strong> ${worker.nombre_tr || 'N/A'}</td>
                                <td><strong>DNI:</strong> ${worker.dni_tr || 'N/A'}</td>
                                <td><strong>Empresa:</strong> ${worker.nombre_emp || 'N/A'}</td>
                            </tr>
                            <tr>
                                <td><strong>Centro:</strong> ${worker.nombre_cen || 'N/A'}</td>
                                <td><strong>Categoría:</strong> ${worker.nombre_cat || 'N/A'}</td>
                                <td><strong>Estado:</strong> ${worker.activo_tr == 1 ? 'Activo' : 'Inactivo'}</td>
                            </tr>
                        </table>

                        <div class="accordion mt-3" id="workerDetailsAccordion">
                            <!-- Sección de Reconocimientos Médicos -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingMedical">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMedical">
                                        Reconocimientos Médicos
                                    </button>
                                </h2>
                                <div id="collapseMedical" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Caducidad</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${medical.length ? medical.map(med => `
                                                    <tr>
                                                        <td>${formatDate(med.fecha_rm)}</td>
                                                        <td>${formatDate(med.caducidad_rm)}</td>
                                                        <td>
                                                            ${med.vigente_rm == 1 ? 
                                                                '<span class="badge bg-success">Vigente</span>' : 
                                                                '<span class="badge bg-danger">Caducado</span>'}
                                                        </td>
                                                    </tr>
                                                `).join('') : '<tr><td colspan="3" class="text-center">No hay datos</td></tr>'}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Formaciones -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTraining">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTraining">
                                        Formaciones
                                    </button>
                                </h2>
                                <div id="collapseTraining" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Duración</th>
                                                    <th>Caducidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${training.length ? training.map(train => `
                                                    <tr>
                                                        <td>${formatDate(train.fecha_fr)}</td>
                                                        <td>${train.nombre_tf || 'N/A'}</td>
                                                        <td>${train.duracion_tf || 'N/A'} h</td>
                                                        <td>${formatDate(train.fechacad_fr)}</td>
                                                    </tr>
                                                `).join('') : '<tr><td colspan="4" class="text-center">No hay formaciones registradas</td></tr>'}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                `;

                        detailsContent.html(detailsHtml);
                        detailsContainer.slideDown(300);

                        // Botón para cerrar detalles
                        $('.btn-close-details').on('click', function() {
                            detailsContainer.slideUp(300);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error('Error details:', {
                            status,
                            error,
                            responseText: xhr.responseText
                        });

                        let errorMessage = 'Error al cargar los detalles del trabajador.';

                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response && response.error) {
                                errorMessage += ' ' + response.error;
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            errorMessage += ' Error de comunicación con el servidor.';
                        }

                        detailsContent.html(`
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Error</h5>
                        <p>${errorMessage}</p>
                        <hr>
                        <p class="mb-0">Por favor, intente nuevamente o contacte al administrador.</p>
                    </div>
                `);
                    }
                });
            });
        });
    </script>
    <?php include('../../admin/layout/parte2.php'); ?>
    <div class="modal fade" id="editWorkerModal" tabindex="-1" role="dialog" aria-labelledby="editWorkerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editWorkerModalLabel">Editar Datos del Trabajador</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editWorkerForm">
                        <input type="hidden" id="edit_id_trabajador" name="id_trabajador">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_codigo_tr">Código</label>
                                    <input type="text" class="form-control" id="edit_codigo_tr" name="codigo_tr" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_dni_tr">DNI</label>
                                    <input type="text" class="form-control" id="edit_dni_tr" name="dni_tr" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_nombre_tr">Nombre</label>
                                    <input type="text" class="form-control" id="edit_nombre_tr" name="nombre_tr" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_fechanac_tr">Fecha Nacimiento</label>
                                    <input type="date" class="form-control" id="edit_fechanac_tr" name="fechanac_tr">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_sexo_tr">Sexo</label>
                                    <select class="form-control" id="edit_sexo_tr" name="sexo_tr">
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_categoria_tr">Categoría</label>
                                    <select class="form-control" id="edit_categoria_tr" name="categoria_tr" required>
                                        <!-- Se llenará dinámicamente -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_centro_tr">Centro</label>
                                    <select class="form-control" id="edit_centro_tr" name="centro_tr" required>
                                        <!-- Se llenará dinámicamente -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_activo_tr">Estado</label>
                                    <select class="form-control" id="edit_activo_tr" name="activo_tr">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveWorkerChanges">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>