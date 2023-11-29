<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Adapter\DBAdapter;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigrationInterface;

abstract class Migration implements MigrationInterface
{
    protected int $version = 0;
    protected array $forwardQueries = [];
    protected array $backwardQueries = [];
    protected string $connection = '';
    protected DBAdapter $adapter;

    public function __construct()
    {
        if (! $this->connection) {
            $this->connection = config(DB::class, ['defaultConnection']);
        }
        $this->adapter = instance($this->connection);
    }

    public function forward(): void
    {
        $this->run('forwardQueries');
    }

    public function backward(): void
    {
        $this->run('backwardQueries');
    }

    protected function run(string $method): void
    {
        foreach ($this->$method() as $query) {
            $this->adapter->exec($query);
        }
    }

    protected function forwardQueries(): array
    {
        return $this->forwardQueries;
    }

    protected function backwardQueries(): array
    {
        return $this->backwardQueries;
    }
}