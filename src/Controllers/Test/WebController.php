<?php

namespace StoyanTodorov\Core\Controllers\Test;

use StoyanTodorov\Core\Services\Test\DependencyDependencyService;
use StoyanTodorov\Core\Services\Test\DependencyService;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyDependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\TestServiceInterface;
use StoyanTodorov\Core\Services\Test\TestService;

class WebController
{
    public function test()
    {
        instance(DependencyDependencyServiceInterface::class);
        instance(DependencyServiceInterface::class);
        instance(TestServiceInterface::class);
        print_r("-------\n");
        instance('dependency-dependency-service');
        instance('dependency-service');
        instance('test-service');
        print_r("-------\n");
        instance(DependencyDependencyService::class);
        instance(DependencyService::class);
        instance(TestService::class);

        renderTemplate('test', [
            'title'  => 'Test Title',
            'cities' => [
                ['name' => 'Sofia', 'population' => 1300000],
                ['name' => 'Burgas', 'population' => 200000],
            ],
        ]);
    }

    public function test1()
    {
        renderTemplate('test', [
            'title'  => 'Test Title',
            'cities' => [],
        ]);
    }
}