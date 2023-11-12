<?php

use StoyanTodorov\Core\Utilities\Singleton\SingletonInstanceInterface;
use StoyanTodorov\Core\Container\Exceptions\ServiceNotFoundException;

function instance(string $key, array $params = []): object
{
    try {
        return container()->get($key);
    } catch (ServiceNotFoundException $e) {
        return new $key(...$params);
    }
}

function concreteInstance(string $key, array $params = []): object
{
    return new $key(...$params);
}

function instanceWithCustomParams(string $key, array $params = []): object
{
    try {
        return container()->getWithParams($key, $params);
    } catch (ServiceNotFoundException $e) {
        return new $key(...$params);
    }
}

function singletonInstance(string $class)
{
    return instance(SingletonInstanceInterface::class)->instance($class);
}
