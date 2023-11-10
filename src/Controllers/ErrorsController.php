<?php

namespace StoyanTodorov\Core\Controllers;

class ErrorsController
{
    private array $data = [
        401 => 'UNAUTHORIZED',
        403 => 'FORBIDDEN',
        404 => 'PAGE NOT FOUND',
        429 => 'TOO MANY REQUESTS',
        500 => 'INTERNAL SERVER ERROR',
    ];

    public function errorPage(int $code): void
    {
        renderTemplate('errors/error', [
            'code'    => $code,
            'message' => $this->data[$code],
        ]);
    }
}