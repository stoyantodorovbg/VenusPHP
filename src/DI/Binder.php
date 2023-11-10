<?php

namespace StoyanTodorov\Core\DI;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Exceptions\ContainerException;

abstract class Binder
{
    protected array $map;

    /**
     * @throws ContainerException
     */
    public function registerDI(ContainerInterface $container): void
    {
        foreach ($this->map as $service) {
            $container->bind(...$service);
        }
    }
}