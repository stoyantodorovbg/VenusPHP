<?php

namespace StoyanTodorov\Core\Container;

use Psr\Container\ContainerInterface;
use ReflectionClass;
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
     * @throws \ReflectionException
     */
    public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new ServiceNotFoundException('Unknown service ' . $id);
        }

        $dependencies = [];

        if ($this->services[$id]['dependencies']) {
            foreach ($this->services[$id]['dependencies'] as $service) {
                $dependencies[] = $this->get($service);
            }

            return $this->instantiate($id, $dependencies);
        }

        if (($constructor = (new ReflectionClass($this->className($id)))->getConstructor()) &&
            ($parameters = $constructor->getParameters())
        ) {
            foreach ($parameters as $parameter) {
                if ($type = $parameter->getType()) {
                    $dependencies[] = $this->get($type);
                }
            }
        }

        return $this->instantiate($id, $dependencies);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    private function instantiate(string $id, array $dependencies): object
    {
        $className = $this->className($id);

        return new $className(...$dependencies);
    }

    private function className(string $id): string
    {
        return $this->services[$id]['class'];
    }
}