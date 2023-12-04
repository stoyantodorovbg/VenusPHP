<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Interfaces;

interface MigratorInterface
{
    /**
     * Run forward
     *
     * @return void
     */
    public function forward(): void;

    /**
     * Run backward
     *
     * @return void
     */
    public function backward(): void;
}