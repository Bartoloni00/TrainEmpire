<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

if (!(new Autenticacion)->estaAutenticado()) {
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para visualizar el contenido';
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}
$id = $_GET['id'];

$rutina = (new Rutinas)->conseguirId($id);

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