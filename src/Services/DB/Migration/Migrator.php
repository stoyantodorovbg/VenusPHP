<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;

class Migrator implements MigratorInterface
{
    public function migrate(): void
    {
        foreach (config(DB::class, ['migrations']) as $migration) {
            instance($migration)->forward();
        }
    }

    public function rollback(): void
    {
        foreach (config(DB::class, ['migrations']) as $migration) {
            instance($migration)->backward();
        }
    }
}