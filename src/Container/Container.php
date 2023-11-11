<?php

namespace StoyanTodorov\Core\Container;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
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
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        if (! $this->has($id)) {
            return new $id(...$this->getClassDependencies($id));
        }

        if ($this->services[$id]['dependencies']) {
            $dependencies = [];
            foreach ($this->services[$id]['dependencies'] as $service) {
                $dependencies[] = $this->get($service);
            }

            return $this->instantiate($id, $dependencies);
        }

        return $this->instantiate($id, $this->getClassDependencies($this->className($id)));
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

    /**
     * @throws ReflectionException
     */
    private function getClassDependencies(string $className): array
    {
        if (! ($constructor = (new ReflectionClass($className))->getConstructor()) ||
            ! ($parameters = $constructor->getParameters())
        ) {
            return [];
        }

        $dependencies = [];
        foreach ($parameters as $parameter) {
            if ($type = $parameter->getType()) {
                $dependencies[] = $this->get($type);
            }
        }

        return $dependencies;
    }
}