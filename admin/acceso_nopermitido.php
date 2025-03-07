<?php
// Iniciar la sesión
session_start();
include('../app/config.php');
include('../admin/layout/parte1.php');  // Incluir el frame lateral

// Verificar si el usuario tiene permiso (por ejemplo, si es administrador)
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

if (!$isAdmin) {
    // Si no es administrador, mostrar el mensaje de permiso denegado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .denied-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .denied-box {
            text-align: center;
            border: 2px solid #dc3545;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .alert {
            margin: 20px 0;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<!-- Agregar el contenedor para el menú lateral -->
<div class="wrapper">


    <!-- Página principal -->
    <div class="content-wrapper">
        <!-- Mensaje de acceso denegado -->
        <div class="denied-container">
            <div class="denied-box">
                <h1 class="alert alert-danger">Lo siento, no tiene permiso para acceder a esta página.</h1>
                <img src="../public/img/accesodenegado.jpg" alt="Acceso Denegado">
                <p>Si crees que esto es un error, contacta a tu administrador.</p>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    include('../../admin/layout/parte2.php');  // Incluir la parte final del layout
    exit; // Terminar el script para evitar que el resto de la página se ejecute
}

// Si el usuario tiene permiso, el resto de la página se cargaría aquí
?>
