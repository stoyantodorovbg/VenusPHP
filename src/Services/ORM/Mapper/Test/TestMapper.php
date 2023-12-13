<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper\Test;

use StoyanTodorov\Core\Services\ORM\Mapper\MysqlMapper;

class TestMapper extends MysqlMapper
{
    protected string $table = 'test';
}