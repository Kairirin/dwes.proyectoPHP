<?php
require_once __DIR__ . "/../entity/Juego.php";
require_once __DIR__ . "/../utils/File.php";
require_once __DIR__ . "/../exceptions/FileException.php";
require_once __DIR__ . "/../exceptions/QueryException.php";
require_once __DIR__ . "/../../core/database/Connection.php";
require_once __DIR__ . "/../../core/database/QueryBuilder.php";

$errores = [];
$titulo = "";
$mensaje = "";

try {
    $conexion = Connection::make();
    
    $queryBuilder = new QueryBuilder($conexion);
    $videojuegos = $queryBuilder->findAll('juegos', 'Juego');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(Juego::RUTA_IMAGENES_JUEGOS);

        $sql = "INSERT INTO juegosrevision (nombre, imagen, plataforma) VALUES (:nombre,:imagen,:plataforma)";
        $pdoStatement = $conexion->prepare($sql);
        $parametros = [
            ':nombre' => $titulo,
            ':imagen' => $imagen->getFileName(),
            ':plataforma' => 'ps'
        ];
        if ($pdoStatement->execute($parametros) === false)
            $errores[] = "No se ha podido guardar la información en la base de datos";
        else {
            $descripcion = "";
            $mensaje = "Se ha guardado la información correctamente";
        }

    } else {
        $errores = [];
        $titulo = "";
        $mensaje = "";
    }
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $fileException->getMessage();
}

require __DIR__ . '/../views/videojuegos.view.php';