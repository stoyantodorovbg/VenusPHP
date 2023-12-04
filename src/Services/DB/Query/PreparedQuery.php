<?php

namespace StoyanTodorov\Core\Services\DB\Query;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Adapter\DBAdapter;

class PreparedQuery implements PreparedQueryInterface
{
    protected DBAdapter $adapter;
    
    public function __construct(
        protected string $connection,
        protected string $table,
        protected string $primaryKey = 'id',
    ) {
        if (! $this->connection) {
            $this->connection = config(DB::class, ['defaultConnection']);
        }
        $this->adapter = instance($this->connection);
    }

    public function findByPrimary(string|int $primary): array
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

        return $this->adapter->preparedQuery($queryData, $queryValues);
    }

    public function findOne(array $criteria, array|null $orderBy = null): array
    {
        $query = $this->findQuery(criteria: $criteria, orderBy: $orderBy);

        return $this->adapter->preparedQuery($query['queryData'], $query['queryValues']);
    }

    public function findMany(array $criteria, array|null $orderBy = null, array|null $groupBy = null, int|null $limit = null): array
    {
        $query = $this->findQuery($criteria, $orderBy, $groupBy, $limit);

        return $this->adapter->preparedQuery($query['queryData'], $query['queryValues']);
    }

    public function createOne(array $data, bool $fetch = true): array|null
    {
        $queryData = [
            'insert' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
        ];

        $raw = $this->adapter->preparedQuery($queryData, array_values($data));

        return $fetch ? $this->findByPrimary($raw) : null;
    }

    public function createMany(array $data): array|null
    {
        $queryData = [
            'insert' => [
                'table'   => $this->table,
                'columns' => $data['columns'],
            ],
        ];

        $this->adapter->preparedQuery($queryData, $data['values']);
    }

    public function updateByPrimary(string|int $primary, array $data, bool $fetch = true): array|null
    {
        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
            'where'  => [$this->primaryKey, '='],
        ];
        $queryValues = array_values($data);
        $queryValues[] = $primary;

        $this->adapter->preparedQuery($queryData, $queryValues);

        if ($fetch) {
            return $this->findByPrimary($primary);
        }
    }

    public function updateOne(array $criteria, array $data, bool $fetch = true): array|null
    {
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

        $this->adapter->preparedQuery($queryData, $queryValues);

        if ($fetch) {
            return $this->findOne($criteria);
        };
    }

    public function updateMany(array $criteria, $data): null
    {
        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => $data['columns'],
            ],
            'where'  => [],
        ];
        $queryValues = $data['values'];
        $this->whereByCriteriaQuery($criteria, $queryData, $queryValues);

        $this->adapter->preparedQuery($queryData, $queryValues);
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

        $this->adapter->preparedQuery($queryData, $queryValues);
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

        $this->adapter->preparedQuery($queryData, $queryValues);
    }

    public function updateOrCreate(array $criteria, array $data, bool $fetch = true): array
    {
        if ($raw = $this->findOne($criteria)) {
            return $this->updateByPrimary($raw[$this->primaryKey], $data, $fetch);
        }

        return $this->createOne($data, $fetch);
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
}