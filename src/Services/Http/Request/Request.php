<?php

namespace StoyanTodorov\Core\Services\Http\Request;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request implements RequestInterface
{
    protected SymfonyRequest $request;

    public function __construct()
    {
        $this->request = SymfonyRequest::createFromGlobals();
    }

    public function getRaw(): SymfonyRequest
    {
        return $this->request;
    }

    public function path(): string
    {
        return $this->request->getPathInfo();
    }

    public function method(): string
    {
        return $this->request->getMethod();
    }

    public function payload(): array
    {
        return $this->request->getPayload()->all();
    }

    public function bodyKeys(): array
    {
        return $this->request->getPayload()->keys();
    }

    public function get(string $key): string|int|float|bool|null
    {
        return $this->request->getPayload()->get($key);
    }

    public function has(string $key): bool
    {
        return $this->request->getPayload()->has($key);
    }
}