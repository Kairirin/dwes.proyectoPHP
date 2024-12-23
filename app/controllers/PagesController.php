<?php

namespace proyecto\app\controllers;

use proyecto\app\repository\UsuariosRepository;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\exceptions\AppException;
use proyecto\app\utils\Utils;
use proyecto\core\Response;
use proyecto\core\App;

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
            
            $totalUsuarios = count(App::getRepository(UsuariosRepository::class)->findAll());

            $lista = Utils::extraerTopFive($videojuegos);
        } catch (AppException $appException) {
            $_SESSION['errores'][] = $appException->getMessage();
        }
        //Obtener los cinco juegos con mejor categoria y guardarlos en una variable que luego utilizarmos en topfive
        Response::renderView(
            'index',
            'layout',
            compact ( 'imagenesIndice','videojuegos','totalJuegos','lista', 'juegosRepository', 'totalUsuarios')
            );
    }
    public function about()
    {
        Response::renderView(
            'about',
            'layout',
            );
    }
}
