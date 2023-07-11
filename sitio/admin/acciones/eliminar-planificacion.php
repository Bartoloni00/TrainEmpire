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

$rutina = (new Rutinas)->porId($id);

if(!$rutina){
    header('Location: ../index.php?s=productos');
    exit;
}

try {
    (new Rutinas)->eliminar($id);//eliminamos planificacion
    //eliminamos imagen:
    if($rutina->getImagen()){
        unlink(__DIR__ . '/../../assets/productos/'.$rutina->getImagen());
    }
    $_SESSION['mensajeExito'] = "La planificacion fue eliminada con exito.";
    header('Location: ../index.php?s=productos');
    exit;
} catch (\Exception $error) {
    header('Location: ../index.php?s=productos');
    exit;
}