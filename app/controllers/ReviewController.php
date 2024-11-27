<?php
namespace proyecto\app\controllers;

use proyecto\app\entity\Review;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\repository\ReviewsRepository;
use proyecto\app\utils\File;
use proyecto\core\App;
use proyecto\core\helpers\FlashMessage;

class ReviewController 
{
    public function nueva($id) 
    {
        try {
            $videojuego = App::getRepository(JuegosRepository::class)->find($id);
            $reviews = App::getRepository(ReviewsRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo', $titulo);
            $comentario = trim(htmlspecialchars($_POST['comentario']));
            FlashMessage::set('comentario', $comentario);
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $captura = new File('imagen', $tiposAceptados);
            $captura->saveUploadFile(Review::RUTA_CAPTURA);

            $nuevaReview = new Review($videojuego->getId(), $titulo, $comentario, $captura->getFileName(), App::get('appUser')->getId()); 
            $reviews->guarda($nuevaReview); 

            $mensaje = "El usuario " . App::get('appUser')->getUsername() . " ha mandado una review del juego " . $videojuego->getNombre();
            App::get('logger')->add($mensaje);
            FlashMessage::set('mensaje', $mensaje);

            FlashMessage::unset('titulo');
            FlashMessage::unset('comentario');
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        App::get('router')->redirect('videojuegos/'.$id);
    }

    public function borrar($id)
    {
        try 
        {
            $rev = App::getRepository(ReviewsRepository::class)->find($id);
            App::getRepository(ReviewsRepository::class)->delete($rev);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        App::get('router')->redirect('videojuegos');
    }
}