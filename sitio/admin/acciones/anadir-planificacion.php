<?php
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

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
$categoria_fk  = $_POST['categoria_fk'];
$usuarios_fk = $autenticado->getUsuario()->getIdUsuario();
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
    //move_uploaded_file($img['tmp_name'],__DIR__.'/../../assets/productos/'.$nombreImagen);
    //Optimizamos las imagenes de las rutinas para que midas 544x306 con Intervention Image
    $imagenEditada = Image::make($img['tmp_name']);//abro la imagen para luego editarla
    // $imagenEditada->resize(544,306, function ($constraint) {
    //     $constraint->aspectRatio();
    // });
    $imagenEditada->fit(544,306);//recorto y redimenciono la imagen
    $imagenEditada->save(__DIR__.'/../../assets/productos/'.$nombreImagen);//guardo la imagen
    $img = $nombreImagen;//asigno el nombre de la imagen para que sea guardado en la BD
}else{
    $img = null;
}

try {
    (new Rutinas)->crear([
        'usuarios_fk'=>$usuarios_fk,
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