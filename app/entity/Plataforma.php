<?php
namespace proyecto\app\entity;

class Plataforma implements IEntity
{
    private $id;
    private $nombre;

    public function __construct(string $id = '', string $nombre = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    public function setId($id): Plataforma
    {
        $this->id = $id;
        return $this;
    }
    public function setNombre($nombre): Plataforma
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getId()
    {
        return $this->id;
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
            'id' => $this->getId(),
            'nombre' => $this->getNombre()
        ];
    }
}