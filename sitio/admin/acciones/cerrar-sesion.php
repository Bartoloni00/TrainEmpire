<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

(new Autenticacion())->cerrarSesion();

$_SESSION['mensajeExito'] = 'La sesión se cerro con exito.';
header('Location: ../index.php?s=iniciar-sesion');
exit;