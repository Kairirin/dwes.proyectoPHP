<?php

namespace proyecto\app\entity;

class Review implements IEntity
{
    private $id;
    private $videojuego;
    private $titulo;
    private $comentario;
    private $captura;
    private $autor;

    const RUTA_CAPTURA = '/public/img/capturasUsuarios/';

    public function __construct(int $videojuego = 0, string $titulo = "", string $comentario = "", string $captura = '', int $autor = 0)
    {
        $this->id = null;
        $this->titulo = $titulo;
        $this->videojuego = $videojuego;
        $this->comentario = $comentario;
        $this->captura = $captura;
        $this->autor = $autor;
    }

    public function setVideojuego($videojuego): Review
    {
        $this->videojuego = $videojuego;
        return $this;
    }
    public function setTitulo($titulo): Review
    {
        $this->titulo = $titulo;
        return $this;
    }
    public function setComentario($comentario): Review
    {
        $this->comentario = $comentario;
        return $this;
    }
    public function setCaptura($captura): Review
    {
        $this->captura = $captura;
        return $this;
    }
    public function setAutor($autor): Review
    {
        $this->autor = $autor;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getVideojuego(): ?int
    { 
        return $this->videojuego;
    }
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function getComentario(): string
    {
        return $this->comentario;
    }
    public function getCaptura(): string
    {
        return $this->captura;
    }
    public function getAutor(): int
    {
        return $this->autor;
    }
    public function __toString()
    {
        return $this->getTitulo();
    }
    public function getUrlCaptura(): string
    {
        return self::RUTA_CAPTURA . $this->getCaptura();
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'videojuego' => $this->getVideojuego(),
            'titulo' => $this->getTitulo(),
            'comentario' => $this->getComentario(),
            'captura' => $this->getCaptura(),
            'autor' => $this->getAutor()
        ];
    }
}