<?php
require_once __DIR__ . '/../bd/BD.php';

class Usuario extends Modelo{
    protected string $tabla = "usuarios";
    protected string $clavePrimaria = "id_usuarios";

    private int $id_usuarios;//estos nombres tiene que ser igual al de la BD
    private int $roles_fk;
    private string $email;
    private string $password;
    private ?string $username;
    private ?string $imagen;
    
    /**
 * Trae a un usuario dependiendo de su email.
 *
 * @param string $email Email del usuario que se desea traer.
 * @return Usuario|null Una instancia de la clase actual o null si no se encuentra el elemento.
 */
    public function porEmail(string $email): ?Usuario{
        $db = BD::getConexion();
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS,Usuario::class);
        $usuario = $stmt->fetch();

        if(!$usuario) return null;

        //print_r($usuario);
        return $usuario;
    }
    
        /**
     * Crea/Agrega un usuario en la tabla usuarios.
     * 
     * @param array $data Todos los datos necesarios para ejecutar el query.
     *      $data debe contener: email, password y rol del mismo.
     */
    public function crear(array $data): void
    {
        $db = BD::getConexion();
        $query = "INSERT INTO usuarios (email, password, roles_fk)
                VALUES (:email, :password, :roles_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'email'     => $data['email'],
            'password'  => $data['password'],
            'roles_fk'    => $data['roles_fk'],
        ]);
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
        return $this->roles_fk;
    }

    public function setRolFk(int $roles_fk): void
    {
        $this->roles_fk = $roles_fk;
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

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): void
    {
        $this->imagen = $imagen;
    }
}