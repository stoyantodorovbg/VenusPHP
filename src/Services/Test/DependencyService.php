<?php

namespace StoyanTodorov\Core\Services\Test;

use StoyanTodorov\Core\Services\Test\Interfaces\DependencyDependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyServiceInterface;

class DependencyService implements DependencyServiceInterface
{
    public function __construct(DependencyDependencyServiceInterface $service)
    {
        $service->test();
    }

    public function test()
    {
        print_r("\ntest dependencies;");
    }
}