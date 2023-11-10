<?php

namespace StoyanTodorov\Core;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Container\Exceptions\ContainerException;
use StoyanTodorov\Core\Controllers\ErrorsController;
use StoyanTodorov\Core\DI\Binder;
use StoyanTodorov\Core\DI\Core;
use StoyanTodorov\Core\DI\Routes;
use StoyanTodorov\Core\DI\Test;
use StoyanTodorov\Core\Infrastructure\Singleton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
    use Singleton;

    protected ContainerInterface|null $container = null;

    private array $binders = [
        Core::class,
        Routes::class,
        Test::class,
    ];

    protected array $customBinders = [];

    private array $routes = [
        'web-router', 'api-router',
    ];

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

    public function handleRequest(): Response
    {
        $request = Request::createFromGlobals();
        $container = $this->getContainer();
        foreach ($this->routes as $routes) {
            $routes = $container->get($routes);
            if ($response = $routes->match($request)) {
                return $response;
            }
        }

        return (new ErrorsController())->notFound();
    }

    /**
     * @throws ContainerException
     */
    private function registerDI(Binder $binder, ContainerInterface $container): void
    {
        $binder->registerDI($container);
    }

    private function getContainer(): ContainerInterface
    {
        if (! $this->container) {
            $this->container = Container::getInstance();
        }

        return $this->container;
    }
}