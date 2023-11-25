<?php

namespace StoyanTodorov\Core\Services\DB\Connection;

use PDO;

class Mysql implements ConnectionInterface
{
    protected object $instance;

    public function instance(array $config): object
    {
        if (! $this->instance) {
            $this->instantiate($config);
        }

        return $this->instance;
    }

    private function instantiate(array $config): void
    {
        $this->instance = new PDO(
            dsn: "mysql:dbname={$config['database']};host={{$config['host']}:{{$config['port']}}",
            username: $config['user'],
            password: $config['password']
        );
    }
}