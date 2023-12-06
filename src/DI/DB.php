<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\DB\Adapter\Mysql;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;
use StoyanTodorov\Core\Services\DB\Migration\Migrator;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\RawQueryInterface;
use StoyanTodorov\Core\Services\DB\Query\RawQuery;

class DB extends Binder
{
    protected array $map = [
        [MigratorInterface::class, Migrator::class, [RawQueryInterface::class]],
        ['mysql', Mysql::class],
        [RawQueryInterface::class, RawQuery::class],
    ];
}