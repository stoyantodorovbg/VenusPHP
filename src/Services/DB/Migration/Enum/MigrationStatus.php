<?php

namespace StoyanTodorov\Core\Services\DB\Migration\Enum;

enum MigrationStatus: string
{
    case NOT_MIGRATED = '0';
    case MIGRATED = '1';
}