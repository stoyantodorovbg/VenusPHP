<?php

namespace StoyanTodorov\Core\Config;

use StoyanTodorov\Core\Console\Command\TestCommand;

class Console extends Config
{
    protected function data(): array
    {
        return [
            'commands' => [
                TestCommand::class
            ],
        ];
    }
}