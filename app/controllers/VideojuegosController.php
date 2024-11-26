<?php

namespace proyecto\app\controllers;

use proyecto\core\helpers\FlashMessage;
use proyecto\app\entity\Juego;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\PlataformaException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\repository\PlataformasRepository;
use proyecto\app\repository\ReviewsRepository;
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
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        Response::renderView(
            'videojuegos',
            'layout',
            compact('h1Pagina', 'sobreTitulo', 'errores', 'titulo', 'mensaje', 'plataformas', 'juegosRepository', 'videojuegos', 'platSelec')
        );
    }
    public function nuevoJuego()
    {
        try {
            $conexion = App::getConnection();

            $juegosRepository = App::getRepository(JuegosRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo', $titulo);
            $plataforma = trim(htmlspecialchars($_POST['plataforma']));
            if (empty($plataforma))
                throw new PlataformaException;
            FlashMessage::set('platSelec', $plataforma);
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(Juego::RUTA_IMAGENES_JUEGOS);

            $nuevoJuego = new Juego($titulo, $imagen->getFileName(), $plataforma); 
            $juegosRepository->save($nuevoJuego); 

            $mensaje = "Se ha enviado el juego: " . $nuevoJuego->getNombre();
            App::get('logger')->add($mensaje);
            FlashMessage::set('mensaje', $mensaje);

            FlashMessage::unset('titulo');
            FlashMessage::unset('platSelec');
        } catch (PlataformaException) {
            $_SESSION['errores'][] = "No se ha seleccionado una plataforma válida";
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        App::get('router')->redirect('videojuegos');
    }
    public function filter()
    {
        $titulo = "";
        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $titulo = FlashMessage::get('titulo');
        $platSelec = FlashMessage::get('platSelec');
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
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        Response::renderView(
            'videojuegos',
            'layout',
            compact('h1Pagina', 'sobreTitulo', 'errores', 'titulo', 'mensaje', 'plataformas', 'juegosRepository', 'videojuegos')
        );
    }
    public function show($id)
    {
        $filter = [
            'videojuego' => $id,
        ];

        $juegosRepository = App::getRepository(JuegosRepository::class);
        $videojuego = $juegosRepository->find($id);

        $reviewsRepository = App::getRepository(ReviewsRepository::class);
        $reviews = $reviewsRepository->findBy($filter);

        Response::renderView(
            'game-show',
            'layout',
            compact('juegosRepository', 'videojuego', 'reviews', 'reviewsRepository')
        );
    }
}
