<?php
require_once __DIR__ . '/../bd/BD.php';
class Roles extends Modelo{
    protected string $tabla = "roles";
    protected string $clavePrimaria = "id_roles";

    private int $id_roles;
    private string $nombre;

    public function getId(): int{
        return $this->id_roles;
    }

    public function getNombre(): string{
        return $this->nombre;
    }
}