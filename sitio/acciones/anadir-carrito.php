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

$id_usuarios = $autenticacion->getUsuario()->getIdUsuario();
$id_producto = $_POST['id_producto'];

try {
    $a;
    if ($carrito->usuarioTieneCarrito($id_usuarios)) {
        //Agregar el producto a este carrito
        $a = 'if';
    }else{
        $fecha = date('Y-m-d');
        $usuarios_fk = $id_usuarios;

        $carrito->crearCarrito([
            'fecha'=>$fecha,
            'usuarios_fk'=>$usuarios_fk
        ]);
        //Agregar el producto a este carrito
        $a = 'else';
    }
    $_SESSION['mensajeExito'] = 'El producto a sido agregado al carrito' . $a;
    header('Location: ../index.php?s=detalles&id='. $id_producto);
    exit;
} catch (\Exception $error) {
    $_SESSION['mensajeError'] = 'Ocurrio un error inesperado intente en unos minutos'. $error;
    header('Location: ../index.php?s=detalles&id='. $id_producto);
    exit;
}