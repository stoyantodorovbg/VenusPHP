<?php

namespace StoyanTodorov\Core\Config;

use StoyanTodorov\Core\Console\Commands\Generate\DataGenerator;
use StoyanTodorov\Core\Console\Commands\Migrate\MigrateBackward;
use StoyanTodorov\Core\Console\Commands\Migrate\MigrateForward;
use StoyanTodorov\Core\Console\Commands\Test\TestCommand;

class Console extends Config
{
    protected function data(): array
    {
        return [
            'commands' => [
                TestCommand::class,
                MigrateForward::class,
                MigrateBackward::class,
                DataGenerator::class,
            ],
        ];
    }
}