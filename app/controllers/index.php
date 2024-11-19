<?php
require_once __DIR__ . "/../utils/Utils.php";
require_once __DIR__ . "/../../core/database/QueryBuilder.php";
require_once __DIR__ . "/../../core/database/Connection.php";
require_once __DIR__ . '/../repository/JuegosRepository.php';

$imagenesIndice = ["imagen1.png", "imagen2.png", "imagen3.png"];

try {
    $config = require_once __DIR__ . '/../config.php';
    App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios
    $conexion = App::getConnection();

    $juegosRepository = new JuegosRepository();
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
