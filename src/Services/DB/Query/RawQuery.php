<?php

namespace StoyanTodorov\Core\Services\DB\Query;

use StoyanTodorov\Core\Services\DB\Query\Interfaces\RawQueryInterface;

class RawQuery extends Query implements RawQueryInterface
{
    public function execute(string $raw): mixed
    {
        return $this->adapter->rawQuery($raw);
    }
}