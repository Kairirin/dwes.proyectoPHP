<?php

namespace proyecto\app\controllers;

use proyecto\app\exceptions\AppException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\utils\Utils;
use proyecto\core\App;
use proyecto\core\Response;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $imagenesIndice = ["imagen1.png", "imagen2.png", "imagen3.png"];

        try {
            $conexion = App::getConnection();

            $juegosRepository = App::getRepository(JuegosRepository::class);

            $videojuegos = $juegosRepository->findAll();
            $totalJuegos = count($juegosRepository->findAll());
            //Falta lo mismo pero con el total de usuarios

            $lista = Utils::extraerTopFive($videojuegos);
            //La lista tiene que recuperarla de la base de datos
        } catch (AppException $appException) {
            $_SESSION['errores'][] = $appException->getMessage();
        }
        //Obtener los cinco juegos con mejor categoria y guardarlos en una variable que luego utilizarmos en topfive
        Response::renderView(
            'index',
            'layout',
            compact ( 'imagenesIndice','videojuegos','totalJuegos','lista', 'juegosRepository')
            );
    }
    public function about()
    {
        Response::renderView(
            'about',
            'layout',
            );
    }
    public function contacto()
    {
        Response::renderView(
            'contacto',
            'layout',
            );
    }
}
