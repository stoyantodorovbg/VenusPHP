<?php

namespace StoyanTodorov\Core\Services\Routes;

use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class Router
{
    protected array $config;

    public function __construct(protected ResolverInterface $resolver)
    {
    }

    public function match(Request $request): bool
    {
        if (! isset($this->config[$request->getMethod()]) ||
            ! isset($this->config[$request->getMethod()][$request->getPathInfo()])
        ) {
            return false;
        }

        $controllerConfig = $this->config[$request->getMethod()][$request->getPathInfo()];
        $this->resolver->instantiateAndCallMethod($controllerConfig[0], $controllerConfig[1]);

        return true;
    }
}