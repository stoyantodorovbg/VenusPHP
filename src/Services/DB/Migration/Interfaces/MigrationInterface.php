<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Interfaces;

interface MigrationInterface
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

    /**
     * Get migration version
     *
     * @return string
     */
    public function getVersion(): string;
}