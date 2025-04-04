<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Tiempo máximo de inactividad en segundos (ejemplo: 10 minutos)
$tiempo_maximo_inactividad = 900; // 600 segundos = 10 minutos

// Comprobar si el tiempo de la última actividad está definido
if (isset($_SESSION['ultimo_acceso'])) {
    // Calcular el tiempo de inactividad
    $inactividad = time() - $_SESSION['ultimo_acceso'];

    // Si el tiempo de inactividad supera el límite, destruir la sesión
    if ($inactividad > $tiempo_maximo_inactividad) {
        // Destruir la sesión y redirigir al login
        session_unset();
        session_destroy();
        header('Location: ' . $URL . '/login/index.php'); // Redirigir indicando que la sesión ha expirado
        exit();
    }
}

// Actualizar el tiempo del último acceso a la página
$_SESSION['ultimo_acceso'] = time();
if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . $URL . '/login/index.php');
    exit();
}

// Parte 1: Definición de funciones para el menú
function isActive($current_page)
{
    // Comprobar si la página actual coincide con la ruta proporcionada
    return ($_SERVER['REQUEST_URI'] === $current_page) ? 'active' : '';
}

function isTreeviewOpen($pages)
{
    // Comprobar si la ruta actual está dentro de las páginas proporcionadas
    foreach ($pages as $page) {
        if (strpos($_SERVER['REQUEST_URI'], $page) !== false) {
            return 'menu-open';
        }
    }
    return '';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME; ?></title>

    <link REL="SHORTCUT ICON" HREF="../public/img/favicon.ico">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a4de9c6be5.js" crossorigin="anonymous"></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/dist/css/adminlte.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <!-- libreria iconos fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- libreria de mensajes sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- Iconos bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- javascript bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/js/bootstrap.bundle.min.js">
    <script src="<?php echo $URL; ?>/public/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- css bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/bootstrap.min.css">
    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- echarts -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/js/echarts.min.js">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    <!-- select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <style>
        /* Estilos para el menú lateral */
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 4.5rem);
            padding-bottom: 1rem;
        }

        /* Ajustar el contenedor para permitir que el botón suba */
        .sidebar-bottom {
            margin-top: 10rem;
            /* Cambiado de "auto" a un valor fijo */
            width: 100%;
        }

        /* Estilos para el botón de logout */
        .nav-sidebar .logout-item {
            margin-top: 1rem;
            /* Cambiar a un valor fijo en lugar de "auto" */
        }

        .nav-sidebar .logout-link {
            color: white !important;
            background-color: crimson !important;
            padding: 0.5rem 1rem;
        }

        /* Estilo cuando el menú está contraído */
        .sidebar-mini.sidebar-collapse .logout-link {
            margin-left: 0;
            padding: 12px;
        }

        .sidebar-mini.sidebar-collapse .logout-link i {
            margin: 0;
            background-color: crimson;
        }

        /* Ajusta el ícono cuando el menú está contraído */
        .sidebar-mini.sidebar-collapse .nav-sidebar .logout-item .nav-link>i {
            margin: 0;
            width: 20px;
        }

        hr {
            border-color: white;
        }
        .brand-image {
    width: 120px; /* Ajusta el tamaño como desees */
    opacity: 0.9;
}
    </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $URL; ?>/admin/index.php" class="nav-link">
                        <?php echo $_SESSION['nombre_usr']; ?>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span class="badge badge-warning navbar-badge" title="Avisos">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#001d24;">
            <!-- Brand Logo -->
            <a href="<?php echo $URL; ?>/admin/index.php" class="brand-link">
                <img src="<?php echo $URL; ?>/public/img/logonew2.png" alt="HS Base Logo" class="brand-image" style="opacity: .9">
                <span class="brand-text font-weight-light"><?php echo APP_NAME; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <br>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/index.php" class="nav-link <?php echo isActive('/admin/index.php'); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-warning">Info</span>
                                </p>
                            </a>
                        </li>

                        <br>

                        <!-- Sección Administrador -->
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL'): ?>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/admin/actividad/proyectos.php" class="nav-link <?php echo isActive('/admin/actividad/proyectos.php'); ?>">
                                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                                    <p>Actividad</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/admin/actividad/diario.php" class="nav-link <?php echo isActive('/admin/actividad/diario.php'); ?>">
                                    <i class="nav-icon fas bi bi-calendar-date"></i>
                                    <p>Diario</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <hr>

                        <!-- Trabajadores -->
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL'): ?>

                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/trabajadores/trabajadorshow.php?id_trabajador=1" class="nav-link <?php echo isActive('/admin/trabajadores/trabajadorshow.php?id_trabajador='); ?>">
                                <i class="nav-icon fas fa-people-arrows"></i>
                                <p>Trabajadores</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL'): ?>

                            <!-- Formaciones -->
                            <li class="nav-item <?php echo isTreeviewOpen(['/admin/formacion/create.php', '/admin/formacion/control.php', '/admin/formacion/index.php', '/admin/formacion/tipoformaciones.php']); ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        Formaciones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/formacion/create.php" class="nav-link <?php echo isActive('/admin/formacion/create.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar formación</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/formacion/control.php" class="nav-link <?php echo isActive('/admin/formacion/control.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Control formaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/formacion/index.php" class="nav-link <?php echo isActive('/admin/formacion/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ver formaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/formacion/tipoformaciones.php" class="nav-link <?php echo isActive('/admin/formacion/tipoformaciones.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tipos de formación</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Vigilancia salud -->
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/admin/reconocimientos/index.php" class="nav-link <?php echo isActive('/admin/reconocimientos/index.php'); ?>">
                                    <i class="nav-icon fa-solid fa-heart-pulse"></i>
                                    <p>Vigilancia salud</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH'): ?>
                            <!-- Accidentes -->
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/admin/accidentes/index.php" class="nav-link <?php echo isActive('/admin/accidentes/index.php'); ?>">
                                    <i class="nav-icon fa-solid fa-person-falling-burst"></i>
                                    <p>Accidentes</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <!-- Sección PRL-->
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_PRL'): ?>

                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/admin/accionprl/index.php" class="nav-link <?php echo isActive('/admin/accionprl/index.php'); ?>">
                                    <i class="nav-icon fa bi bi-exclamation-triangle-fill"></i>
                                    <p>
                                        Acción PRL
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <li class="nav-item <?php echo isTreeviewOpen(['/admin/evaluacion/index.php', '/admin/evaluacion/index_equipos.php', '/admin/evaluacion/control.php']); ?>">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa-solid fa-check-to-slot"></i>
                                    <p>
                                        Evaluaciones
                                        <i class="right fas fa-angle-left"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/evaluacion/index.php" class="nav-link <?php echo isActive('/admin/evaluacion/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Puestos Tº</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/evaluacion/index_equipos.php" class="nav-link <?php echo isActive('/admin/evaluacion/index_equipos.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Equipos Tº</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/evaluacion/control.php" class="nav-link <?php echo isActive('/admin/evaluacion/control.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Control</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item <?php echo isTreeviewOpen(['/admin/inventario/controlmaquinas.php']); ?>">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-tools"></i>
                                    <p>
                                        Inventario
                                        <i class="right fas fa-angle-left"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/inventario/controlmaquinas.php" class="nav-link <?php echo isActive('/admin/inventario/controlmaquinas.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Equipos Tº</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/inventario/controlepis.php" class="nav-link <?php echo isActive('/admin/inventario/controlepis.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>EPIs</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/inventario/revisionoficial.php" class="nav-link <?php echo isActive('/admin/inventario/revisionoficial.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Revis. oficial</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        <?php endif ?>

                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR'): ?>
                            <li class="nav-item">
                            <li class="nav-item <?php echo isTreeviewOpen(['/admin/maestros/categorias/index.php', '/admin/maestros/centros/index.php', '/admin/maestros/accidentes/index.php', '/admin/maestros/documentos/index.php', '/admin/maestros/evaluacion/index.php', '/admin/maestros/varios/index.php']); ?>">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon 	fas fa-solid fa-gear"></i>
                                    <p>
                                        Tablas maestras
                                        <i class="right fas fa-angle-left"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/categorias/index.php" class="nav-link <?php echo isActive('/admin/maestros/categorias/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/centros/index.php" class="nav-link <?php echo isActive('/admin/maestros/centros/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>centros/empresas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/accidentes/index.php" class="nav-link <?php echo isActive('/admin/maestros/accidentes/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>cod. accidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/documentos/index.php" class="nav-link <?php echo isActive('/admin/maestros/documentos/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Documentos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/epis_equipos_pq/index.php" class="nav-link <?php echo isActive('/admin/maestros/epis_equipos_pq/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Epis/Equipos/PQ</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/evaluacion/index.php" class="nav-link <?php echo isActive('/admin/maestros/evaluacion/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Evaluacion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/maestros/varios/index.php" class="nav-link <?php echo isActive('/admin/maestros/varios/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>varios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class=" nav-icon fas bi bi-person-workspace"></i>
                                    <p>
                                        Pruebas
                                        <i class="right fas fa-angle-left"></i>
                                        <span class="right badge badge-success">Demo</span>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/pruebas/index.php" class="nav-link <?php echo isActive('/admin/pruebas/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>CONTROL EVALUACIONES</p>
                                        </a>
                                    </li>

                                </ul>


                            </li>
                        <?php endif; ?>

                        <!-- Opciones solo para ADMINISTRADOR -->
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR'): ?>

                            <li class="nav-item <?php echo isTreeviewOpen(['/admin/usuarios/index.php', '/admin/perfiles/index.php']); ?>">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas bi-people"></i>
                                    <p>
                                        Usuarios
                                        <i class="right fas fa-angle-left"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/usuarios/index.php" class="nav-link <?php echo isActive('/admin/usuarios/index.php'); ?>">

                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/admin/perfiles/index.php" class="nav-link <?php echo isActive('/admin/perfiles/index.php'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Perfiles</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['perfil_usr'] === 'ADMINISTRADOR' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH' || $_SESSION['perfil_usr'] === 'USUARIO_RRHH_BASICO'): ?>
                        <!-- Vacaciones -->
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/vacaciones/index.php" class="nav-link <?php echo isActive('/admin/vacaciones/index.php'); ?>">
                                <i class="nav-icon fas bi bi-clock-history"></i>
                                <p>Vacaciones</p>
                            </a>
                        </li>
                        <?php endif; ?>



                        <!-- Divider -->
                        <li class="nav-header"></li>
                        <!-- Opciones "Usuarios" y "Cerrar Sesión" -->
                        <div class="sidebar-bottom">


                            <li class="nav-item logout-item">
                                <a href="<?php echo $URL; ?>/app/controllers/login/cerrar_sesion.php"
                                    class="nav-link logout-link">
                                    <i class="nav-icon fa fa-door-open"></i>
                                    <p>
                                        Cerrar sesión
                                    </p>
                                </a>
                            </li>
                            <!-- Botón Cerrar Sesión -->
                        </div>


                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <div class="content">

                <script>
                    // Tiempo máximo de inactividad en milisegundos (ejemplo: 10 minutos)
                    const tiempoMaxInactividad = 600000; // 10 minutos en milisegundos

                    // Función para redirigir al usuario al login después de inactividad
                    function cerrarSesion() {
                        alert('Has estado inactivo por demasiado tiempo. Serás redirigido al login.');
                        window.location.href = '<?php echo $URL; ?>/login/index.php';
                    }

                    // Temporizador de inactividad
                    let temporizadorInactividad;

                    // Función que reinicia el temporizador
                    function resetearTemporizador() {
                        clearTimeout(temporizadorInactividad);
                        temporizadorInactividad = setTimeout(cerrarSesion, tiempoMaxInactividad);
                    }

                    // Escuchar eventos del usuario (movimiento del ratón, teclas, scroll, etc.)
                    window.onload = resetearTemporizador;
                    window.onmousemove = resetearTemporizador;
                    window.onkeypress = resetearTemporizador;
                    window.onscroll = resetearTemporizador;
                </script>