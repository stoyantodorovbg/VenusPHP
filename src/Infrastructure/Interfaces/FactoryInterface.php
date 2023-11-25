<?php

namespace StoyanTodorov\Core\Infrastructure\Interfaces;

interface FactoryInterface
{
    /**
     * Create an object
     *
     * @return object
     */
    public function create(): object;
}