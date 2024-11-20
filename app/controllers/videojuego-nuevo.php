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