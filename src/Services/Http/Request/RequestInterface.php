<?php

namespace StoyanTodorov\Core\Services\Http\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestInterface
{
    /**
     * Get Symfony\Component\HttpFoundation\Request instance
     *
     * @return Request
     */
    public function getRaw(): Request;

    /**
     * Get request path
     *
     * @return string
     */
    public function path(): string;

    /**
     * Get request method
     *
     * @return string
     */
    public function method(): string;

    /**
     * Get request payload
     *
     * @return array
     */
    public function payload(): array;

    /**
     * Get the keys from request body
     *
     * @return array
     */
    public function bodyKeys(): array;

    /**
     * Get the value of certain request body key
     *
     * @param string $key
     * @return string|int|float|bool|null
     */
    public function get(string $key): string|int|float|bool|null;

    /**
     * Determain if the request body has certain key
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;
}