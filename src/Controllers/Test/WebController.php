<?php

namespace StoyanTodorov\Core\Controllers\Test;

use StoyanTodorov\Core\Services\Test\Interfaces\DependencyDependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\TestServiceInterface;

class WebController
{
    public function test()
    {
        instance(DependencyDependencyServiceInterface::class);
        instance(DependencyServiceInterface::class);
        instance(TestServiceInterface::class);
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