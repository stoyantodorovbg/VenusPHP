<?php

namespace StoyanTodorov\Core\Controllers\Test;

class WebController
{
    public function test()
    {
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