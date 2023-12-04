<?php

namespace StoyanTodorov\Core\Console\Commands\Migrate;

use StoyanTodorov\Core\Console\Commands\Command;

class MigrateBackward extends Migrate
{
    protected string $name = 'backward';
    protected string $description = 'Run backward migration method';
    protected string $help = 'No options needed';

    protected function handle(): int
    {
        $this->instantiated['migrator']->backward();

        return Command::SUCCESS;    }
}