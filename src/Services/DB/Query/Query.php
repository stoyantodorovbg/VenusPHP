<?php

namespace StoyanTodorov\Core\Services\DB\Query;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Adapter\DBAdapter;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\QueryInterface;

abstract class Query implements QueryInterface
{
    protected DBAdapter $adapter;

    public function __construct(protected string|null $connection = null) {
        if (! $this->connection) {
            $this->connection = config(DB::class, ['defaultConnection']);
        }
        $this->adapter = instance($this->connection);
    }

    public function changeConnection(string $connection): void
    {
        $this->connection = $connection;
        $this->adapter = instance($this->connection);
    }
}