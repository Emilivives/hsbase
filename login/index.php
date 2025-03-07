<?php
include('../app/config.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/templates/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../public/templates/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Estilos Personalizados -->
    <style>
        .login-dark {
            height: 100vh;
            /* Altura de la ventana completa */
            background: #475d62 url(../public/img/fondo.jpg);
            /* Cambia a tu imagen de fondo */
            background-size: cover;
            position: relative;
        }

        .login-dark form {
            max-width: 400px;
            /* Aumenta el ancho máximo del cuadro de login */
            width: 90%;
            background-color: rgba(30, 40, 51, 0.8);
            /* Fondo semi-transparente */
            padding: 60px;
            /* Aumenta el padding para más espacio interno */
            border-radius: 8px;
            /* Aumenta el radio del borde */
            transform: translate(-50%, -50%);
            position: absolute;
            top: 50%;
            left: 50%;
            color: #fff;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
            /* Mejora la sombra para mayor profundidad */
        }

        .login-dark .login-logo {
            text-align: center;
            margin-bottom: 30px;
            /* Aumenta el margen inferior para más espacio entre el logo y el formulario */
        }

        .login-dark .login-logo img {
            max-width: 80%;
            /* Ajusta el tamaño del logo */
            height: auto;
        }

        .login-dark form .form-control {
            background: none;
            border: none;
            border-bottom: 2px solid #434a52;
            /* Aumenta el grosor del borde */
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            padding: 10px 0;
            /* Añade un poco de padding a los inputs */
        }

        .login-dark form .btn-primary {
            background: #214a80;
            border: none;
            border-radius: 4px;
            padding: 12px;
            /* Aumenta el padding para botones más grandes */
            box-shadow: none;
            margin-top: 30px;
            /* Espacio más generoso arriba del botón */
            text-shadow: none;
            outline: none;
        }

        .login-dark form .btn-primary:hover,
        .login-dark form .btn-primary:active {
            background: #214a80;
            outline: none;
        }

        .login-dark form .forgot {
            display: block;
            text-align: center;
            font-size: 14px;
            /* Aumenta el tamaño de fuente del enlace de olvido */
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none;
            margin-top: 15px;
            /* Añade espacio superior al enlace */
        }

        .login-dark form .forgot:hover,
        .login-dark form .forgot:active {
            opacity: 1;
            text-decoration: none;
        }

        .login-dark form .btn-primary:active {
            transform: translateY(1px);
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-dark">
        <form action="<?php echo $URL; ?>/app/controllers/login/controller_login.php" method="post">
            <h2 class="sr-only">Formulario de Inicio de Sesión</h2>
            <div class="login-logo">
                <img src="<?php echo $URL; ?>/public/img/LOGO-eslogan grande2.png" alt="Logo"> <!-- Logo -->
                <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            </div>
            <br><br>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Acceder</button>
            </div>
            <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" class="forgot">¿Olvidaste tu correo o contraseña?</a>

        </form>

    </div>
    <!-- Modal para recuperar contraseña -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="recoverPasswordForm" action="<?php echo $URL; ?>/app/controllers/login/controller_recover_password.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu correo" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Recuperar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../public/templates/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/templates/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/templates/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>