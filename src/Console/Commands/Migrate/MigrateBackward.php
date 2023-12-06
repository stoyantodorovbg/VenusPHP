<?php

namespace StoyanTodorov\Core\Console\Commands\Migrate;

class MigrateBackward extends Migrate
{
    protected string $name = 'backward';
    protected string $description = 'Run backward migration method';

    protected function handle(): int
    {
        $this->instantiated['migrator']->backward();

        return $this->success();
    }
}