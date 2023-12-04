<?php

namespace StoyanTodorov\Core\Services\DB\Connection;

abstract class Connection
{
    protected object|null $instance = null;

    /**
     * Get connection instance
     *
     * @param array $config
     * @return object
     */
    public function instance(array $config): object
    {
        if (! $this->instance) {
            $this->instantiate($config);
        }

        return $this->instance;
    }

    /**
     * Instantiate connection
     *
     * @param array $config
     * @return void
     */
    abstract protected function instantiate(array $config): void;
}