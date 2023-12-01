<?php

namespace StoyanTodorov\Core\HTTP\Controllers\Test;

use StoyanTodorov\Core\HTTP\Controllers\AbstractApiController;
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