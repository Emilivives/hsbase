<?php
include ('../../config.php');
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$remember = isset($_POST['remember']); // Verificamos si el usuario marcó "Recordar"

// Hacemos un JOIN entre `tb_usuarios` y `tb_perfil`
$sql = "SELECT u.*, p.nombre_pf 
        FROM `tb_usuarios` u 
        INNER JOIN `tb_perfiles` p ON u.id_perfil = p.id_perfil 
        WHERE u.email_usr = :email";

$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

// Verificamos la contraseña
if ($usuario && password_verify($password, $usuario['password_usr'])) {
    // Guardamos la información en la sesión
    $_SESSION['sesion_email'] = $email;
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre_usr'] = $usuario['nombre_usr'];
    $_SESSION['perfil_usr'] = $usuario['nombre_pf'];  // Guardamos el nombre del perfil en la sesión
    
    // Si el usuario seleccionó "Recordar", creamos cookies para email y password
    if ($remember) {
        setcookie('email', $email, time() + (86400 * 30), "/"); // 30 días
        setcookie('password', $password, time() + (86400 * 30), "/"); // 30 días
    } else {
        // Si no seleccionó "Recordar", eliminamos las cookies si existen
        if (isset($_COOKIE['email'])) {
            setcookie('email', '', time() - 3600, "/");
        }
        if (isset($_COOKIE['password'])) {
            setcookie('password', '', time() - 3600, "/");
        }
    }
    
    // Redirigimos según el perfil
    if ($usuario['nombre_pf'] === 'ADMINISTRADOR') {
        header('Location: ' . $URL . '/admin/index.php');
    } else {
        header('Location: ' . $URL . '/admin/index.php');
    }
    exit();
} else {
    // Si las credenciales no son válidas
    $_SESSION['error_login'] = "Credenciales incorrectas";
    header('Location: ' . $URL . '/login.php');
    exit();
}
?>
