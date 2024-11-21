<?php

use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\PlataformaException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\repository\PlataformasRepository;
use proyecto\core\App;

$errores = [];
$titulo = "";
$mensaje = "";

try {
    $conexion = App::getConnection();

    $plataformas = App::getRepository(PlataformasRepository::class)->findAll();
    $juegosRepository = App::getRepository(JuegosRepository::class);
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
