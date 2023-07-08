<?php 
require_once __DIR__ . '/../bd/BD.php';
class Categorias extends Modelo{
    protected string $tabla = "categorias";
    protected string $clavePrimaria = "id_categorias";

    private int $id_categorias;
    private string $nombre;

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