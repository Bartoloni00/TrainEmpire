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
     * @return array|static[]
     */
    public function todo():array{
        $bd = BD::getConexion();
        $query = "SELECT * FROM " . $this->tabla;
        $stmt = $bd->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,static::class);// static es Modelo solo si se ejecuta el método en una instancia de Modelo, sino será el nombre de la clase de la instancia.
        return $stmt->fetchAll();
    }
    
    public function porId(int $id): ?static {
        $bd = BD::getConexion();
        $query = "SELECT * FROM " . $this->tabla . "
        WHERE " . $this->clavePrimaria . " = ?";
        $stmt = $bd->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $instancia = $stmt->fetch();
    
        if (!$instancia) {
            return null;
        }
        return $instancia;
    }
    
}