<?php

namespace StoyanTodorov\Core\Controllers;

use StoyanTodorov\Core\Config\Framework;
use Symfony\Component\HttpFoundation\Response;

class ApiErrorsController extends AbstractApiController
{
    public function error(int $code): Response
    {
        return $this->jsonResponse(['message' => config(Framework::class, ['errorMessages', $code])], $code);
    }
}