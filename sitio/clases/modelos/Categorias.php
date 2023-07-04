<?php 
require_once __DIR__ . '/../bd/BD.php';
class Categorias{
    private int $id_categorias;
    private string $nombre;
    // public function __construct() {
    //     $this->id_categorias = 0; // O asigna el valor inicial deseado
    // }
        /**
     * Obtiene todas las categorias y sus respectivos productos.
     *
     * @return Categorias[]  La lista de categorias. Cada categorias es un objeto que contiene las imagenes y otro objeto con las rutinas correspondientes
     */
    public function todos(): array{
            $db = (new BD)->getConexion();
            $query = "SELECT * FROM categorias";
            $stmt = $db->prepare($query);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Categorias::class);
            return $stmt->fetchAll();
    }
    public function conseguirId(int $id_categorias): ?Categorias
    {
        $db = (new BD)->getConexion();
        $query = "SELECT * FROM categorias WHERE id_categorias = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id_categorias]);

        $stmt->setFetchMode(PDO::FETCH_CLASS,Categorias::class);
        $categoria = $stmt->fetch();

        if(!$categoria) return null;
        return $categoria;
    }
    public function crear(string $nombre){
        $db = (new BD)->getConexion();
        $query = "INSERT INTO categorias (id_categorias , nombre)  VALUES(null,:nombre)";
        $stmt = $db->prepare($query);
        $stmt->execute([':nombre'=>$nombre]);     
    }
    public function editar(int $id, string $nombre){
        $db = (new BD)->getConexion();
        $query = "UPDATE categorias
                  SET   nombre        = :nombre
                  WHERE id_categorias = :id_categorias";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre'      =>$nombre,
            'id_categorias'=>$id
        ]);
    }
    public function eliminar(int $id){
        $db = (new BD)->getConexion();
        $query = "DELETE FROM categorias WHERE id_categorias = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getId(): string{
        return $this->id_categorias;
    }
}