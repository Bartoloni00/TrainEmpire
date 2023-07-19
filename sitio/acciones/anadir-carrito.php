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
    if ($autenticacion->getUsuario()->getRolFk() !== 3) {
        $_SESSION['mensajeError'] = 'Esta cuenta no puede poseer un carrito de compras';
        header('Location: ../index.php?s=detalles&id='. $id_producto);
        exit;
    }
    if ($carrito->usuarioTieneCarrito($id_usuarios)) {
        $id_carrito = $carrito->encontrarCarritoDelUsuario($id_usuarios);
        if (!$carrito->productoEstaEnCarrito([
            'productos_fk'=>$id_producto,
            'carrito_fk'=>$id_carrito
            ])) 
        {
            $carrito->agregarProductoAlCarrito([
                'productos_fk'=>$id_producto,
                'carrito_fk'=>$id_carrito
            ]);
            $_SESSION['mensajeExito'] = 'El producto a sido agregado al carrito';
        }else{
            $_SESSION['mensajeError'] = 'el producto ya existe en el carrito';
        }
    }else{
        $fecha = date('Y-m-d');
        $usuarios_fk = $id_usuarios;

        $carrito->crearCarrito([
            'fecha'=>$fecha,
            'usuarios_fk'=>$usuarios_fk
        ]);
        //agrego el producto al carrito
        $id_carrito = $carrito->encontrarCarritoDelUsuario($id_usuarios);
        if (!$carrito->productoEstaEnCarrito([
            'productos_fk'=>$id_producto,
            'carrito_fk'=>$id_carrito
            ])) 
        {
            $carrito->agregarProductoAlCarrito([
                'productos_fk'=>$id_producto,
                'carrito_fk'=>$id_carrito
            ]);
            $_SESSION['mensajeExito'] = 'El producto a sido agregado al carrito';
        }else{
            $_SESSION['mensajeError'] = 'el producto ya existe en el carrito';
        }
    }
    header('Location: ../index.php?s=detalles&id='. $id_producto);
    exit;
} catch (\Exception $error) {
    $_SESSION['mensajeError'] = 'Ocurrio un error inesperado intente en unos minutos'. $error;
    header('Location: ../index.php?s=detalles&id='. $id_producto);
    exit;
}