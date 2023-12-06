<?php

namespace StoyanTodorov\Core\Services\DB\Query\Interfaces;

interface QueryInterface
{
    /**
     * Change connection
     *
     * @param string $connection
     * @return void
     */
    public function changeConnection(string $connection): void;
}