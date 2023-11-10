<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Test\DependencyDependencyService;
use StoyanTodorov\Core\Services\Test\DependencyService;
use StoyanTodorov\Core\Services\Test\TestService;

class Test extends Binder
{
    protected array $map = [
        ['dependency-dependency-service', DependencyDependencyService::class],
        ['dependency-service', DependencyService::class, ['dependency-dependency-service']],
        ['test-service', TestService::class, ['dependency-service']],
    ];
}