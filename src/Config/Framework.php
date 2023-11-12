<?php

namespace StoyanTodorov\Core\Config;

class Framework extends Config
{
    protected function data(): array
    {
        return [
            'hasTemplateEngine' => env('HAS_TEMPLATE_ENGINE', 1),
            'templateEngine'    => env('TEMPLATE_ENGINE', 'smarty'),
            'debug'             => env('DEBUG', 0),
            'envMode'           => env('ENV_MODE', 'local'),
            'errorMessages'     => [
                401 => 'UNAUTHORIZED',
                403 => 'FORBIDDEN',
                404 => 'PAGE NOT FOUND',
                429 => 'TOO MANY REQUESTS',
                500 => 'INTERNAL SERVER ERROR',
            ]
        ];
    }
}