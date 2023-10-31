<?php

namespace StoyanTodorov\Core\Container;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Exceptions\ServiceNotFoundException;

class Container implements ContainerInterface
{
    private static self $instance;

    private array $services = [];

    public static function getInstance(): self
    {
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws ServiceNotFoundException
     */
    public function set(string $id, string $class, array $dependencies = []): void
    {
        $this->has($id);

        $this->services[$id] = compact('class', 'dependencies');
    }

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

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a the container.');
    }
}