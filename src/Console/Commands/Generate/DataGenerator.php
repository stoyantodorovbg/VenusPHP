<?php

namespace StoyanTodorov\Core\Console\Commands\Generate;

use StoyanTodorov\Core\Console\Commands\Command;
use StoyanTodorov\Core\Services\DataGenerator\DataGeneratorService;

class DataGenerator extends Command
{
    protected string $nameSpace = 'generate';
    protected string $name = 'data';
    protected string $description = 'Run the configured data generators';
    protected array $instantiated = ['generator' => DataGeneratorService::class];

    protected function handle(): int
    {
        $this->instantiated['generator']->run();

        return $this->success();
    }
}