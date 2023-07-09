<?php
  require_once __DIR__ . '/../../bootstrap/autoload.php';
//traer usuarios
/**
 * Manejador del estado de autenticacion de usuarios
 */
class Autenticacion{
    /**
     * Inicia sesión de un usuario.
     *
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return bool Retorna true si el inicio de sesión es exitoso, de lo contrario retorna false.
     */
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

    /**
     * Marca al usuario como autenticado.
     *
     * @param Usuario $usuario El objeto Usuario que se marcará como autenticado.
     * @return void
     */
    public function marcarComoAutenticado(Usuario $usuario):void{
        $_SESSION['id_usuarios'] = $usuario->getIdUsuario();
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return void No retorna ningun valor.
     */
    public function cerrarSesion():void{
        unset($_SESSION['id_usuarios']);
    }

    /**
     * Verifica si el usuario está autenticado.
     *
     * @return bool Retorna true si el usuario está autenticado, de lo contrario retorna false.
     */
    public function estaAutenticado():bool{
        return isset($_SESSION['id_usuarios']);
    }

     /**
     * Obtiene el objeto Usuario del usuario autenticado actualmente.
     *
     * @return Usuario|null Retorna el objeto Usuario del usuario autenticado actualmente, o null si no está autenticado.
     */
    public function getUsuario(): ?Usuario{
        if(!$this->estaAutenticado())return null;
        return (new Usuario)->porId($_SESSION['id_usuarios']);
    }
}  