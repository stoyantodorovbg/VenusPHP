<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use StoyanTodorov\Core\Services\ORM\Adapter\ORMAdapter;
use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

abstract class Mapper implements MapperInterface
{
    protected EntityConverterInterface $converter;
    protected ORMAdapter $adapter;

    public function __construct(protected string $entity, protected string|null $connection = null)
    {
        $this->converter = instance(EntityConverterInterface::class);
        $this->adapter = instance($this->connection ?? $entity::connection());
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