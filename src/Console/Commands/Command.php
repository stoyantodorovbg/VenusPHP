<?php

namespace StoyanTodorov\Core\Console\Commands;

use http\Exception\BadUrlException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends SymfonyCommand
{
    protected string $nameSpace = '';
    protected string $name;
    protected string $description = '';
    protected string $help = '';
    protected array $instantiated = [];
    protected InputInterface|null $input;
    protected OutputInterface|null $output;

    /**
     * Handle
     *
     * @return int
     */
    abstract protected function handle(): int;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;
        foreach($this->instantiated as $key => $value) {
            $this->instantiated[$key] = instance($value);
        }

        return $this->handle();
    }

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