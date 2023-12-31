<?php

namespace StoyanTodorov\Core\Services\DB\Query;

use StoyanTodorov\Core\Services\DB\Adapter\DBAdapter;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\PreparedQueryInterface;

class PreparedQuery extends Query implements PreparedQueryInterface
{
    protected DBAdapter $adapter;
    
    public function __construct(
        protected string|null $connection,
        protected string $table,
        protected string $primaryKey = 'id',
    ) {
        parent::__construct($connection);
    }

    public function findByPrimary(string|int $primary, array $columns = []): array
    {
        return $this->findOne(criteria: [[$this->primaryKey, '=', $primary]], columns: $columns);
    }

    public function findOne(array $criteria = [], array $orderBy = [], array $columns = []): array
    {
        return $this->find(criteria: $criteria, orderBy: $orderBy, limit: 1, columns: $columns);
    }

    public function find(array $criteria, array $orderBy = [], array $groupBy = [], int|null $limit = null, array $columns = []): array
    {
        $query = $this->findQuery($criteria, $orderBy, $groupBy, $limit);

        return $this->adapter->preparedQuery($query['queryData'], $query['queryValues']);
    }

    public function createOne(array $data, bool $fetch = true): array|null
    {
        $queryData = [
            'insert' => [
                'table' => $this->table,
                'data'  => $data,
            ],
        ];

        $raw = $this->adapter->preparedQuery($queryData, array_values($data));

        if ($fetch) {
            return $this->findByPrimary($raw);
        }
    }

    public function createMany(array $data): void
    {
        $queryData = [
            'insert' => [
                'table'   => $this->table,
                'data' => $data,
            ],
        ];

        $this->adapter->preparedQuery($queryData, array_values($data));
    }

    public function updateByPrimary(string|int $primary, array $data, bool $fetch = true): array|null
    {
        return $this->updateOne(criteria: [[$this->primaryKey, '=', $primary]], data: $data, fetch: $fetch);
    }

    public function updateOne(array $criteria, array $data, bool $fetch = true): array|null
    {
        $queryValues = array_values($data);
        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => array_keys($data),
            ],
            'where'  => [$this->whereQuery($criteria, $queryValues)],
            'limit'  => $this->limitQuery(1, $queryValues),
        ];

        $this->adapter->preparedQuery($queryData, $queryValues);

        if ($fetch) {
            return $this->findOne($criteria);
        };
    }

    public function updateMany(array $criteria, $data): null
    {
        $queryValues = $data['values'];
        $queryData = [
            'update' => [
                'table'   => $this->table,
                'columns' => $data['columns'],
            ],
            'where'  => [$this->whereQuery($criteria, $queryValues)],
        ];

        $this->adapter->preparedQuery($queryData, $queryValues);
    }

    public function deleteByPrimary(string|int $primary): void
    {
        $queryValues = [$primary];
        $queryData = [
            'delete' => ['table'   => $this->table,],
            'where'  => [$this->whereQuery([[$this->primaryKey, '=', $primary]], $queryValues)],
            'limit' => $this->limitQuery(1, $queryValues),
        ];

        $this->adapter->preparedQuery($queryData, $queryValues);
    }

    public function deleteOne(array $criteria): void
    {
        $this->deleteMany($criteria, 1);
    }

    public function deleteMany(array $criteria, int|null $limit = null): void
    {
        $queryValues = [];
        $queryData = [
            'delete' => ['table'   => $this->table],
            'where'  => [$this->whereQuery($criteria, $queryValues)],
        ];
        if ($limit !== null) {
            $queryData['limit'] = $this->limitQuery($limit, $queryValues);
        }

        $this->adapter->preparedQuery($queryData, $queryValues);
    }

    public function updateOrCreate(array $criteria, array $data, bool $fetch = true): array
    {
        if ($raw = $this->findOne($criteria)) {
            return $this->updateByPrimary($raw[$this->primaryKey], $data, $fetch);
        }

        return $this->createOne($data, $fetch);
    }

    public function count(array $criteria): int
    {
        $queryValues = [];
        $queryData = [
            'count' => ['table' => $this->table],
            'where' => [$this->whereQuery($criteria, $queryValues)],
        ];

        return $this->adapter->preparedQuery($queryData, $queryValues)[0]['count'];
    }

    protected function findQuery(
        array $criteria,
        array $orderBy = [],
        array $groupBy = [],
        int|null $limit = null,
        array $columns = [],
    ): array
    {
        $queryValues = [];
        $queryData = ['select' => ['table' => $this->table, 'columns' => $columns]];

        if ($criteria) {
            $queryData['where'] = [$this->whereQuery($criteria, $queryValues)];
        }

        if ($orderBy) {
            $queryData['orderBy'] = [$this->orderByQuery($orderBy)];
        }

//        if ($groupBy) {
//            $queryData['groupBy'] = [$groupBy];
//        }

        if ($limit) {
            $queryData['limit'] = $this->limitQuery($limit, $queryValues);
        }

        return compact('queryData', 'queryValues');
    }

    protected function whereQuery(array $criteria, array &$queryValues): array
    {
        $output = [];
        foreach ($criteria as $filter) {
            $output[] = [$filter[0], $filter[1]];
            $queryValues[] = $filter[2];
        }

        return $output;
    }

    protected function orderByQuery(array $orderBy): array
    {
        $output = [];
        foreach ($orderBy as $filter) {
            $output[] = [$filter[0], $filter[1]];
        }

        return $output;
    }

    protected function limitQuery(int $limit, array &$queryValues): array
    {
        $queryValues[] = $limit;

        return [[]];
    }
}