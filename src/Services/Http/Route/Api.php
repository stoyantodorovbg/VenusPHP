<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use StoyanTodorov\Core\Controllers\Test\ApiController;

class Api extends Router
{
    protected array $config = [
        'GET' => [
            '/api/test'      => [ApiController::class, 'test'],
            '/api/test-test' => [ApiController::class, 'test1'],
        ],
    ];
}