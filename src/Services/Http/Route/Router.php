<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Router implements RouterInterface
{
    protected array $config;

    public function __construct(protected ResolverInterface $resolver)
    {
    }

    public function match(Request $request): Response|bool|null
    {
        if (! isset($this->config[$request->getMethod()]) ||
            ! isset($this->config[$request->getMethod()][$request->getPathInfo()])
        ) {
            return false;
        }

        $controllerConfig = $this->config[$request->getMethod()][$request->getPathInfo()];

        return $this->resolver->instantiateAndCallMethod($controllerConfig[0], $controllerConfig[1]);
    }
}