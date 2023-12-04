<?php

namespace StoyanTodorov\Core\Services\DB\Connection;

use PDO;

class Mysql extends Connection
{
    protected function instantiate(array $config): void
    {
        $this->instance = new PDO(
            dsn: "mysql:host={$config['host']}:{$config['port']};dbname={$config['database']};",
            username: $config['user'],
            password: $config['password']
        );
        $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}