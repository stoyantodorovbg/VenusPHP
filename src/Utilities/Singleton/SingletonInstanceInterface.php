<?php

namespace StoyanTodorov\Core\Utilities\Singleton;

interface SingletonInstanceInterface
{
    /**
     * Get the instance
     *
     * @param string $class
     * @return object
     */
    public function instance(string $class): object;
}