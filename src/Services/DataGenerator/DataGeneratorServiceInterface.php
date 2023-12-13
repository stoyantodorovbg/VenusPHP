<?php

namespace StoyanTodorov\Core\Services\DataGenerator;

interface DataGeneratorServiceInterface
{
    /**
     *Run the configured data generators
     *
     * @return void
     */
    public function run(): void;
}