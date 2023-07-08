<?php
/**
* Conexion a la base de datos
*/
class BD{
    protected static string $host = '127.0.0.1';
    protected static string $usuario = 'root';
    protected static string $contrasenia = '';
    protected static string $nombre = 'dw3_bartoloni_abraham';

    protected static ?PDO $bd = null;
    /**
     * Obtiene la conexion de la base de datos
     * 
     */
    public function getConexion(): PDO{
        //La palabra clave self se utiliza para acceder a elementos estáticos de una clase
        if(self::$bd === null){
            $dsn = 'mysql:host='. self::$host.';dbname='.self::$nombre . ';charset=utf8mb4';
        try{
            self::$bd = new PDO($dsn, self::$usuario, self::$contrasenia);
        } catch(Exception $error) {
            echo 'Error al conectar con MySQL <br>';
            echo 'El error eso: '. $error->getMessage();
            exit;
        }
        }
        return self::$bd;
    }
}