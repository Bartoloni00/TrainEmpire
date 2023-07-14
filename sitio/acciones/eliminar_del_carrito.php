<?php
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$autenticacion = new Autenticacion;
$carrito = new Carrito;

if(!$autenticacion->estaAutenticado()){
    $_SESSION['mensajeError'] = 'Se requiere iniciar sesion para visualizar este contenido';
    header('Location : ../index.php?s=home');
    exit;
}

$id_producto_en_carrito = $_POST['id'];
try {
    $carrito->eliminarDelCarrito($id_producto_en_carrito);
    $_SESSION['mensajeExito'] = 'Haz eliminado el producto de tu carrito';
    header('Location: ../index.php?s=carrito');
    exit;
} catch (Exception $error) {
    $_SESSION['mensajeError'] = 'Algo salio mal, no se pudo eliminar el producto de tu carrito, intenta en unos minutos';
    header('Location: ../index.php?s=carrito');
    exit;
}