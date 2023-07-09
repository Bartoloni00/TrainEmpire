<?php
require_once __DIR__ . '/../bd/BD.php';// TODO: esto seguramente tenga que hacerlo en un constructor mas adelante 
class Rutinas extends Modelo{
    protected string $tabla = "productos";
    protected string $clavePrimaria = "id_productos";

    private int   $id_productos;
    private string $usuarios_fk;
    private string $titulo;
    private string $descripcion;
    private string $sintesis;
    private ?string $imagen;
    private int    $precio;
    private string $categorias_fk;

    /**
     * Crea/Agrega una rutina/planificacion en la tabla productos.
     * 
     * @param array $data Todos los datos necesarios para ejecutar el query.
     *      $data debe contener: usuarios_fk, titulo, descripcion, sintesis, imagen, precio y categorias_fk.
     */
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

    /**
     * Edita una rutina/planificacion en la tabla productos.
     * 
     * @paran int $id Clave primaria de la rutina a modificar.
     * @param array $data Todos los datos necesarios para ejecutar el query.
     *      $data debe contener: usuarios_fk, titulo, descripcion, sintesis, imagen, precio y categorias_fk.
     */
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

        /**
     * Elimina una rutina/planificacion en la tabla productos.
     * 
     * @param int $id Clave primaria de la rutina a eliminar
     */
    public function eliminar(int $id){
        $db = (new BD)->getConexion();
        $query = "DELETE FROM productos WHERE id_productos = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

        /**
     * Acorta la descripcion dependiendo de cuando aparece el primer . (punto) o ? (interrogacion)
     * 
     * @param string $descripcion Texto completo que deseamos acortar.
     * @return string Texto acortado
     */
    public function crearSintesis( string $descripcion) :string{
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