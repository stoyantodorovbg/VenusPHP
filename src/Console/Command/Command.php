<?php

namespace StoyanTodorov\Core\Console\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class Command extends SymfonyCommand
{
    protected string $nameSpace = '';
    protected string $name;
    protected string $description = '';
    protected string $help = '';

    protected function configure(): void
    {
        $this->setName($this->getFullName())->setDescription($this->description)->setHelp($this->help);
    }

    private function getFullName(): string
    {
        $nameSpace = $this->nameSpace ? "{$this->nameSpace}:" : '';

        return $nameSpace . $this->name;
    }
}