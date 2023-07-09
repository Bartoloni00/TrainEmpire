<?php
require_once __DIR__ . '/../../bootstrap/autoload.php';

/**
 * Clase base para todos los modelos del sistema.
 * Incluye métodos para hacer algunas consultas comunes.
 */
class Modelo{
    /** @var string El nombre de la tabla asociada al modelo. */
    protected string $tabla = "";
    /** @var string El nombre de la primary key de la tabla asociada al modelo. */
    protected string $clavePrimaria = "";

/**
 * Trae todos los datos de una tabla (dependiendo de su clase).
 *
 * @return array|static[] Un arreglo de objetos de la clase actual.
 */
    public function todo():array{
        $bd = BD::getConexion();
        $query = "SELECT * FROM " . $this->tabla;
        $stmt = $bd->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,static::class);// static es Modelo solo si se ejecuta el método en una instancia de Modelo, sino será el nombre de la clase de la instancia.
        return $stmt->fetchAll();
    }
    
/**
 * Trae un elemento de una tabla dependiendo de su clave primaria (id).
 *
 * @param int $id Clave primaria del elemento que se desea traer.
 * @return static|null Una instancia de la clase actual o null si no se encuentra el elemento.
 */
    public function porId(int $id): ?static {
        $bd = BD::getConexion();
        $query = "SELECT * FROM " . $this->tabla . "
        WHERE " . $this->clavePrimaria . " = ?";
        $stmt = $bd->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $instancia = $stmt->fetch();
    //     Cuando se utiliza FETCH_CLASS, lo que sucede es que los valores de las columnas seleccionadas en la 
    //     consulta SQL se asignan directamente a las propiedades correspondientes de la instancia de la clase Usuario.
    //      Esto se realiza asumiendo que los nombres de las propiedades de la clase Usuario coinciden con los nombres 
    //      de las columnas en la base de datos. No se realiza una asignación directa a través de los métodos de la clase.
    //     Por ejemplo, si tienes una columna contrasenia en la tabla de la base de datos y una propiedad $contrasenia en 
    //     la clase Usuario, al usar FETCH_CLASS, el valor de la columna contrasenia se asignará directamente a la 
    //     propiedad $contrasenia sin pasar por ningún método.
        if (!$instancia) {
            return null;
        }
        return $instancia;
    }
    
}