<?php

namespace StoyanTodorov\Core\Console\Commands\Migrate;

use StoyanTodorov\Core\Console\Commands\Command;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;

abstract class Migrate extends Command
{
    protected string $nameSpace = 'migrate';
    protected array $instantiated = ['migrator' => MigratorInterface::class];
}