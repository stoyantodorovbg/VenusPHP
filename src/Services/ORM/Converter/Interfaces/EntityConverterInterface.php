<?php

namespace StoyanTodorov\Core\Services\ORM\Converter\Interfaces;

use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

interface EntityConverterInterface
{
    /**
     * Convert raw data to an entity
     *
     * @param array  $data
     * @param string $entityClass
     * @return EntityInterface
     */
    public function toEntity(array $data, string $entityClass): EntityInterface;

    /**
     * Convert an entity to raw data
     *
     * @param EntityInterface $entity
     * @param string          $entityClass
     * @return array
     */
    public function toRaw(EntityInterface $entity, string $entityClass): array;
}