<?php

namespace StoyanTodorov\Core\Services\Test;

class TestService
{
    public function __construct(DependencyService $service)
    {
        $this->test();
        $service->test();
    }

    public function test()
    {
        print_r("\ntest service;");
    }
}