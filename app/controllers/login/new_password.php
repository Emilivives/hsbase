<?php
include('../../../app/config.php');

// Verificamos el token y su validez
$token = $_GET['token'];
$sql = "SELECT * FROM tb_usuarios WHERE reset_token = :token AND reset_expires > NOW()";
$query = $pdo->prepare($sql);
$query->execute(['token' => $token]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Token Inválido</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; text-align: center; padding: 50px; }
            .message { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block; }
        </style>
    </head>
    <body>
        <div class='message'>
            <h2>Token inválido o expirado</h2>
            <p>Por favor solicita un nuevo enlace de recuperación.</p>
        </div>
    </body>
    </html>";
    exit;
}

// Procesamos la nueva contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $sql_update = "UPDATE tb_usuarios SET password_usr = :password, reset_token = NULL, reset_expires = NULL WHERE id_usuario = :id";
    $query_update = $pdo->prepare($sql_update);
    $query_update->execute(['password' => $new_password, 'id' => $usuario['id_usuario']]);
    
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Contraseña Actualizada</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
            .message-box { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; }
            a { color: #007bff; text-decoration: none; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='message-box'>
            <h2>Contraseña actualizada</h2>
            <p>Tu contraseña ha sido cambiada exitosamente.</p>
            <p><a href='/login.php'>Iniciar sesión</a></p>
        </div>
    </body>
    </html>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Restablecer Contraseña</h2>
        <form method="post">
            <label for="new_password">Nueva Contraseña</label>
            <input type="password" name="new_password" id="new_password" required>
            <button type="submit">Establecer Contraseña</button>
        </form>
    </div>
</body>
</html>
