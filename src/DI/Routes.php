<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Http\Route\Config\Api;
use StoyanTodorov\Core\Services\Http\Route\Config\Web;

class Routes extends Binder
{
    protected array $map = [
        ['web-router', Web::class],
        ['api-router', Api::class],
    ];
}