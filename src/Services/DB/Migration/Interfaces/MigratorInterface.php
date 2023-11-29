<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Interfaces;

interface MigratorInterface
{
    /**
     * Run forward
     *
     * @return void
     */
    public function migrate(): void;

    /**
     * Run backward
     *
     * @return void
     */
    public function rollback(): void;
}