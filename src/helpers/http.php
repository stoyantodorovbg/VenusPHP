<?php

use StoyanTodorov\Core\Services\Http\Request\RequestInterface;
use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteServiceInterface;
use StoyanTodorov\Core\Services\Http\Route\Route;
use Symfony\Component\HttpFoundation\Request;

function requestRaw(): Request
{
    return Request::createFromGlobals();
}

function request(): RequestInterface
{
    return instance(RequestInterface::class);
}

function route(string|null $id = null, string|null $path = null, HttpMethod|string|null $method = null): Route
{
    return instance(RouteServiceInterface::class)->route($id, $path, $method);
}

function routeById(string $id, array|null $routers = null): Route
{
    return instance(RouteServiceInterface::class)->routeById($id, $routers);
}

function urlById(string $id, array|null $routers = null): string
{
    return routeById($id, $routers)->url();
}

function routeByPathAndMethod(string $path, HttpMethod|string $method, array|null $routers = null): Route
{
    return instance(RouteServiceInterface::class)->routeByPathAndMethod($path, $method, $routers);
}

function host(): string
{
    $protocol = str_contains($_SERVER['SERVER_PROTOCOL'], 'HTTPS') ? 'https://' : 'http://';

    return $protocol . $_SERVER['HTTP_HOST'];
}