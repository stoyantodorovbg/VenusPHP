<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use StoyanTodorov\Core\Config\Framework;

readonly class Route
{
    public function __construct(
        protected string $url,
        protected string $controller,
        protected string $controllerMethod,
        protected HttpMethod $httpMethod = HttpMethod::GET,
        protected array|null $id = null,
    ) {
    }

    public function url(): string
    {
        return config(Framework::class, ['host']) . $this->url;
    }
}