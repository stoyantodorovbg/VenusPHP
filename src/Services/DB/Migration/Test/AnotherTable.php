<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Test;

use StoyanTodorov\Core\Services\DB\Migration\Migration;

class AnotherTable extends Migration
{
    protected string $version = '0.1.2';

    protected array $forwardQueries = [
        'CREATE TABLE another (
            id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
            test VARCHAR(255) NOT NULL
        );'
    ];

    protected array $backwardQueries = ['DROP TABLE IF EXISTS another'];
}