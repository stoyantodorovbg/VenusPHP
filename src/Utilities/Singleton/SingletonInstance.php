<?php

namespace StoyanTodorov\Core\Utilities\Singleton;

class SingletonInstance implements SingletonInstanceInterface
{

    public function instance(string $class): object
    {
        return $class::getInstance();
    }
}