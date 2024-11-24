<?php
namespace proyecto\app\repository;

use proyecto\app\entity\Juego;
use proyecto\app\entity\Plataforma;
use proyecto\core\App;
use proyecto\core\database\QueryBuilder;

class JuegosRepository extends QueryBuilder
{
    /**
     * @param string $tabla
     * @param string $classEntity
     */
    public function __construct(string $tabla = 'juegos', string $classEntity = Juego::class)
    {
        parent::__construct($tabla, $classEntity);
    }
    public function getPlataforma(Juego $juego): Plataforma
    {
        $plats = App::getRepository(PlataformasRepository::class);
        return $plats->find($juego->getPlataforma());
    }
}
