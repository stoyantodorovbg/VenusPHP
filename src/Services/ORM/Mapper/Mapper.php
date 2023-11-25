<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use StoyanTodorov\Core\Services\ORM\Adapter\ORMAdapter;
use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

abstract class Mapper
{
    protected string $entity;

    public function __construct(
        protected EntityConverterInterface $entityConverter,
        protected ORMAdapter $adapter,
    )
    {
    }

    public function findByPrimary(string|int $primary): EntityInterface
    {

    }

    public function findOne(array $criteria, array|null $orderBy = null): EntityInterface
    {

    }

    public function findMany(
        array $criteria,
        array|null $orderBy = null,
        int|null $limit = null,
        string|null $groupBy =  null
    ): array
    {

    }

    public function createOne(array $data, bool $save = true): EntityInterface
    {

    }

    public function createMany(array $data, bool $save = true): array
    {

    }

    public function updateEntity(EntityInterface $entity, array $data, bool $save = true): EntityInterface
    {

    }

    public function updateEntities(array $entities, array $data, bool $save = true): array
    {

    }

    public function updateByPrimary(string|int $primary, array $data, bool $save = true): EntityInterface
    {

    }

    public function updateOne(array $criteria, array $data, bool $save = true): EntityInterface
    {

    }

    public function updateMany(array $criteria, $data, bool $save = true): array
    {

    }

    public function deleteEntity(EntityInterface $entity): void
    {

    }

    public function deleteByPrimary(string|int $primary): void
    {

    }

    public function deleteOne(array $criteria): void
    {

    }

    public function deleteMany(array $criteria): void
    {

    }

    public function updateOrCreate(array $criteria, array $data, bool $save = true): EntityInterface
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