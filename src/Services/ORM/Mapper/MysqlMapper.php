<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use Exception;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

class MysqlMapper extends Mapper
{
    protected string $table;

    public function __construct(string $entity, string|null $connection = null)
    {
        parent::__construct($entity, $connection);
        $this->table = $this->entity::table();
    }

    public function findByPrimary(string|int $primary): EntityInterface
    {
        $raw = $this->preparedQuery->findByPrimary($primary);

        return $this->getEntity($raw);
    }

    public function findOne(array $criteria, array|null $orderBy = null): EntityInterface
    {
        $raw = $this->preparedQuery->findOne($criteria, $orderBy);

        return $this->getEntity($raw);
    }

    public function findMany(array $criteria, array|null $orderBy = null, array|null $groupBy = null, int|null $limit = null): array
    {
        $raw = $this->preparedQuery->findMany($criteria, $orderBy, $groupBy, $limit);

        return $this->getEntities($raw);
    }

    public function createOne(array $data, bool $save = true): EntityInterface
    {
        if ($save) {
            $data = $this->preparedQuery->createOne($data);
            $data = $data[array_key_first($data)];
        }

        return $this->getEntity($data);
    }

    public function createMany(array $data, bool $save = true): array|null
    {
        if (! $save) {
            return $this->getEntities($data);
        }

        $this->preparedQuery->createMany($data);
    }

    /**
     * @throws Exception
     */
    public function updateEntity(EntityInterface $entity, array $data, bool $save = true, bool $fetch = true): EntityInterface|null
    {
        if (! $save) {
            return $this->updateEntityProperties($entity, $data);
        }

        $primary = $entity->getProperty($this->primaryKey);
        $this->updateByPrimary($primary, $data);

        if ($fetch) {
            return $this->findByPrimary($primary);
        }
    }

    /**
     * @throws Exception
     */
    public function updateByPrimary(string|int $primary, array $data, bool $save = true, bool $fetch = true): EntityInterface|null
    {
        if (! $save) {
            return $this->updateEntityProperties($this->findByPrimary($primary), $data);
        }

        $this->preparedQuery->updateByPrimary($primary, $data);

        if ($fetch) {
            return $this->findByPrimary($primary);
        }
    }

    /**
     * @throws Exception
     */
    public function updateOne(array $criteria, array $data, bool $save = true, bool $fetch = true): EntityInterface|null
    {
        if (! $save) {
            return $this->updateEntityProperties($this->findOne($criteria), $data);
        }

        $this->preparedQuery->updateOne($criteria, $data);

        if ($fetch) {
            return $this->findOne($criteria);
        };
    }

    public function updateMany(array $criteria, $data, bool $save = true): array|null
    {
        if (! $save) {
            return array_map(fn($entity) => $this->updateEntityProperties($entity), $this->findMany($criteria));
        }

        $this->updateMany($criteria, $data);
    }

    /**
     * @throws Exception
     */
    public function deleteEntity(EntityInterface $entity): void
    {
        $this->deleteByPrimary($entity->getProperty($this->primaryKey));
    }

    public function deleteByPrimary(string|int $primary): void
    {
        $this->preparedQuery->deleteByPrimary($primary);
    }

    public function deleteOne(array $criteria): void
    {
        $this->deleteMany($criteria, 1);
    }

    public function deleteMany(array $criteria, int|null $limit = null): void
    {
        $this->preparedQuery->deleteMany($criteria, $limit);
    }

    /**
     * @throws Exception
     */
    public function updateOrCreate(array $criteria, array $data, bool $fetch = true): EntityInterface
    {
        if ($entity = $this->findOne($criteria)) {
            return $this->updateEntity($entity, $data, $fetch);
        }

        return $this->createOne($data, $fetch);
    }

    protected function getEntity(array $raw): EntityInterface
    {
        return $this->converter->toEntity($raw, $this->entity);
    }

    protected function getEntities(array $raw): array
    {
        return $this->getEntities($raw);
    }

    protected function getRaw(EntityInterface $entity): array
    {
        return (array) $entity;
    }

    /**
     * @throws Exception
     */
    protected function updateEntityProperties(EntityInterface $entity, array $data): EntityInterface
    {
        foreach($data as $column => $value) {
            $entity->setProperty($column, $value);
        }

        return $entity;
    }
}