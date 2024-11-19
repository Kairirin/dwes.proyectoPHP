<?php
require_once __DIR__ . '/../entity/Plataforma.php';
require_once __DIR__ . '/../entity/Juego.php';
require_once __DIR__ . '/../repository/PlataformasRepository.php';

class JuegosRepository extends QueryBuilder
{
    /**
     * @param string $tabla
     * @param string $classEntity
     */
    public function __construct(string $tabla = 'juegos', string $classEntity = 'Juego')
    {
        parent::__construct($tabla, $classEntity);
    }
    public function getPlataforma(Juego $juego): Plataforma
    {
        $plats = new PlataformasRepository();
        return $plats->find($juego->getPlataforma());
    }
}
