<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouterInterface;
use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class Router implements RouterInterface
{
    protected array $config;
    protected string $prefix = '/';

    public function __construct(protected ResolverInterface $resolver)
    {
    }

    public function match(string $httpMethod, string $path): bool
    {
        if (! isset($this->config[$httpMethod]) ||
            ! str_starts_with($path, $this->prefix) ||
            ! isset($this->config[$httpMethod][$this->pathKey($path)])
        ) {
            return false;
        }

        return true;
    }

    public function getConfig(string $httpMethod, string $path): array|null
    {
        if ($this->match($httpMethod, $path)) {
            return $this->config[$httpMethod][$this->pathKey($path)];
        }

        return null;
    }

    public function getResponse(string $httpMethod, string $path): Response|bool|null
    {
        if ($this->match($httpMethod, $path)) {
            $controllerConfig = $this->config[$httpMethod][$this->pathKey($path)];

            return $this->resolver->instantiateAndCallMethod($controllerConfig[0], $controllerConfig[1]) ?? true;
        }

        return null;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function configurations(): array
    {
        return $this->config;
    }

    private function pathKey(string $path): string{
        return substr($path, strlen($this->prefix));
    }
}