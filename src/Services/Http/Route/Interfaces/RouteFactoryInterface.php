<?php

namespace StoyanTodorov\Core\Services\Http\Route\Interfaces;

use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Route;

interface RouteFactoryInterface
{
    /**
     * Create a route instance
     *
     * @param string     $url
     * @param string     $controller
     * @param string     $controllerMethod
     * @param HttpMethod $httpMethod
     * @param string     $prefix
     * @param array|null $id
     * @return Route
     */
    public function create(
        string $url,
        string $controller,
        string $controllerMethod,
        HttpMethod $httpMethod = HttpMethod::GET,
        array|null $id = null,
    ): Route;
}