<?php

namespace StoyanTodorov\Core\Config;

use StoyanTodorov\Core\Services\DB\Enum\DBDriver;

class DB extends Config
{

    protected function data(): array
    {
        return [
            'mysql' => [
                'host'     => env('DB_HOST', '127.0.0.1'),
                'port'     => env('DB_PORT', '3306'),
                'user'     => env('DB_USER', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'database' => env('DB_NAME', 'venus'),
                'driver'   => DBDriver::MYSQL,
            ]
        ];
    }
}