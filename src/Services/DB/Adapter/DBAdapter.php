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

    /**
     * Execute a query
     *
     * @param array $data
     * @param array $values
     * @return array|int|string|null
     */
    abstract public function query(array $data, array $values): array|int|string|null;

    public function changeConnection(string $id): void
    {
        $this->connectionId = $id;
    }

    protected function connect(): object
    {
        return $this->dbConnector->connect($this->connectionId);
    }

    /**
     * Execute a query
     *
     * @param object $connection
     * @param array  $values
     * @return array|null
     */
    abstract protected function execute(object $connection, array $values): array|null;

    /**
     * Prepare a query
     *
     * @param array $data
     * @return string
     */
    abstract protected function prepareQuery(array $data): string;
}