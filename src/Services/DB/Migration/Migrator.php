<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;

class Migrator implements MigratorInterface
{
    public function forward(): void
    {
        foreach (config(DB::class, ['migrations']) as $migration) {
            instance($migration)->forward();
        }
    }

    public function backward(): void
    {
        foreach (config(DB::class, ['migrations']) as $migration) {
            instance($migration)->backward();
        }
    }
}