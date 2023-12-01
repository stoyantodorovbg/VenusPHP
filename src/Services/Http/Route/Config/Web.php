<?php

namespace StoyanTodorov\Core\Services\Http\Route\Config;

use StoyanTodorov\Core\HTTP\Controllers\Test\WebController;
use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Router;

class Web extends Router
{
    protected array $config = [
        HttpMethod::GET->value => [
            'test'      => [WebController::class, 'test', 'web-test'],
            'test-test' => [WebController::class, 'test1', 'web-test-test'],
        ],
    ];
}