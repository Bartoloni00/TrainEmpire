<?php
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

if(!(new Autenticacion)->estaAutenticado()){
    $_SESSION['mensajeError'] = 'Se requiere iniciar sesion para visualizar este contenido';
    header('Location : ../index.php?s=iniciar-sesion');
    exit;
}


if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $id = isset($_POST['id'])?$_POST['id']:'';
    $nombre = $_POST['nombre'];
    switch ($accion) {
        case 'agregar':
            // Lógica para el botón "Agregar"
            try {
                (new Categorias)->crear($nombre);
                $_SESSION['mensajeExito'] = 'La categoria "<b>'. $nombre . '</b>" se creo exitosamente.';
                header('Location: ../index.php?s=categorias');
                exit;
            } catch (Exception $error) {
                $_SESSION['mensajeError'] = 'Algo fallo en la creacion de la categoria: ' . $nombre . '<br>' . $error;
                header('Location: ../index.php?s=categorias');
                print_r($error);
                exit;
            }
            break;
        case 'editar':
            // Lógica para el botón "Editar"
            try {
                (new Categorias)->editar($id,$nombre);
                $_SESSION['mensajeExito'] = 'La categoria "<b>'.$id . $nombre . '</b>" se edito exitosamente.';
                header('Location: ../index.php?s=categorias');
                exit;
            } catch (Exception $error) {
                $_SESSION['mensajeError'] = 'Algo fallo en la edicion de la categoria: ' . $nombre;
                header('Location: ../index.php?s=categorias');
                print_r($error);
                exit;
            }
            break;
        case 'eliminar':
            // Lógica para el botón "Eliminar"
            try {
                (new Categorias)->eliminar($id);
                $_SESSION['mensajeExito'] = 'La categoria "<b>'. $nombre . '</b>" se elimino exitosamente.';
                header('Location: ../index.php?s=categorias');
                exit;
            } catch (Exception $error) {
                if ($error->getCode() === '23000') {//CODIGO DE LA FK ESTA UTILIZADA
                    $_SESSION['mensajeError'] = 'La categoria: ' . $nombre . ' no puede ser eliminada porque esta siendo utilizada';
                }else{
                    $_SESSION['mensajeError'] = 'Algo fallo en la eliminacion de la categoria: ' . $nombre;
                }
                header('Location: ../index.php?s=categorias');
                print_r($error);
                exit;
            }
            break;
    }
}
?>