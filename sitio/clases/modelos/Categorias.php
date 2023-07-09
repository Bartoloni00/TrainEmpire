<?php 
require_once __DIR__ . '/../bd/BD.php';
class Categorias extends Modelo{
    protected string $tabla = "categorias";
    protected string $clavePrimaria = "id_categorias";

    private int $id_categorias;
    private string $nombre;

        /**
     * Crea/Agrega una categoria en la tabla categorias.
     * 
     * @param string $nombre El nombre de la categoria.
     */
    public function crear(string $nombre){
        $db = BD::getConexion();
        $query = "INSERT INTO categorias (id_categorias , nombre)  VALUES(null,:nombre)";
        $stmt = $db->prepare($query);
        $stmt->execute([':nombre'=>$nombre]);     
    }

           /**
     * Modifica una categoria en la tabla categorias.
     * 
     * @param int $id Clave primaria de la categoria a modificar.
     * @param string $nombre El nuevo nombre de la categoria.
     */
    public function editar(int $id, string $nombre){
        $db = BD::getConexion();
        $query = "UPDATE categorias
                  SET   nombre        = :nombre
                  WHERE id_categorias = :id_categorias";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre'      =>$nombre,
            'id_categorias'=>$id
        ]);
    }

            /**
     * Elimina una categoria en la tabla categorias.
     * 
     * @param int $id Clave primaria de la categoria a eliminar
     */
    public function eliminar(int $id){
        $db = BD::getConexion();
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