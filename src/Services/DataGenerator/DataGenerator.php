<?php

namespace StoyanTodorov\Core\Services\DataGenerator;

abstract class DataGenerator
{
    protected mixed $output;

    /**
     * Generate data
     *
     * @param bool $withOutput
     * @return void
     */
    abstract public function generate(bool $withOutput = false): void;

    public function getOutput(): mixed
    {
        return $this->output;
    }
}