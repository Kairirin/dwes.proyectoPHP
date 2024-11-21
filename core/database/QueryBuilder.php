<?php
namespace proyecto\core\database;

use PDO;
use PDOException;
use proyecto\app\entity\IEntity;
use proyecto\app\entity\Juego;
use proyecto\app\entity\Plataforma;
use proyecto\app\repository\JuegosRepository;
use proyecto\app\repository\PlataformasRepository;
use proyecto\app\exceptions\NotFoundException;
use proyecto\app\exceptions\QueryException;
use proyecto\core\App;

abstract class QueryBuilder
{
    /**
     * @var PDO
     */
    private $connection;
    private $tabla;
    private $classEntity;
    public function __construct(string $tabla, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->tabla = $tabla;
        $this->classEntity = $classEntity;
    }
    /**
     * @param IEntity $entity
     * @return void
     * @throws QueryException
     */
    public function save(IEntity $entity): void
    {
        try {
            $parametrers = $entity->toArray();
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->tabla,
                implode(', ', array_keys($parametrers)),
                ':' . implode(', :', array_keys($parametrers))
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parametrers);
        } catch (PDOException $exception) {
            throw new QueryException("Error al insertar en la base de datos.");
        }
    }
    /**
     * @param string $tabla
     * @param string $classEntity
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->tabla";
        return $this->executeQuery($sql);
    }
    /**
     * @param string $id
     * @return IEntity
     * @throws NotFoundException
     * @throws QueryException
     */
    public function find($cod): IEntity
    {
        if (gettype($cod) == 'string') {
            $sql = "SELECT * FROM $this->tabla WHERE codigo = \"$cod\"";
        } else {
            $sql = "SELECT * FROM $this->tabla WHERE codigo = $cod";
        }
        $result = $this->executeQuery($sql);
        if (empty($result))
            throw new NotFoundException("No se ha encontrado ningún elemento con código $cod.");
        return $result[0];
    }
    public function filter(string $plat): ?array
    {
        $sql = "SELECT * FROM $this->tabla WHERE plataforma LIKE \"$plat%\"";
        return $this->executeQuery($sql);
    }
    /**
     * @param string $sql
     * @return array
     * @throws QueryException
     */
    private function executeQuery(string $sql): array
    {
        $pdoStatement = $this->connection->prepare($sql);
        if ($pdoStatement->execute() === false)
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }
    public function executeTransaction(callable $fnExecuteQuerys)
    {
        try {
            $this->connection->beginTransaction();
            $fnExecuteQuerys(); // LLamamos a todas las consultas SQL de la transacción
            $this->connection->commit();
        } catch (PDOException $pdoException) {
            $this->connection->rollBack(); // Se deshacen todos los cambios desde beginTransaction()
            throw new QueryException("No se ha podido realizar la operación.");
        }
    }
}
