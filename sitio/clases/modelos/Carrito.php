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

    public function agregarProductoAlCarrito(){
        
    }
    /**
     * Trae los productos que el usuario agrego a su carrito
     */
    public function productosCarrito(){

    }
}