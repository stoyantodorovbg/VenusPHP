<?php

namespace StoyanTodorov\Core\Controllers;

use StoyanTodorov\Core\Container\Container;

abstract class AbstractController
{
    protected function getContainer(): Container
    {
        return singletonInstance(Container::class);
    }
}