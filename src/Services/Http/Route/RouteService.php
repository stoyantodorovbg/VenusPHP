<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Exceptions\RouteNotFoundException;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteFactoryInterface;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteServiceInterface;

class RouteService implements RouteServiceInterface
{
    protected ContainerInterface $container;

    public function __construct(protected RouteFactoryInterface $routeFactory)
    {
        $this->container = Container::getInstance();
    }

    private array $routers = [
        'web-router', 'api-router',
    ];

    public function getRouters(): array
    {
        $output = [];
        foreach ($this->routers as $routerKey) {
            $output[] = $this->container->get($routerKey);
        }

        return $output;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function route(string|null $id = null, string|null $path = null, HttpMethod|string|null $method = null): Route
    {

        $routers = $this->getRouters();
        if ($id) {
            return $this->routeById($id, $routers);
        }

        return $this->routeByPathAndMethod($path, $method, $routers);
    }

    /**
     * @throws RouteNotFoundException
     */
    public function routeById(string $id, array|null $routers = null): Route
    {
        $routers = $routers ?? $this->getRouters();
        foreach ($routers as $router) {
            foreach ($router->configurations() as $method => $configs) {
                foreach ($configs as $path => $config) {
                    if (isset($config[2]) && $config[2] === $id) {
                        return $this->routeFactory->create(
                            url: $router->getPrefix() . $path,
                            controller: $config[0],
                            controllerMethod: $config[1],
                            httpMethod: HttpMethod::create($method),
                        );
                    }
                }
            }
        }

        throw new RouteNotFoundException('Valid route id should be provided.');
    }

    /**
     * @throws RouteNotFoundException
     */
    public function routeByPathAndMethod(string $path, HttpMethod|string $method, array|null $routers = null): Route
    {
        $method = $this->httpMethod($method);
        $routers = $routers ?? $this->getRouters();
        foreach ($routers as $router) {
            if ($config = $router->getConfig($method, $path)) {
                return $this->routeFactory->create(
                    url: $path,
                    controller: $config[0],
                    controllerMethod: $config[1],
                    httpMethod: $method,
                    prefix: $config[2] :: null,
                );
            }
        }

        throw new RouteNotFoundException('Valid route path and HTTP method should be provided.');
    }

    private function httpMethod(HttpMethod|string $method): HttpMethod|null
    {
        return is_string($method) ? HttpMethod::create($method) : $method;
    }
}