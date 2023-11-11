<?php

namespace StoyanTodorov\Core\Services\Test;

use StoyanTodorov\Core\Services\Test\Interfaces\DependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\TestServiceInterface;

class TestService implements TestServiceInterface
{
    public function __construct(DependencyServiceInterface $service)
    {
        $this->test();
        $service->test();
    }

    public function test()
    {
        print_r("\ntest service;");
    }
}