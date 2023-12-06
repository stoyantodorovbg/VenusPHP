<?php

namespace StoyanTodorov\Core\Services\DB\Adapter;

use StoyanTodorov\Core\Services\DB\Connector\DBConnector;
use StoyanTodorov\Core\Services\DB\Connector\DBConnectorInterface;
use StoyanTodorov\Core\Utilities\Singleton\SingletonInstanceInterface;

abstract class DBAdapter
{
    protected DBConnectorInterface $dbConnector;
    protected string $connectionId;

    public function __construct()
    {
        $this->dbConnector = instance(SingletonInstanceInterface::class)->instance(DBConnector::class);
    }

    public function changeConnection(string $id): void
    {
        $this->connectionId = $id;
    }

    protected function connect(): object
    {
        return $this->dbConnector->connect($this->connectionId);
    }

    /**
     * Prepare a query
     *
     * @param array $data
     * @return string
     */
    abstract protected function prepareQuery(array $data): string;
}