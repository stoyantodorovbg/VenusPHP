<?php

use StoyanTodorov\Core\Services\Log\LoggerServiceInterface;

function loggerService(): LoggerServiceInterface
{
    return instance('logger-service');
}

function l(string|array|object|null $message, array $context = [], string $type = 'debug'): void
{
    loggerService()->log($message, $context, $type);
}