<?php

namespace StoyanTodorov\Core\Services\Test;

use StoyanTodorov\Core\Services\Test\Interfaces\DependencyDependencyServiceInterface;

class DependencyDependencyService implements DependencyDependencyServiceInterface
{
    public function test()
    {
        print_r("\ntest dependencies of dependencies;");
    }
}