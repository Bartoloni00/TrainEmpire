<?php

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$autenticado = (new Autenticacion);
if (!$autenticado->estaAutenticado()) {
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para acceder a este contenido';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}
$usuario = $autenticado->getUsuario();
$id = $usuario->getIdUsuario();

$username = $_POST['username'];
$email = $_POST['email'];
$img = $_FILES['imagen'];

$errores = [];
if (empty($email)) {
    $errores['email'] = 'Tenes que seleccionar un email';
}

if (count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;
    //print_r($errores);
    header('Location: ../index.php?s=editar-usuario');
    exit;
}

if (!empty($img['tmp_name'])) {
    $nombreImagen = date('YmdHis').'_'.$img['name'];
    move_uploaded_file($img['tmp_name'],__DIR__.'/../assets/entrenadores/'.$nombreImagen);
    $img = $nombreImagen;
}else{
    $img = null;
}
try {
    (new Usuario)->editar($id,[
        'username'=>$username,
        'imagen'     =>$img ?? $usuario->getImagen(),
        'email'=>$email
    ]);
    if (isset($nombreImagen)&&$usuario->getImagen() !== null) {
        unlink(__DIR__.'/../../assets/entrenadores/'.$usuario->getImagen());
    }
    $_SESSION['mensajeExito'] = 'Tu usuario fue editado con exito.';
    header('Location: ../index.php?s=perfil');
    exit;
} catch (\Exception $error) {
$_SESSION['mensajeError'] = 'Ocurrio un error inesperado, intenta en unos minutos.' . $error;
   header('Location: ../index.php?s=editar-usuario');
   exit;
}