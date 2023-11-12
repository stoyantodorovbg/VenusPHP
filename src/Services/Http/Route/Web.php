<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use StoyanTodorov\Core\Controllers\Test\WebController;

class Web extends Router
{
    protected array $config = [
        'GET' => [
            '/test'      => [WebController::class, 'test'],
            '/test-test' => [WebController::class, 'test1'],
        ],
    ];
}