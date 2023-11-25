<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Config\Framework;

class Config extends Binder
{
    protected array $map = [
        ['framework-conf', Framework::class],
        ['db-conf', DB::class],
    ];
}