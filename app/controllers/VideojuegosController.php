<?php

namespace proyecto\app\controllers;

use dwes\core\helpers\FlashMessage;
use proyecto\app\entity\Juego;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\PlataformaException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\repository\PlataformasRepository;
use proyecto\app\utils\File;
use proyecto\core\App;
use proyecto\core\Request;
use proyecto\core\Response;

class VideojuegosController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $h1Pagina = "Explora sin límites";
        $sobreTitulo = "¿Lo buscas todo? Aquí lo tienes";

        $titulo = "";
        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $titulo = FlashMessage::get('titulo');
        $platSelec = FlashMessage::get('platSelec');

        try {
            $conexion = App::getConnection();

            $plataformas = App::getRepository(PlataformasRepository::class)->findAll();
            $juegosRepository = App::getRepository(JuegosRepository::class);
            $videojuegos = $juegosRepository->findAll();
        } catch (FileException $fileException) {
            FlashMessage::set('errores' , [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores' , [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores' , [$appException->getMessage()]);
        }

        Response::renderView(
            'videojuegos',
            'layout',
            compact('h1Pagina', 'sobreTitulo', 'errores', 'titulo', 'mensaje', 'plataformas', 'juegosRepository', 'videojuegos')
        );
    }
    public function nuevoJuego()
    {
        try {
            $conexion = App::getConnection();

            $juegosRepository = new JuegosRepository('juegosrevision', 'Juego');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $titulo = trim(htmlspecialchars($_POST['titulo']));
                $_SESSION['titulo']= $titulo;
                $plataforma = trim(htmlspecialchars($_POST['plataforma']));
                if (empty($plataforma))
                    throw new PlataformaException;
                $_SESSION['platSelec'] = $plataforma;
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
                App::get('logger')->add("Se ha guardado un juego a revisión: " . $nuevoJuego->getNombre());
                $_SESSION['mensaje'] = "Se ha guardado la imagen correctamente";

                FlashMessage::unset('titulo');
                FlashMessage::unset('platSelec');
            } else {
                $errores = [];
                $titulo = "";
            }
        } catch (PlataformaException) {
            $_SESSION['errores'][] = "No se ha seleccionado una plataforma válida";
        } catch (FileException $fileException) {
            FlashMessage::set('errores' , [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores' , [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores' , [$appException->getMessage()]);
        }

        App::get('router')->redirect('videojuegos');
    }
    public function filter()
    {
        $titulo = "";
        $errores = $_SESSION['errores'] ?? [];
        $mensaje = $_SESSION['mensaje'] ?? '';
        unset($_SESSION['errores']);
        unset($_SESSION['mensaje']);
        $uri = Request::uri();
        $filtro = "";

        $h1Pagina = "Explora " . $uri;
        $sobreTitulo = "¿Buscas algo en concreto? Aquí lo tienes";

        try {
            $conexion = App::getConnection();

            switch ($uri) {
                case 'playstation':
                    $filtro = 'ps';
                    break;
                case 'xbox':
                    $filtro = 'xb';
                    break;
                case 'nintendo':
                    $filtro = 'sw';
                    break;
                case 'retro':
                    $filtro = 'rt';
                    break;
                default:
                    App::get('router')->redirect('videojuegos');
                    break;
            }

            $plataformas = App::getRepository(PlataformasRepository::class)->findAll();
            $juegosRepository = App::getRepository(JuegosRepository::class);
            $videojuegos = $juegosRepository->filter($filtro);
        } catch (FileException $fileException) {
            FlashMessage::set('errores' , [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores' , [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores' , [$appException->getMessage()]);
        }

        Response::renderView(
            'videojuegos',
            'layout',
            compact('h1Pagina', 'sobreTitulo', 'errores', 'titulo', 'mensaje', 'plataformas', 'juegosRepository', 'videojuegos')
        );
    }
    public function show($id)
    {
        $juegosRepository = App::getRepository(JuegosRepository::class);
        $videojuego = $juegosRepository->find($id);
        Response::renderView(
            'game-show',
            'layout',
            compact('juegosRepository', 'videojuego')
        );
    }
}
