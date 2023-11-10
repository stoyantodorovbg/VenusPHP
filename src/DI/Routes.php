<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Routes\Api;
use StoyanTodorov\Core\Services\Routes\Web;

class Routes extends Binder
{
    protected array $map = [
        ['web-router', Web::class],
        ['api-router', Api::class],
    ];
}