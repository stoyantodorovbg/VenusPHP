<?php

namespace StoyanTodorov\Core\Services\ORM\Adapter;

class Mysql
{
    protected string $connectionId = 'mysql';

    public function getQuery(): object
    {

    }

    public function where(object $query, array $criteria): object
    {

    }

    public function orderBy(object $query, array $orderBy): object
    {

    }

    public function limit(object $query, int $limit): object
    {

    }

    public function groupBy(object $query, string $groupBy): object
    {

    }

    public function create(object $query, array $data): object
    {

    }

    public function update(object $query, array $data): object
    {

    }

    public function delete(object $query): object
    {

    }

    public function execute(object $query): array|null
    {

    }
}