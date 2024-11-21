<?php
namespace proyecto\app\entity;

class Imagen implements IEntity
{
    private $id;
    private $nombre;

    const RUTA_IMAGENES_WEB = '/public/img/index/';

    public function __construct(string $nombre = "")
    {
        $this->id = null;
        $this->nombre = $nombre;
    }
    public function setNombre($nombre): Imagen
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
    public function getUrl(): string
    {
        return self::RUTA_IMAGENES_WEB . $this->getNombre();
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
        ];
    }
}
