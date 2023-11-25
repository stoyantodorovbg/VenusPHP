<?php

namespace StoyanTodorov\Core\Services\ORM\Adapter;

use StoyanTodorov\Core\Services\DB\Connection\ConnectionInterface;
use StoyanTodorov\Core\Services\DB\Connector\DBConnector;
use StoyanTodorov\Core\Services\DB\Connector\DBConnectorInterface;
use StoyanTodorov\Core\Utilities\Singleton\SingletonInstanceInterface;

abstract class ORMAdapter
{
    protected DBConnectorInterface $dbConnector;
    protected string $connectionId;

    public function __construct(SingletonInstanceInterface $singletonInstance)
    {
        $this->dbConnector = $singletonInstance->instance(DBConnector::class);
    }

    public function changeConnection(string $id): void
    {
        $this->connectionId = $id;
    }

    protected function connect(): object
    {
        return $this->dbConnector->connect($this->connectionId);
    }
}