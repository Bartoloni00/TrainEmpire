<?php
/**
* Conexion a la base de datos
*/
class BD{
    protected string $host = '127.0.0.1';
    protected string $usuario = 'root';
    protected string $contrasenia = '';
    protected string $nombre = 'dw3_bartoloni_abraham';

    public function getConexion():PDO{
        $dsn = 'mysql:host='. $this->host.';dbname='.$this->nombre . ';charset=utf8mb4';
        try{
            $bd = new PDO($dsn, $this->usuario, $this->contrasenia);
            return $bd;
        } catch(Exception $error) {
            echo 'Error al conectar con MySQL <br>';
            echo 'El error eso: '. $error->getMessage();
            exit;
        }
    }
}