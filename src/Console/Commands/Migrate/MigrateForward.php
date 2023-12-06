<?php

namespace StoyanTodorov\Core\Console\Commands\Migrate;

class MigrateForward extends Migrate
{
    protected string $name = 'forward';
    protected string $description = 'Run forward migration method';

    protected function handle(): int
    {
        $this->instantiated['migrator']->forward();

        return $this->success();
    }
}