<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Test;

use StoyanTodorov\Core\Services\DB\Migration\Migration;

class TestTable extends Migration
{
    protected string $version = '0.1.1';

    protected array $forwardQueries = [
        "CREATE TABLE `test` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `int_status` TINYINT UNSIGNED NOT NULL DEFAULT 0,
            `json` JSON DEFAULT NULL,
            `int` INT NOT NULL,
            `float` FLOAT(10, 7) NOT NULL,
            `enum_string` ENUM('first-case', 'other-case') NOT NULL,
            `convert_enum` ENUM('0', '1') DEFAULT '0',
            `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated` DATETIME DEFAULT CURRENT_TIMESTAMP
        );"
    ];

    protected array $backwardQueries = [
        'DROP TABLE IF EXISTS `test`'
    ];
}