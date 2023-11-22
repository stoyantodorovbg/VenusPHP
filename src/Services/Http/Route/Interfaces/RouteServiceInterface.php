<?php

namespace StoyanTodorov\Core\Services\Http\Route\Interfaces;

use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Route;

interface RouteServiceInterface
{
    /**
     * Get the registered routers
     *
     * @return array
     */
    public function getRouters(): array;

    /**
     * Get Route instance by given route id or HTTP path and method
     *
     * @param string|null     $id
     * @param string|null     $path
     * @param HttpMethod|string|null $method
     * @return Route
     */
    public function route(string|null $id = null, string|null $path = null, HttpMethod|string|null $method = null): Route;

    /**
     * Get Route instance by given route id
     *
     * @param string     $id
     * @param array|null $routers
     * @return Route
     */
    public function routeById(string $id, array|null $routers = null): Route;

    /**
     * Get Route instance by given HTTP path and method
     *
     * @param string     $path
     * @param HttpMethod $method
     * @param array|null $routers
     * @return Route
     */
    public function routeByPathAndMethod(string $path, HttpMethod $method, array|null $routers = null): Route;
}