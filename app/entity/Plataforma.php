<?php
require_once __DIR__ . '/IEntity.php';

class Plataforma implements IEntity
{
    private $codigo;
    private $nombre;

    public function __construct(string $cod = '', string $nombre = '')
    {
        $this->codigo = $cod;
        $this->nombre = $nombre;
    }
    public function setCod($codigo): Plataforma
    {
        $this->codigo = $codigo;
        return $this;
    }
    public function setNombre($nombre): Plataforma
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getCod()
    {
        return $this->codigo;
    }
    public function getNombre(): ?string
    { 
        return $this->nombre;
    }
    public function __toString()
    {
        return $this->getNombre();
    }
    public function toArray(): array
    {
        return [
            'codigo' => $this->getCod(),
            'nombre' => $this->getNombre()
        ];
    }
}