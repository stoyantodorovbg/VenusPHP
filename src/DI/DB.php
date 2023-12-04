<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\DB\Adapter\Mysql;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;
use StoyanTodorov\Core\Services\DB\Migration\Migrator;

class DB extends Binder
{
    protected array $map = [
        [MigratorInterface::class, Migrator::class],
        ['mysql', Mysql::class],
    ];
}