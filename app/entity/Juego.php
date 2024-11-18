<?php

class Juego
{
    private $codigo;
    private $nombre;
    private $imagen;
    private $plataforma;
    private $numReviews;

    const RUTA_IMAGENES_JUEGOS = '/public/img/portadas/';

    public function __construct(string $nombre = "", string $imagen = "", string $plataforma = '', int $numReviews = 0)
    {
        $this->codigo = null;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->plataforma = $plataforma;
        $this->numReviews = $numReviews;
    }
    public function setNombre($nombre): Juego
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function setImagen($imagen): Juego
    {
        $this->imagen = $imagen;
        return $this;
    }
    public function setPlataforma($plataforma): Juego
    {
        $this->plataforma = $plataforma;
        return $this;
    }
    public function setNumReviews($numRevs): Juego
    {
        $this->numReviews = $numRevs;
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
    public function getImagen(): string
    {
        return $this->imagen;
    }
    public function getPlataforma(): string
    {
        return $this->plataforma;
    }
    public function getNumRevs(): int
    {
        return $this->numReviews;
    }
    public function __toString()
    {
        return $this->getNombre();
    }
    public function getUrlPortada(): string
    {
        return self::RUTA_IMAGENES_JUEGOS . $this->getImagen();
    }
    public function toArray(): array
    {
        return [
            'codigo' => $this->getCod(),
            'nombre' => $this->getNombre(),
            'imagen' => $this->getImagen(),
            'plataforma' => $this->getPlataforma(),
            'numReviews' => $this->getNumRevs()
        ];
    }
}
