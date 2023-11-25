<?php

namespace StoyanTodorov\Core\Services\ORM\Adapter;

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

    /**
     * Initialize a query
     *
     * @return object
     */
    abstract public function getQuery(): object;

    /**
     * Where query
     *
     * @param object $query
     * @param array  $criteria
     * @return object
     */
    abstract public function where(object $query, array $criteria): object;

    /**
     * Order by query
     *
     * @param object $query
     * @param array  $orderBy
     * @return object
     */
    abstract public function orderBy(object $query, array $orderBy): object;

    /**
     * Limit query
     *
     * @param object $query
     * @param int    $limit
     * @return object
     */
    abstract public function limit(object $query, int $limit): object;

    /**
     * Group by query
     *
     * @param object $query
     * @param string $groupBy
     * @return object
     */
    abstract public function groupBy(object $query, string $groupBy): object;

    /**
     * Create query
     *
     * @param object $query
     * @param array  $data
     * @return object
     */
    abstract public function create(object $query, array $data): object;

    /**
     * Update query
     *
     * @param object $query
     * @param array  $data
     * @return object
     */
    abstract public function update(object $query, array $data): object;

    /**
     * Delete query
     *
     * @param object $query
     * @return object
     */
    abstract public function delete(object $query): object;

    /**
     * Execute a query
     *
     * @param object $query
     * @return array|null
     */
    abstract public function execute(object $query): array|null;

    public function changeConnection(string $id): void
    {
        $this->connectionId = $id;
    }

    protected function connect(): object
    {
        return $this->dbConnector->connect($this->connectionId);
    }
}