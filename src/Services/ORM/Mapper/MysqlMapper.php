<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use Exception;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

abstract class MysqlMapper extends Mapper
{
    protected string $entity;
    protected string $table;
    protected string $primaryKey;

    public function __construct(string $entity, string|null $connection = null)
    {
        parent::__construct($entity, $connection);
        $this->table = $this->entity::table();
        $this->primaryKey = $this->entity::primaryKey();
    }

    public function findByPrimary(string|int $primary): EntityInterface
    {
        $queryData = [
            'select' => [
                'table' => $this->table,
            ],
            'where'  => [
                [$this->primaryKey, '='],
            ]
        ];
        $queryValues = [$primary];

        $raw = $this->adapter->query($queryData, $queryValues);

        return $this->getEntity($raw);
    }

    public function findOne(array $criteria, array|null $orderBy = null): EntityInterface
    {
        $query = $this->findQuery(criteria: $criteria, orderBy: $orderBy);
        $raw = $this->adapter->query($query['queryData'], $query['queryValues']);

        return $this->getEntity($raw);
    }

    public function findMany(
        array $criteria,
        array|null $orderBy = null,
        array|null $groupBy =  null,
        int|null $limit = null,
    ): array
    {
        $query = $this->findQuery($criteria, $orderBy, $groupBy, $limit);
        $raw = $this->adapter->query($query['queryData'], $query['queryValues']);

        return $this->getEntities($raw);
    }

    public function createOne(array $data, bool $save = true, bool $fetch = true): EntityInterface|null
    {
        if (! $save) {
            return $this->getEntity($data);
        }

        $queryData = [
            'insert' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
        ];

        $raw = $this->adapter->query($queryData, array_values($data));

        return $fetch ? $this->findByPrimary($raw) : null;
    }

    public function createMany(array $data, bool $save = true): array|null
    {
        if (! $save) {
            return $this->getEntities($data);
        }

        $queryData = [
            'insert' => [
                'table'   => $this->table,
                'columns' => $data['columns'],
            ],
        ];

        $this->adapter->query($queryData, $data['values']);
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

        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
            'where'  => [$this->primaryKey, '='],
        ];
        $queryValues = array_values($data);
        $queryValues[] = $primary;

        $this->adapter->query($queryData, $queryValues);

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

        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
            'where'  => [],
            'limit'  => 1
        ];
        $queryValues = array_values($data);
        $this->whereByCriteriaQuery($criteria, $queryData, $queryValues);

        $this->adapter->query($queryData, $queryValues);

        if ($fetch) {
            return $this->findOne($criteria);
        };
    }

    public function updateMany(array $criteria, $data, bool $save = true): array|null
    {
        if (! $save) {
            return array_map(fn($entity) => $this->updateEntityProperties($entity), $this->findMany($criteria));
        }

        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => $data['columns'],
            ],
            'where'  => [],
        ];
        $queryValues = $data['values'];
        $this->whereByCriteriaQuery($criteria, $queryData, $queryValues);

        $this->adapter->query($queryData, $queryValues);
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
        $queryData = [
            'delete' => [
                'table'   => $this->table,
            ],
            'where'  => [
                [$this->primaryKey, '='],
            ],
            'limit' => 1,
        ];
        $queryValues = [$primary];

        $this->adapter->query($queryData, $queryValues);
    }

    public function deleteOne(array $criteria): void
    {
        $this->deleteMany($criteria, 1);
    }

    public function deleteMany(array $criteria, int|null $limit = null): void
    {
        $queryData = [
            'delete' => [
                'table'   => $this->table,
            ],
            'where'  => [],
        ];
        if ($limit !== null) {
            $queryData['limit'] = $limit;
        }
        $queryValues = [];
        $this->whereByCriteriaQuery($criteria, $queryData, $queryValues);

        $this->adapter->query($queryData, $queryValues);
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
        $data = $this->converter->toEntity($raw, $this->entity);
        $entity = $this->entity;

        return new $entity(...$data);
    }

    protected function getEntities(array $raw): array
    {
        return $this->getEntities($raw);
    }

    protected function getRaw(EntityInterface $entity): array
    {
        return (array) $entity;
    }

    protected function findQuery(
        array $criteria,
        array|null $orderBy = null,
        array|null $groupBy =  null,
        int|null $limit = null,
    ): array
    {
        $queryData = [
            'select' => [
                'table' => $this->table,
            ],
            'where'   => [],
            'orderBy' => $orderBy,
            'groupBy' => $groupBy,
            'limit'   => $limit,
        ];
        $queryValues = [];
        $this->whereByCriteriaQuery($criteria, $queryData, $queryValues);

        return compact('queryData', 'queryValues');
    }

    protected function whereByCriteriaQuery(array $criteria, array &$queryData, array &$queryValues): void
    {
        foreach ($criteria as $filter) {
            $queryData['where'][] = [$filter[0], $filter[1]];
            $queryValues[] = $filter[2];
        }
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