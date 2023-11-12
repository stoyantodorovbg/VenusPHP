<?php

namespace StoyanTodorov\Core\Container;

use Psr\Container\ContainerInterface;
use ReflectionException;
use StoyanTodorov\Core\Container\Exceptions\ContainerException;
use StoyanTodorov\Core\Container\Exceptions\ServiceNotFoundException;
use StoyanTodorov\Core\Services\Resolve\Resolver;
use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use StoyanTodorov\Core\Utilities\Singleton\Singleton;

class Container implements ContainerInterface, FrameworkContainerInterface
{
    use Singleton;

    private array $services = [];

    protected ResolverInterface|null $resolver = null;

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
            return $this->getResolver()->instantiate($id);
        }

        if ($this->services[$id]['dependencies']) {
            $dependencies = [];
            foreach ($this->services[$id]['dependencies'] as $service) {
                $dependencies[] = $this->get($service);
            }

            return $this->getResolver()->instantiate($this->className($id), $dependencies);
        }

        return $this->getResolver()->instantiate($this->className($id));
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    private function className(string $id): string
    {
        return $this->services[$id]['class'];
    }

    protected function getResolver(): ResolverInterface
    {
        if (! $this->resolver) {
            $this->resolver = new Resolver();
        }

        return $this->resolver;
    }
}