<?php

namespace StoyanTodorov\Core\Controllers\Test;

use StoyanTodorov\Core\Controllers\AbstractApiController;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyDependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\DependencyServiceInterface;
use StoyanTodorov\Core\Services\Test\Interfaces\TestServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractApiController
{
    public function test(): Response
    {
        return $this->jsonResponse([
            'cities' => [
                ['name' => 'Sofia', 'population' => 1300000],
                ['name' => 'Burgas', 'population' => 200000],
            ],
            'citiesAsObjects' => [
                (object) ['name' => 'Sofia', 'population' => 1300000],
                (object) ['name' => 'Burgas', 'population' => 200000],
            ]
        ]);
    }

    public function test1(): Response
    {
        return $this->jsonResponse([
            'cities' => [],
        ]);
    }
}