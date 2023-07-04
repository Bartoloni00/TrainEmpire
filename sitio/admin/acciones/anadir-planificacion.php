<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

if (!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para acceder a este contenido';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}
$categoria_fk  = $_POST['categoria_fk'];
$usuarios_fk = $_POST['usuarios_fk'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$sintesis = (isset($_POST['sinopsis']) && !(empty($_POST['sinopsis'])))?$_POST['sinopsis']:(new Rutinas)->crearSintesis($descripcion);
$img = $_FILES['imagen'];
$precio = $_POST['precio'];

$errores = [];
if (empty($categoria_fk)) {
    $errores['categoria_fk'] = 'Tenes que seleccionar una categoria';
}
if (empty($usuarios_fk)) {
    $errores['usuarios_fk'] = 'Tenes que seleccionar un entrenador';
}
if (empty($titulo)) {
    $errores['titulo'] = 'La planificacion debe poseer un titulo';
}

if (empty($descripcion)) {
    $errores['descripcion'] = 'La planificacion debe poseer una descripcion';
}

if (empty($precio)) {
    $errores['precio'] = 'La planificacion debe poseer un precio';
}

if (count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;
    print_r($_SESSION);
    header('Location: ../index.php?s=anadir-planificaciones');
    exit;
}

if (!empty($img['tmp_name'])) {
    $nombreImagen = date('YmdHis').'_'.$img['name'];
    move_uploaded_file($img['tmp_name'],__DIR__.'/../../assets/productos/'.$nombreImagen);
    $img = $nombreImagen;
}else{
    $img = null;
}

try {
    (new Rutinas)->crear([
        'usuarios_fk'=>1,
        'categorias_fk'=>$categoria_fk,
        'titulo'     =>$titulo,
        'descripcion'=>$descripcion,
        'sintesis'   =>$sintesis,
        'imagen'     =>$img,
        'precio'     =>$precio
    ]);
    $_SESSION['mensajeExito'] = 'La planificacion "<b>'. $titulo . '</b>" se publico con exito.';
    header('Location: ../index.php?s=productos');
    exit;
} catch (Exception $error) {
    header('Location: ../index.php?s=anadir-planificaciones');
    print_r($error);
    exit;
}