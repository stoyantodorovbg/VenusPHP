<?php

namespace StoyanTodorov\Core\DI;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;

abstract class Binder
{
    protected ContainerInterface $container;
    protected array $map;

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    public function registerDI()
    {
        foreach ($this->map as $service) {
            $this->container->bind(...$service);
        }
    }
}