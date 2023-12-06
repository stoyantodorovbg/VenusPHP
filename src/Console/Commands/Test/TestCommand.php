<?php

namespace StoyanTodorov\Core\Console\Commands\Test;

use StoyanTodorov\Core\Console\Commands\Command;

class TestCommand extends Command
{
    protected string $nameSpace = 'test';
    protected string $name = 'command';
    protected string $description = 'Test command.';
    protected string $help = 'Just use it.';

    protected function handle(): int
    {
        return $this->success();
    }
}