<?php

namespace StoyanTodorov\Core\Services\Http\Route\Config;

use StoyanTodorov\Core\HTTP\Controllers\Test\ApiController;
use StoyanTodorov\Core\Services\Http\Route\HttpMethod;
use StoyanTodorov\Core\Services\Http\Route\Router;

class Api extends Router
{
    protected string $prefix = 'api/';

    protected array $config = [
        HttpMethod::GET->value => [
            'test'      => [ApiController::class, 'test', 'api-test'],
            'test-test' => [ApiController::class, 'test1'],
        ],
    ];
}