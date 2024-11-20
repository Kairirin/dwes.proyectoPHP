<?php
require_once __DIR__ . "/../entity/Juego.php";
require_once __DIR__ . "/../utils/File.php";
require_once __DIR__ . "/../exceptions/FileException.php";
require_once __DIR__ . "/../exceptions/QueryException.php";
require_once __DIR__ . "/../exceptions/PlataformaException.php";
require_once __DIR__ . "/../../core/database/Connection.php";
require_once __DIR__ . "/../../core/database/QueryBuilder.php";
require_once __DIR__ . '/../repository/JuegosRepository.php';
require_once __DIR__ . '/../repository/PlataformasRepository.php';

$errores = [];
$titulo = "";
$mensaje = "";

try {
    $conexion = App::getConnection();

    $juegosRepository = new JuegosRepository();
    $plataformaRepository = new PlataformasRepository();
    $plataformas = $plataformaRepository->findAll();
    $videojuegos = $juegosRepository->findAll();
    
} catch (PlataformaException) {
    $errores[] = "No se ha seleccionado una plataforma válida";
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    echo $nuevoJuego;
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}

require __DIR__ . '/../views/videojuegos.view.php';
