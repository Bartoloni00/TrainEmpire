<?php 
// TODO: modificar para el final para que obtenga los usuarios registrados como entrenador desde la BD
class Entrenadores{
    private int $entrenador_id;
    private string $nombre;
    private string $descripcion;
    private string $imagen;
    /**
     * Obtiene todas las entrenadores.
     *
     * @return Entrenadores[]  La lista de entrenadores. Cada entrenador es un array con las claves: 'entrenador_id', 'nombre', 'descripcion' e 'imagen'
     */
    public function todos(): array{
        $data = json_decode(file_get_contents(__DIR__ . '/../../api/data-entrenadores.json'), true);

        $entrenadores = [];

        foreach($data as $datos) {
            $entrenador = new Entrenadores;
            $entrenador->entrenador_id = $datos["id"];
            $entrenador->nombre        = $datos['nombre'];
            $entrenador->descripcion   = $datos['descripcion'];
            $entrenador->imagen        = $datos['imagen'];

            $entrenadores[] = $entrenador;
        }

        return $entrenadores;
    }
  //creo todos los getters
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getId(): string{
        return $this->entrenador_id;
    }
    public function getDescripcion(): string{
        return $this->descripcion;
    }
    public function getImagen(): string{
        return $this->imagen;
    }
}
