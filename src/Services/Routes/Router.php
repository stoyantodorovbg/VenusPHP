<?php

namespace StoyanTodorov\Core\Services\Routes;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Router
{
    protected array $config;

    public function match(Request $request): bool
    {
        if (! isset($this->config[$request->getMethod()]) ||
            ! isset($this->config[$request->getMethod()][$request->getPathInfo()])
        ) {
            return false;
        }

        $controllerConfig = $this->config[$request->getMethod()][$request->getPathInfo()];
        $controller = $controllerConfig[0];
        $method = $controllerConfig[1];

        (new $controller)->$method();

        return true;
    }
}