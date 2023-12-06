<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

class MigrationsTable extends Migration
{
    protected string $version = '';

    protected array $forwardQueries = [
        "CREATE TABLE `migrations` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `version` VARCHAR(20) NOT NULL UNIQUE,
            `status` ENUM ('0', '1') DEFAULT '0',
            `batch` BIGINT UNSIGNED NOT NULL
        );"
    ];

    protected array $backwardQueries = [
        'DROP TABLE IF EXISTS `migrations`'
    ];
}