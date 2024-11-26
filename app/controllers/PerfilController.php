<?php

namespace proyecto\app\controllers;

use proyecto\app\entity\Usuario;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\ReviewsRepository;
use proyecto\app\repository\UsuariosRepository;
use proyecto\app\utils\File;
use proyecto\core\App;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\Response;

class PerfilController
{
    /**
     * @throws QueryException
     */
    public function index($id)
    {
        $user = App::get('appUser');
        $reviewsRep = App::getRepository(ReviewsRepository::class);
        $reviews = $reviewsRep->findBy(['autor' => $user->getId()]);
        
        Response::renderView(
            'perfil',
            'layout',
            compact ('user', 'reviews', 'reviewsRep')
            );
    }

    public function modif($id)
    {
        try {
            $usuariosRep = App::getRepository(UsuariosRepository::class);
            $user = App::get('appUser');
            
            $username = trim(htmlspecialchars($_POST['username'])) ?? '';
            FlashMessage::set('username', $username);
            $password = trim(htmlspecialchars($_POST['password'])) ?? '';
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            if (isset($_FILES["avatar"])){
                $avatar = new File('avatar', $tiposAceptados);
                $avatar->saveUploadFile(Usuario::RUTA_AVATAR);
                $user->setAvatar($avatar->getFileName());
            }

            if(!empty($username))
                $user->setUsername($username);
            if(!empty($password))
                $user->setPassword($password);

            $usuariosRep->update($user);

            $mensaje = "Se ha actualizado el perfil";
            FlashMessage::set('mensaje', $mensaje);

            FlashMessage::unset('username');
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        App::get('router')->redirect('perfil/'.$id);
    }
}
