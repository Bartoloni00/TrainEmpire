<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    if ((new Autenticacion)->iniciarSesion($email,$password)) {
        $_SESSION['mensajeExito'] = 'El admin ha regresado';
        header('Location: ../index.php?s=dashboard');
        exit;
    }
    $_SESSION['mensajeError'] = 'No eres digno de ingresar como admin';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
} catch (Exception $error) {
    $_SESSION['mensajeError'] = 'Ocurrio un error inesperado. Por favor, intente nuevamente en unos minutos.';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}