<?php

namespace StoyanTodorov\Core\Services\Http\Route\Factories;

use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteFactoryInterface;
use StoyanTodorov\Core\Services\Http\Route\Route;

class RouteFactory implements RouteFactoryInterface
{
    public function create(
        string $url,
        string $controller,
        string $controllerMethod,
        HttpMethod $httpMethod = HttpMethod::GET,
        array|null $id = null,
    ): Route {
        return new Route(
            url: $url,
            controller: $controller,
            controllerMethod: $controllerMethod,
            httpMethod: $httpMethod = HttpMethod::GET,
            id: $id,
        );
    }
}