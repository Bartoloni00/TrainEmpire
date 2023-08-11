<?php
require_once __DIR__ . '/../../bootstrap/autoload.php';

class Carrito {
    /**
     * Le crea un carrito al usuario
     * @param array $data : debe contener fecha y usuarios_fk;
     * usuarios_fk es el id del usuario
     */
    public function crearCarrito(array $data){
        $db = BD::getConexion();
        $query = "INSERT INTO carrito (fecha,usuarios_fk)
                    VALUES (:fecha,:usuarios_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'fecha'=>$data['fecha'],
            'usuarios_fk'=>$data['usuarios_fk']
        ]);
    }

    /**
     * Esta funcion revisa si el usuario posee uno o mas carritos.
     * @param int $usuarios_fk id del usuario
     * @return bool true en caso de tener 1 o mas carrito y false en caso contrario.
     */
    public function usuarioTieneCarrito(int $usuarios_fk) :bool{
    $db = BD::getConexion();
    $query = "SELECT COUNT(*) AS total_carrito
              FROM carrito
              WHERE usuarios_fk = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$usuarios_fk]);

    $totalCarritos = $stmt->fetchColumn();
    
    return $totalCarritos > 0;
    }

    public function encontrarCarritoDelUsuario(int $id_usuario) :?int{
        $db = BD::getConexion();
        $query = "SELECT id_carrito
                    FROM carrito
                    WHERE usuarios_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id_usuario]);
        
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($carrito) {
            return $carrito['id_carrito'];
        } else {
            return null;
        }
    }

     /**
     * agrega un producto al carrito
     * @param array $data debe contener productos_fk y carrito_fk;
     * usuarios_fk es el id del usuario
     */
    public function agregarProductoAlCarrito(array $data){
        $db = BD::getConexion();
        $query = "INSERT INTO producto_en_carrito (cantidad,productos_fk,carrito_fk)
                    VALUES (1,:productos_fk,:carrito_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'productos_fk'=>$data['productos_fk'],
            'carrito_fk'=>$data['carrito_fk']
        ]);
    }

    /**
     * Elimina un producto de la tabla producto_en_carrito
     * 
     * @param int $id_producto_en_carrito
     */
    public function eliminarDelCarrito(int $id_producto_en_carrito){
        //require_once __DIR__ . '/../bd/BD.php';// TODO: revisar porque tengo que hacer esta importacion
        /* 
            No entiendo porque al ejecutar este metodo parece haber un problema de scope y no encuentra la clase BD
        */
        $db = BD::getConexion();
        $query = "DELETE FROM producto_en_carrito WHERE id_producto_en_carrito = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id_producto_en_carrito]);
    }

        /**
     * Esta funcion revisa si el carrito ya posee ese producto.
     * @param array $data id del producto y id del carrito
     * @return bool true en caso de aparecer 1 o mas veces el producto en el carrito y false en caso contrario.
     */
    public function productoEstaEnCarrito(array $data) :bool{
        $db = BD::getConexion();
        $query = "SELECT COUNT(*) AS total_producto_en_carrito
                  FROM producto_en_carrito
                  WHERE productos_fk = :productos_fk AND carrito_fk = :carrito_fk";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'productos_fk'=>$data['productos_fk'],
            'carrito_fk'=>$data['carrito_fk']
        ]);
    
        $totalProductos = $stmt->fetchColumn();
        
        return $totalProductos > 0;
        }

    /**
 * Trae los productos que el usuario agregó a su carrito
 * @param int $carrito_fk : ID del carrito
 * @return array|null : Array de productos o null si no se encontraron productos
 */
public function productosCarrito(int $carrito_fk): ?array {
    $db = BD::getConexion();
    $query = "SELECT pc.*
              FROM producto_en_carrito pc
              WHERE pc.carrito_fk = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$carrito_fk]);

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($productos) {
        return $productos;
    } else {
        return null;
    }
}



}