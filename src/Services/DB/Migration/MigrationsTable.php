<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

class MigrationsTable extends Migration
{
    protected array $forwardQueries = [
        "CREATE TABLE migrations (
            id BIGINT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            version BIGINT NOT NULL,
            status ENUM ('0', '1') DEFAULT '0'
        );"
    ];

    protected array $backwardQueries = [
        'DROP TABLE IF EXISTS migrations'
    ];
}