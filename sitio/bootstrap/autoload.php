<?php
//Autoload de Compouser:
require_once __DIR__.'/../vendor/autoload.php';
//Autoload de TrainEmpire
spl_autoload_register(function($nombreDeLaClase){
    $nombreDeLaClase = str_replace('\\', '/', $nombreDeLaClase); // Reemplazar barras invertidas por barras diagonales

    $rutaDeLaClase = __DIR__ . '/../clases/'. $nombreDeLaClase.'.php';
    $rutaDeLaClaseModelos = __DIR__ . '/../clases/modelos/'. $nombreDeLaClase.'.php';
    $rutaDeLaClaseAutenticacion = __DIR__ . '/../clases/autenticacion/'. $nombreDeLaClase.'.php';
    //echo "Buscando la clase: ".$nombreDeLaClase."<br>";

    if (file_exists($rutaDeLaClase)) {
        //echo "Incluyendo el archivo: ".$rutaDeLaClase."<br>";
        require_once $rutaDeLaClase;
    } elseif (file_exists($rutaDeLaClaseModelos)) {
        //echo "Incluyendo el archivo: ".$rutaDeLaClaseModelos."<br>";
        require_once $rutaDeLaClaseModelos;
    }elseif (file_exists($rutaDeLaClaseAutenticacion)) {
        require_once $rutaDeLaClaseAutenticacion;
    } else {
        //echo "No se encontró el archivo de clase<br>";
    }
});