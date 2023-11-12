<?php

namespace StoyanTodorov\Core\Services\Handler\Exceptions;

use Throwable;

abstract class AbstractExceptionHandler
{
    /**
     * @param Throwable $exception
     * @return void
     * @throws Throwable
     */
    abstract public function handle(Throwable $exception): void;

    /**
     * @throws Throwable
     */
    protected function process(Throwable $exception, string $handlerClass): void
    {
        l($exception->getMessage(), $exception->getTrace(), 'error');
        config('framework-conf', ['debug']) ?
            throw $exception :
            (new $handlerClass())->error(500);
    }
}