<?php

namespace proyecto\app\entity;

use proyecto\app\repository\JuegosRepository;

class Review implements IEntity
{
    private $id;
    private $videojuego;
    private $comentario;
    private $ruta_captura;
    private $autor;

    const RUTA_CAPTURA = '/public/img/capturasUsuarios/';

    public function __construct(int $videojuego = 0, string $comentario = "", string $ruta_captura = '', int $autor = 0)
    {
        $juegosRepository = App::getRepository(JuegosRepository::class);
        //Falta la llamada a repository de usuarios
        $this->id = null;
        $this->videojuego = $juegosRepository->$nombre; //Nueva función que recupere nombre
        $this->imagen = $imagen;
        $this->plataforma = $plataforma;
        $this->numReviews = $numReviews;
    }
}