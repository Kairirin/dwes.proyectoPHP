<?php

use proyecto\app\exceptions\AppException;
use proyecto\app\entity\Juego;
use proyecto\app\entity\Plataforma;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\utils\Utils;
use proyecto\core\App;

$imagenesIndice = ["imagen1.png", "imagen2.png", "imagen3.png"];

try {
    $conexion = App::getConnection();

    $juegosRepository = App::getRepository(JuegosRepository::class);

    $videojuegos = $juegosRepository->findAll();
    $totalJuegos = count($juegosRepository->findAll());
    //Falta lo mismo pero con el total de usuarios

    /* $videojuegos = []; */

    $lista = Utils::extraerTopFive($videojuegos);
    //La lista tiene que recuperarla de la base de datos
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}
//Obtener los cinco juegos con mejor categoria y guardarlos en una variable que luego utilizarmos en topfive

require __DIR__ . '/../views/index.view.php';
