<?php
class PlataformasRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'plataformas', string $classEntity = 'Plataforma')
    {
        parent::__construct($table, $classEntity);
    }
}