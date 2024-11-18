<?php
require_once __DIR__ . "/../entity/Juego.php";
require_once __DIR__ . "/../utils/File.php";
require_once __DIR__ . "/../exceptions/FileException.php";

$errores = [];
$titulo = "";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(Juego::RUTA_IMAGENES_JUEGOS);
        $mensaje = "Datos enviados";
    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
} else {
    $errores = [];
    $titulo = "";
    $mensaje = "";
}

require __DIR__ . '/../views/videojuegos.view.php';
