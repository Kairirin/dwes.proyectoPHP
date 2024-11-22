<?php
namespace proyecto\app\repository;

use proyecto\app\entity\Usuario;
use proyecto\core\database\QueryBuilder;

class UsuariosRepository extends QueryBuilder
{
    public function __construct(string $tabla = 'usuarios', string $classEntity = Usuario::class)
    {
        parent::__construct($tabla, $classEntity);
    }
}