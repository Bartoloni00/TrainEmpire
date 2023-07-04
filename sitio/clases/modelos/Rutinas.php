<?php
require_once __DIR__ . '/../bd/BD.php';// TODO: esto seguramente tenga que hacerlo en un constructor mas adelante 
class Rutinas {
    private int   $id_productos;
    private string $usuarios_fk;
    private string $titulo;
    private string $descripcion;
    private string $sintesis;
    private ?string $imagen;
    private int    $precio;
    private string $categorias_fk;


    /**
     * Método que retorna todas las rutinas disponibles en el sistema.
     *
     * @return array Arreglo con todas las rutinas disponibles.
     */
    public function todas(): array{
            $db = (new BD)->getConexion();
            $query = "SELECT * FROM productos";
            $stmt = $db->prepare($query);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Rutinas::class);
            return $stmt->fetchAll();
    }
    /**
     * Método que retorna una rutina específica según su identificador único.
     *
     * @param int $id_productos Identificador único de la rutina.
     * @return Rutinas|null La rutina correspondiente al identificador especificado, o null si no se encuentra.
     */
    public function conseguirId(int $id_productos): ?Rutinas
    {
        $db = (new BD)->getConexion();
        $query = "SELECT * FROM productos WHERE id_productos = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id_productos]);

        $stmt->setFetchMode(PDO::FETCH_CLASS,Rutinas::class);
        $rutina = $stmt->fetch();

        if(!$rutina) return null;
        return $rutina;
    }
    public function crear(array $data){
        $db = (new BD)->getConexion();
        $query = "INSERT INTO productos (usuarios_fk, titulo,descripcion,sintesis,imagen,precio,categorias_fk)
                  VALUES  (:usuarios_fk,:titulo,:descripcion,:sintesis,:imagen,:precio,:categorias_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuarios_fk'=>$data['usuarios_fk'],
            'categorias_fk'=>$data['categorias_fk'],
            'titulo'     =>$data['titulo'],
            'descripcion'=>$data['descripcion'],
            'sintesis'   =>$data['sintesis'],
            'imagen'     =>$data['imagen'],
            'precio'     =>$data['precio']
        ]);          
    }
    public function editar(int $id, array $data){
        $db = (new BD)->getConexion();
        $query = "UPDATE productos
                  SET   titulo       = :titulo,
                        descripcion  = :descripcion,
                        sintesis     = :sintesis,
                        imagen       = :imagen,
                        precio       = :precio
                  WHERE id_productos = :id_productos";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'titulo'      =>$data['titulo'],
            'descripcion' =>$data['descripcion'],
            'sintesis'    =>$data['sintesis'],
            'imagen'      =>$data['imagen'],
            'precio'      =>$data['precio'],
            'id_productos'=>$id
        ]);
    }
    public function eliminar(int $id){
        $db = (new BD)->getConexion();
        $query = "DELETE FROM productos WHERE id_productos = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }
    public function crearSintesis($descripcion){
        $posicion_punto = strpos($descripcion, ".");
        $posicion_interrogacion = strpos($descripcion, "?");

        if ($posicion_punto !== false && $posicion_interrogacion !== false) {
             // Si hay tanto un punto como una interrogación, obtener la posición de la primera aparición
            $posicion = min($posicion_punto, $posicion_interrogacion);
            } elseif ($posicion_punto !== false) {
            // Si sólo hay un punto, obtener la posición de la primera aparición
            $posicion = $posicion_punto;
            } elseif ($posicion_interrogacion !== false) {
            // Si sólo hay una interrogación, obtener la posición de la primera aparición
            $posicion = $posicion_interrogacion;
            } else {
            // Si no hay puntos ni interrogaciones, el texto completo es la porción
            $posicion = strlen($descripcion);
            }
            $resumen = substr($descripcion, 0, $posicion+1);
                        
            return $resumen;
    }
    public function setSintesis($sintesis){
        $this->sintesis = $sintesis;
    }
    public function getSintesis(){
        return $this->sintesis;
    }
    public function getId(): int{
        return $this->id_productos;
    }
    public function getTitulo(): string{
        return $this->titulo;
    }
    public function getDescripcion(): string{
        return $this->descripcion;
    }
    public function getusuarios_fk(): string{
        return $this->usuarios_fk;
    }
    public function getPrecio(): int{
        return $this->precio;
    }
    public function getImagen(): ?string{
        return $this->imagen;
    }
    public function getCategoria(): string{
        return $this->categorias_fk;
    }
}