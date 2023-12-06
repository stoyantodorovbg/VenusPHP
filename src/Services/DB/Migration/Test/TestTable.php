<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Test;

use StoyanTodorov\Core\Services\DB\Migration\Migration;

class TestTable extends Migration
{
    protected string $version = '0.1.1';

    protected array $forwardQueries = [
        'CREATE TABLE `test` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `test` VARCHAR(255) NOT NULL
        );'
    ];

    protected array $backwardQueries = [
        'DROP TABLE IF EXISTS `test`'
    ];
}