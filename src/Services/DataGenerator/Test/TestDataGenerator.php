<?php

namespace StoyanTodorov\Core\Services\DataGenerator\Test;

use StoyanTodorov\Core\Services\DataGenerator\DataGenerator;
use StoyanTodorov\Core\Services\ORM\Entity\Test\Test;
use StoyanTodorov\Core\Services\ORM\Entity\Test\TestConvertEnum;
use StoyanTodorov\Core\Services\ORM\Entity\Test\TestEnumString;

class TestDataGenerator extends DataGenerator
{
    public function generate(bool $withOutput = false): void
    {
        Test::mapper()->createOne([
            'title' => 'test title',
            'int_status' => 1,
            'json' => json_encode(['k' => 'v', 'k1' => ['k2' => 'v', 'k3' => 3]]),
            'int' => 3,
            'float' => 3.3,
            'enum_string' => TestEnumString::FIRST_CASE->value,
            'convert_enum' => TestConvertEnum::ACTIVE->value,
        ]);
    }
}