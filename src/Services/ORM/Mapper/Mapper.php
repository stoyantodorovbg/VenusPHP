<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

abstract class Mapper
{
    protected string $entity;

    public function __construct(protected EntityConverterInterface $entityConverter)
    {
    }

    protected function getEntity(array $raw): EntityInterface
    {
        $data = $this->entityConverter->toEntity($raw, $this->entity);
        $entity = $this->entity;

        return new $entity(...$data);
    }

    protected function getRaw(EntityInterface $entity): array
    {
        return (array) $entity;
    }
}