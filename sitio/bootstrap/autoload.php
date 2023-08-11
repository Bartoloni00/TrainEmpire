<?php
//Autoload de Compouser:
require_once __DIR__.'/../vendor/autoload.php';
//Autoload de TrainEmpire
spl_autoload_register(function($nombreDeLaClase){
    $nombreDeLaClase = str_replace('\\', '/', $nombreDeLaClase); // Reemplazar barras invertidas por barras diagonales

    $rutaDeLaClase = __DIR__ . '/../clases/'. $nombreDeLaClase.'.php';
    $rutaDeLaClaseModelos = __DIR__ . '/../clases/modelos/'. $nombreDeLaClase.'.php';
    $rutaDeLaClaseAutenticacion = __DIR__ . '/../clases/autenticacion/'. $nombreDeLaClase.'.php';
    $rutaDeLaClaseDB = __DIR__ . '/../clases/bd/'. $nombreDeLaClase.'.php';
    //echo "Buscando la clase: ".$nombreDeLaClase."<br>";

    if (file_exists($rutaDeLaClase)) {//caroeta raiz de las clases
        require_once $rutaDeLaClase;
    } elseif (file_exists($rutaDeLaClaseModelos)) {//subcarpeta modelos
        require_once $rutaDeLaClaseModelos;
    }elseif (file_exists($rutaDeLaClaseAutenticacion)) {//subcarpeta autenticacion
        require_once $rutaDeLaClaseAutenticacion;
    }elseif (file_exists($rutaDeLaClaseDB)) {//subcarpeta base de datos
        require_once $rutaDeLaClaseDB;
    } else {
        //echo "No se encontró el archivo de clase<br>";
    }
});