<?php
session_start();
require_once __DIR__ .'/../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];
$roles_fk = $_POST['roles_fk'];

$errores = [];
if (empty($email)) {
    $errores['email'] = 'Tu usuario debe poseer un email';
}
foreach ((new Usuario)->todo() as $UsuarioExistente){
    if ($email == $UsuarioExistente->getEmail()) {
        $errores['email'] = 'Este email ya esta registrado';
    }
}

if (empty($password)) {
    $errores['password'] = 'Tu usuario debe poseer una contraseña';
}
if (empty($roles_fk)) {
    $errores['roles_fk'] = 'Debes asignarle un rol a tu usuario';
}
if ($roles_fk != 2 && $roles_fk != 3) {
    /*
    Realize el: value="<?=$rol->getId() - 1?>" y esta modificacion de la validacion porque pensaba
    que el iniciar con un value = 2, me generaba un error de validacion.
    el valor 1 pasa  a ser 2 antes de crear el usuario y el valor 2 pasa a ser 3 en el mismo caso.
    */
    $errores['roles_fk'] = 'No puedes asignarle ese rol a tu usuario';
}

if(count($errores) > 0){
$_SESSION['errores'] = $errores;
$_SESSION['oldData'] = $_POST;
//header('Location: ../index.php?s=crear-cuenta');
print_r($roles_fk);
var_dump($errores);
exit;
}

try {
    (new Usuario)->crear([
        'email'=>$email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'roles_fk'=>$roles_fk
    ]);
    $_SESSION['mensajeExito'] = 'Has creado un nuevo usuario';
    header('Location: ../index.php?s=login');
    exit;
} catch (Exception $error) {
    $_SESSION['mensajeError'] = 'Oh no, Ocurrio un error inesperado en el registro del usuario';
    header('Location: ../index.php?s=crear-cuenta');
    exit;
}