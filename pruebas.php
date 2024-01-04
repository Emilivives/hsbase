<?php


echo $password = '123456789';


echo md5($password). "<br>";

echo sha1($password)."<br>";

echo password_hash($password, PASSWORD_DEFAULT);


$hash = '$2y$10$CLQczWkjrIy7XfQc1mIM9uvXTklgx6xGn2DYuElm1Tm3czTE8T6vm';

if (password_verify($password, $hash)) {
    echo 'Password correcto!';
} else {
    echo 'password incorrecto.';
}
?>