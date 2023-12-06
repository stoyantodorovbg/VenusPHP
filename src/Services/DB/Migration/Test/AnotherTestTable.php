<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Test;

use StoyanTodorov\Core\Services\DB\Migration\Migration;

class AnotherTestTable extends Migration
{
    protected string $version = '0.1.3';

    protected array $forwardQueries = [
        'CREATE TABLE `another_test` (
            id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
            test VARCHAR(255) NOT NULL
        );'
    ];

    protected array $backwardQueries = ['DROP TABLE IF EXISTS another_test'];
}