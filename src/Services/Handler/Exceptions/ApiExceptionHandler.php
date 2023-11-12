<?php

namespace StoyanTodorov\Core\Services\Handler\Exceptions;

use StoyanTodorov\Core\Controllers\ApiErrorsController;
use Throwable;

class ApiExceptionHandler extends AbstractExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $this->process($exception, ApiErrorsController::class);
    }
}