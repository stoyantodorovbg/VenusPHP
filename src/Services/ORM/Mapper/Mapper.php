<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use StoyanTodorov\Core\Services\DB\Query\Interfaces\PreparedQueryInterface;
use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

abstract class Mapper implements MapperInterface
{
    protected string $primaryKey;
    protected EntityConverterInterface $converter;
    protected PreparedQueryInterface $preparedQuery;

    public function __construct(protected string $entity, protected string|null $connection = null)
    {
        $this->primaryKey = $entity::primaryKey();
        $this->converter = instance(EntityConverterInterface::class);
        $this->preparedQuery = instanceWithCustomParams(PreparedQueryInterface::class, [
            $this->connection ?? $entity::connection(),
            $entity::table(),
        ]);
    }
    
    /**
     * Create an entity from raw data
     *
     * @param array $raw
     * @return EntityInterface
     */
    abstract protected function getEntity(array $raw): EntityInterface;

    /**
     * Create an array that contains entities from raw data
     *
     * @param array $raw
     * @return array
     */
    abstract protected function getEntities(array $raw): array;

    /**
     * Convert an entity to array
     *
     * @param EntityInterface $entity
     * @return array
     */
    abstract protected function getRaw(EntityInterface $entity): array;
}