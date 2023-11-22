<?php

namespace StoyanTodorov\Core\Services\Http\Route\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface RouterInterface
{
    /**
     * Check is there a route that matches given HTTP method and path
     *
     * @param string $httpMethod
     * @param string $path
     * @return bool
     */
    public function match(string $httpMethod, string $path): bool;

    /**
     * Get a response by given HTTP method and path
     *
     * @param string $httpMethod
     * @param string $path
     * @return Response|bool|null
     */
    public function getResponse(string $httpMethod, string $path): Response|bool|null;

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Get all configurations
     *
     * @return array
     */
    public function configurations(): array;
}