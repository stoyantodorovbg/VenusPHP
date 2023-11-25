<?php

namespace StoyanTodorov\Core\Services\DB\Connection;

interface ConnectionInterface
{
    /**
     * Get connection instance
     *
     * @param array $config
     * @return object
     */
    public function instance(array $config): object;
}