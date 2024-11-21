<?php

use proyecto\app\entity\Juego;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\PlataformaException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\utils\File;
use proyecto\core\App;

$errores = [];
$titulo = "";
$mensaje = "";

try {
    $conexion = App::getConnection();

    $juegosRepository = new JuegosRepository('juegosrevision', 'Juego');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $plataforma = trim(htmlspecialchars($_POST['plataforma']));
        if (empty($plataforma))
            throw new PlataformaException;
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(Juego::RUTA_IMAGENES_JUEGOS);

        /* $sql = "INSERT INTO juegosrevision (nombre, imagen, plataforma) VALUES (:nombre,:imagen,:plataforma)";
        $pdoStatement = $conexion->prepare($sql);
        $parametros = [
            ':nombre' => $titulo,
            ':imagen' => $imagen->getFileName(),
            ':plataforma' => $plataforma
        ];
        if ($pdoStatement->execute($parametros) === false)
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
        else
            $mensaje = "Se ha guardado la imagen correctamente"; */

        $nuevoJuego = new Juego($titulo, $imagen->getFileName(), $plataforma); //Aquí va la plataforma
        $juegosRepository->save($nuevoJuego); //No termina de ir
        App::get('logger')->add("Se ha guardado un juego a revisión: ".$nuevoJuego->getNombre());
        $mensaje = "Se ha guardado la información correctamente"; 

    } else {
        $errores = [];
        $titulo = "";
        $mensaje = "";
    }
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

App::get('router')->redirect('videojuegos');