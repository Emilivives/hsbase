<?php

session_start();
if (isset($_SESSION['sesion_email'])) {
    // echo "Accesso con login";
} else {
    //echo "Acceso sin login";
    header('location:' . $URL . '/login');
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME; ?></title>

    <link REL="SHORTCUT ICON" HREF="../public/img/favicon.ico">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/dist/css/adminlte.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <!-- libreria iconos fontawesome -->
    <script src="https://kit.fontawesome.com/f1e1a05e58.js" crossorigin="anonymous"></script>


    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- libreria de mensajes sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Iconos bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- javascrip bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/js/bootstrap.bundle.min.js">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/bootstrap.min.css">
   <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $URL; ?>/admin" class="nav-link"><?php echo APP_NAME ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
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
            <a href="<?php echo $URL; ?>/public/templates/AdminLTE/index3.html" class="brand-link">
                <img src="<?php echo $URL; ?>/public/img/icono-2.png" alt="HS Base Logo" class="brand-image" style="opacity: .9">
                <span class="brand-text font-weight-light"><?php echo APP_NAME; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <a href="" class="d-block">Emili Vives</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                        </br>
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-warning">Info</span>
                                </p>
                            </a>
                        </li>
                        </br>
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/trabajadores" class="nav-link">
                                <i class="nav-icon fas fa-people-arrows"></i>
                                <p>
                                    Trabajadores

                                </p>
                            </a>

                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Formaciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/formacion" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ver formaciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/formacion/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registrar de formación</p>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/formacion/tipoformaciones.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tipos de formación</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/reconocimientos" class="nav-link">
                                <i class="nav-icon fa-solid fa-notes-medical"></i>
                                <p>
                                    Vigilancia salud
                             
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/accidentes" class="nav-link">
                                <i class="nav-icon fa bi bi-cone-striped"></i>
                                <p>
                                    Accidentes
            
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/accionprl" class="nav-link">
                                <i class="nav-icon fa bi bi-exclamation-triangle-fill"></i>
                                <p>
                                    Acción PRL
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon 	fas fa-exclamation-circle"></i>
                                <p>
                                    Tablas maestras
                                    <i class="right fas fa-angle-left"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/maestros/categorias" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categorias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/maestros/centros" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>centros/empresas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/maestros/accidentes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>cod. accidentes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/maestros/varios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>varios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas bi bi-calendar3"></i>
                                <p>
                                    Actividad
                                    <i class="right fas fas fa-angle-left"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/actividad/proyectos.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Proyectos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/actividad/tareas.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tareas</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <br>
                        <br>

                        <li class="nav-item">
                            <a href="#" class="nav-link">

                                <i class="nav-icon fas bi-people"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                                <!--  PONEMOS MODALES PARA EVITAR MAS MENU
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/usuarios/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo usuario</p>
                                    </a> -->
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/admin/perfiles" class="nav-link">
                                <i class="far bi-person-workspace nav-icon"></i>
                                <p> Perfiles</p>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <!--  PONEMOS MODALES PARA EVITAR MAS MENU
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fas bi bi-person-workspace"></i>
                                <p>
                                    Perfiles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/perfiles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de perfiles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/admin/perfiles/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo perfil</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        -->
                    <br>
                    <br>
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
                                <a href="<?php echo $URL; ?>/admin/pruebas" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prueba accion prl</p>
                                </a>
                            </li>

                        </ul>
                       
                    </li>
                    </br>
                    </br>
                    </br>
                    <li class="nav-item">
                        <a href="<?php echo $URL; ?>/app/controllers/login/cerrar_sesion.php" style="background-color:crimson" class="nav-link">
                            <i class="nav-icon fa fa-door-open"></i>
                            <p>Cerrar sesión</p>
                        </a>
                    </li>
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