<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticado = (new Autenticacion);
if (!$autenticado->estaAutenticado()) {
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para acceder a este contenido';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}
if ($autenticado->getUsuario()->getRolFk() === 3) {
    $_SESSION['mensajeError'] = 'Necesitas ser Administrador para visualizar este contenido';
    header('Location : ../index.php?s=dashboard');
    exit;
}

$id = $_GET['id'];

$usuario = (new Usuario)->porId($id);

if(!$usuario){
    header('Location: ../index.php?s=usuarios');
    exit;
}

try {
    $usuario->eliminar($id);//eliminamos planificacion
    //eliminamos imagen:
    if($usuario->getImagen()){
        unlink(__DIR__ . '/../../assets/entrenadores/'.$usuario->getImagen());
    }
    $_SESSION['mensajeExito'] = "El usuario fue eliminado con exito.";
    header('Location: ../index.php?s=usuarios');
    exit;
} catch (\Exception $error) {
    $_SESSION['mensajeError'] = "Ah ocurrido un error inesperado, intente en unos minutos.";
    header('Location: ../index.php?s=usuarios');
    exit;
}