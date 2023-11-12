<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Http\Route\Api;
use StoyanTodorov\Core\Services\Http\Route\Web;

class Routes extends Binder
{
    protected array $map = [
        ['web-router', Web::class],
        ['api-router', Api::class],
    ];
}