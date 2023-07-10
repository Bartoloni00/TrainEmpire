<?php
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    if((new Autenticacion)->iniciarSesion($email,$password)){
        $_SESSION['mensajeExito'] = 'Hola campeon';
        header("Location: ../index.php?s=home");
        exit;
    }
    $_SESSION['mensajeError'] = 'El email o la contraseña son incorrectos';
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
} catch (Exception $error) {
    $_SESSION['mensajeError'] = 'Ocurrio un error inesperado. vuelve a intentar en unos minutos';
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
}
