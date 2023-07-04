<?php
  require_once __DIR__ . '/../../bootstrap/autoload.php';
//traer usuarios
/**
 * Manejador del estado de autenticacion de usuarios
 */
class Autenticacion{
    public function iniciarSesion(string $email, string $password):bool{
        $usuario = (new Usuario)->porEmail($email);
        // si el usuario no existe:
        if(!$usuario)return false;
        //si la contraseña no coincide:
        if(!password_verify($password,$usuario->getPassword()))return false;
        //if(!$password == $usuario->getPassword()) return false;
        $this->marcarComoAutenticado($usuario);
        return true;
    }
    public function marcarComoAutenticado(Usuario $usuario):void{
        $_SESSION['id_usuarios'] = $usuario->getIdUsuario();
    }
    public function cerrarSesion():void{
        unset($_SESSION['id_usuarios']);
    }
    public function estaAutenticado():bool{
        return isset($_SESSION['id_usuarios']);
    }
    public function getUsuario(): ?Usuario{
        if(!$this->estaAutenticado())return null;
        return (new Usuario)->porId($_SESSION['id_usuarios']);
    }
}  