<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigrationInterface;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\RawQueryInterface;

abstract class Migration implements MigrationInterface
{
    protected string $version;
    protected array $forwardQueries = [];
    protected array $backwardQueries = [];

    public function __construct(protected RawQueryInterface $query)
    {
    }

    public function forward(): void
    {
        $this->run('forwardQueries');
    }

    public function backward(): void
    {
        $this->run('backwardQueries');
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    protected function run(string $method): void
    {
        foreach ($this->$method() as $query) {
            $this->query->execute($query);
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