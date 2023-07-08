<?php
require_once __DIR__ . '/../bd/BD.php';

class Usuario extends Modelo{
    protected string $tabla = "usuarios";
    protected string $clavePrimaria = "id_usuarios";

    private int $id_usuarios;//estos nombres tiene que ser igual al de la BD
    private int $rol_fk;
    private string $email;
    private string $password;
    private ?string $username;

    // public function porId(string $id):?Usuario{
    //     $db = (new BD)->getConexion();
    //     $query = "SELECT * FROM usuarios WHERE id_usuarios = ?";
    //     $stmt = $db->prepare($query);
    //     $stmt->execute([$id]);

    //     $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
    //     /*
    //     Cuando se utiliza FETCH_CLASS, lo que sucede es que los valores de las columnas seleccionadas en la 
    //     consulta SQL se asignan directamente a las propiedades correspondientes de la instancia de la clase Usuario.
    //      Esto se realiza asumiendo que los nombres de las propiedades de la clase Usuario coinciden con los nombres 
    //      de las columnas en la base de datos. No se realiza una asignación directa a través de los métodos de la clase.
    //     Por ejemplo, si tienes una columna contrasenia en la tabla de la base de datos y una propiedad $contrasenia en 
    //     la clase Usuario, al usar FETCH_CLASS, el valor de la columna contrasenia se asignará directamente a la 
    //     propiedad $contrasenia sin pasar por ningún método.
    //     */
    //     $usuario = $stmt->fetch();

    //     if(!$usuario) return null;

    //     //print_r($usuario);
    //     return $usuario;
    // }
    
    public function porEmail(string $email): ?Usuario{
        $db = (new BD)->getConexion();
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS,Usuario::class);
        $usuario = $stmt->fetch();

        if(!$usuario) return null;

        //print_r($usuario);
        return $usuario;
    }
    
    public function getIdUsuario(): int
    {
        return $this->id_usuarios;
    }

    public function setUsuarioId(int $id_usuario): void
    {
        $this->id_usuarios = $id_usuario;
    }

    public function getRolFk(): int
    {
        return $this->rol_fk;
    }

    public function setRolFk(int $rol_fk): void
    {
        $this->rol_fk = $rol_fk;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }
}