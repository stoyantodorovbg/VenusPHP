<?php

namespace StoyanTodorov\Core\Services\DB\Connector;

use StoyanTodorov\Core\Services\DB\Connection\Connection;

interface DBConnectorInterface
{
    /**
     * Create new connection or return already created connection with the same ID
     *
     * @param string $id
     * @return object
     */
    public function connect(string $id): object;
}