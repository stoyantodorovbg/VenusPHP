<?php

namespace StoyanTodorov\Core\Interfaces;

interface SingletonInterface
{
    /**
     * @return self
     */
    public static function getInstance(): self;
}