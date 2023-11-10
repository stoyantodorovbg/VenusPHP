<?php

namespace StoyanTodorov\Core\Container;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Exceptions\ContainerException;
use StoyanTodorov\Core\Container\Exceptions\ServiceNotFoundException;
use StoyanTodorov\Core\Infrastructure\Singleton;

class Container implements ContainerInterface, FrameworkContainerInterface
{
    use Singleton;

    private array $services = [];


    /**
     * @throws ContainerException
     */
    public function bind(string $id, string $class, array $dependencies = []): void
    {
        if (! $this->has($id)) {
            $this->services[$id] = compact('class', 'dependencies');
            return;
        }

        throw new ContainerException($id . ' had been already bound.');
    }

    /**
     * @throws ServiceNotFoundException
     */
    public function getWithParams(string $id, array $params): object
    {
        if (! $this->has($id)) {
            throw new ServiceNotFoundException('Unknown service ' . $id);
        }

        return new $this->services[$id]['class'](...$params);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new ServiceNotFoundException('Unknown service ' . $id);
        }

        $dependencies = [];

        foreach ($this->services[$id]['dependencies'] as $service) {
            $dependencies[] = $this->get($service);
        }

        return new $this->services[$id]['class'](...$dependencies);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}