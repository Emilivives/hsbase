<?php
include('../../../app/config.php');

// Verificamos el token y su validez
$token = $_GET['token'];
$sql = "SELECT * FROM tb_usuarios WHERE reset_token = :token AND reset_expires > NOW()";
$query = $pdo->prepare($sql);
$query->execute(['token' => $token]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "El token es inválido o ha expirado.";
    exit;
}

// Procesamos la nueva contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $sql_update = "UPDATE tb_usuarios SET password_usr = :password, reset_token = NULL, reset_expires = NULL WHERE id_usuario = :id";
    $query_update = $pdo->prepare($sql_update);
    $query_update->execute(['password' => $new_password, 'id' => $usuario['id_usuario']]);
    echo "Tu contraseña ha sido actualizada. Ahora puedes iniciar sesión.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <form method="post">
        <label for="new_password">Nueva Contraseña</label>
        <input type="password" name="new_password" id="new_password" required>
        <button type="submit">Establecer Contraseña</button>
    </form>
</body>
</html>
