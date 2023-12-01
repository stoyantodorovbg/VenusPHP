<?php

namespace StoyanTodorov\Core\Kernel;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Container\Exceptions\ContainerException;
use StoyanTodorov\Core\DI\Binder;
use StoyanTodorov\Core\Kernel\Interfaces\KernelInterface;

abstract class Kernel implements KernelInterface
{
    protected ContainerInterface|null $container = null;
    protected array $binders = [];
    protected array $customBinders = [];
    protected string $mode;

    /**
     * @throws ContainerException
     */
    public function registerBinders(): void
    {
        $container = $this->getContainer();
        foreach ($this->binders as $binder) {
            $this->registerDI(new $binder, $container);
        }
    }

    public function addBinders(): void
    {
        $this->binders = array_merge($this->binders, $this->customBinders);
    }

    public function mode(): string
    {
        return $this->mode;
    }

    /**
     * @throws ContainerException
     */
    protected function registerDI(Binder $binder, ContainerInterface $container): void
    {
        $binder->registerDI($container);
    }

    protected function getContainer(): ContainerInterface
    {
        if (! $this->container) {
            $this->container = Container::getInstance();
        }

        return $this->container;
    }
}