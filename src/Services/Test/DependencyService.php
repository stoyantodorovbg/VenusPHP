<?php

namespace StoyanTodorov\Core\Services\Test;

class DependencyService
{
    public function __construct(DependencyDependencyService $service)
    {
        $service->test();
    }

    public function test()
    {
        print_r("\ntest dependencies;");
    }
}