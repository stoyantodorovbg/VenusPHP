<?php

namespace StoyanTodorov\Core\Kernel;

use StoyanTodorov\Core\Config\Console;
use StoyanTodorov\Core\DI\Config;
use StoyanTodorov\Core\DI\Core;
use StoyanTodorov\Core\DI\DB;
use StoyanTodorov\Core\Interfaces\SingletonInterface;
use StoyanTodorov\Core\Utilities\Singleton\Singleton;
use Symfony\Component\Console\Application;

class ConsoleKernel extends Kernel implements SingletonInterface
{
    use Singleton;

    protected string $mode = 'console';
    protected array $binders = [
        Core::class,
        Config::class,
        DB::class,
    ];

    public function handle(): void
    {
        $application = new Application();

        $commands = config(Console::class, ['commands']);
        foreach ($commands as $command) {
            $application->add(new $command());
        }
        // ... register commands

        $application->run();
    }
}