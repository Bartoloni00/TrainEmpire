<?php
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

(new Autenticacion())->cerrarSesion();

$_SESSION['mesanejExito'] = 'La session se cerro exitosamente';
header('Location: ../index.php?s=home');
exit;