<?php

namespace StoyanTodorov\Core\Console\Commands\Test;

use StoyanTodorov\Core\Console\Commands\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected string $nameSpace = 'test';
    protected string $name = 'command';
    protected string $description = 'Test command.';
    protected string $help = 'Just use it.';

    protected function handle(): int
    {
        var_dump(22222);
        return Command::SUCCESS;
    }
}