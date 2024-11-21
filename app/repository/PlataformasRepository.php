<?php
namespace proyecto\app\repository;

use proyecto\app\entity\Plataforma;
use proyecto\core\database\QueryBuilder;

class PlataformasRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $tabla = 'plataformas', string $classEntity = Plataforma::class)
    {
        parent::__construct($tabla, $classEntity);
    }
}