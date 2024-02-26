<?php
include('../app/config.php');

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME ?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/templates/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../public/templates/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/templates/AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo $URL;?>/public/templates/AdminLTE/index2.html"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            
            <div class="card-body login-card-body">
            <center>
            <img src="<?php echo $URL;?>/public/img/LOGO-eslogan grande.jpg"  width="100%" alt="">
            </center>
            <br>
                <p class="login-box-msg">Ingresa tus datos</p>
                <label for="">Correo eléctronico</label><br>
                <form action="<?php echo $URL;?>/app/controllers/login/controller_login.php" method="post">
                    <div class="input-group mb-3">
                        
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    <label for="">Contraseña</label><br>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary" style="width: 100% ;">Acceder</button>
                    <br><br>
                    <button class="btn btn-secondary" href="<?php echo $URL;?>hsbase/index.html" style="width: 100%">Cancelar</button>
                </form>

                

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../public/templates/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/templates/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/templates/AdminLTE/dist/js/adminlte.min.js"></script>
</body>


</html>