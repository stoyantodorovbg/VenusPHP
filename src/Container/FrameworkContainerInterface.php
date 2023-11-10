<?php

namespace StoyanTodorov\Core\Container;

use StoyanTodorov\Core\Container\Exceptions\ContainerException;
use StoyanTodorov\Core\Container\Exceptions\ServiceNotFoundException;

interface FrameworkContainerInterface
{
    /**
     * Bind an abstract declaration to concrete implementation and its dependencies
     *
     * @param string $id
     * @param string $class
     * @param array  $dependencies
     * @return void
     * @throws ContainerException
     *
     */
    public function bind(string $id, string $class, array $dependencies = []): void;

    /**
     * Get a concrete implementation by abstract declaration and overwrites its default dependencies
     *
     * @param string $id
     * @param array  $params
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function getWithParams(string $id, array $params): object;
}