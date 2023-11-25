<?php

namespace StoyanTodorov\Core\Services\DB\Factory;

use StoyanTodorov\Core\Infrastructure\Interfaces\FactoryInterface;
use StoyanTodorov\Core\Services\DB\Connection\Mysql;
use StoyanTodorov\Core\Services\DB\Enum\DBDriver;

class ConnectionFactory implements FactoryInterface
{
    public function __construct(protected DBDriver $driver)
    {
    }

    public function create(): object
    {
        return match ($this->driver) {
            DBDriver::MYSQL => new Mysql(),
        };
    }
}