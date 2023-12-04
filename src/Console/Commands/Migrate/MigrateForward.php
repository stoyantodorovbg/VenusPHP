<?php

namespace StoyanTodorov\Core\Console\Commands\Migrate;

use StoyanTodorov\Core\Console\Commands\Command;

class MigrateForward extends Migrate
{
    protected string $name = 'forward';
    protected string $description = 'Run forward migration method';
    protected string $help = 'No options needed';

    protected function handle(): int
    {
        $this->instantiated['migrator']->forward();

        return Command::SUCCESS;
    }
}