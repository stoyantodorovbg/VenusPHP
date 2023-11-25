<?php

namespace StoyanTodorov\Core\Services\DB\Connector;

use StoyanTodorov\Core\Services\DB\Connection\ConnectionInterface;
use StoyanTodorov\Core\Services\DB\Factory\ConnectionFactory;
use StoyanTodorov\Core\Utilities\Singleton\Singleton;

class DBConnector implements DBConnectorInterface
{
    use Singleton;

    private array $connections = [];

    public function connect(string $id): object
    {
        if (! isset($this->connections[$id])) {
            $this->createConnection($id);
        }

        return $this->connections[$id];
    }

    private function createConnection(string $id): void
    {
        $config = config('db-conf', [$id]);

        $this->connections[$id] = instance(ConnectionFactory::class)->create($config['driver'])->instance($config);
    }
}