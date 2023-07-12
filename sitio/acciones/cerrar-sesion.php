<?php
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

if(!(new Autenticacion())->estaAutenticado()){
    $_SESSION['mensajeError'] = 'No existe una session abierta';
    header('Location : ../index.php?s=home');
    exit;
}

try {
    (new Autenticacion())->cerrarSesion();

    $_SESSION['mesanejExito'] = 'La session se cerro exitosamente';
    header('Location: ../index.php?s=home');
    exit;
} catch (Exception $error) {
    $_SESSION['mesanejError'] = 'Ocurrio un error inesperado intente en unos minutos';
    header('Location: ../index.php?s=home');
    exit;
}