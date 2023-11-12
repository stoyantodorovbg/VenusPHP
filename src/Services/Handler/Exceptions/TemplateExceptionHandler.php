<?php

namespace StoyanTodorov\Core\Services\Handler\Exceptions;

use StoyanTodorov\Core\Controllers\TemplateErrorsController;
use Throwable;

class TemplateExceptionHandler extends AbstractExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $this->process($exception, TemplateErrorsController::class);
    }
}