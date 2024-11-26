<?php
namespace proyecto\app\repository;

use proyecto\app\entity\Juego;
use proyecto\app\entity\Review;
use proyecto\app\entity\Usuario;
use proyecto\core\App;
use proyecto\core\database\QueryBuilder;

class ReviewsRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $tabla = 'reviews', string $classEntity = Review::class)
    {
        parent::__construct($tabla, $classEntity);
    }
    public function getVideojuego(Review $rv): Juego
    {
        $juegos = App::getRepository(JuegosRepository::class);

        return $juegos->find($rv->getVideojuego());
    }
    public function getAutor(Review $rv): Usuario
    {
        $usuarios = App::getRepository(UsuariosRepository::class);

        return $usuarios->find($rv->getAutor());
    }

    public function guarda(Review $rev)
    {
        $fnGuardaReview = function () use ($rev) { // Creamos una función anónima que se llama como callable
            $juego = $this->getVideojuego($rev);
            $juegosRepository = App::getRepository(JuegosRepository::class);
            $juegosRepository->nuevaReview($juego);
            $this->save($rev);
        };
        $this->executeTransaction($fnGuardaReview); // Se pasa un callable
    }
}