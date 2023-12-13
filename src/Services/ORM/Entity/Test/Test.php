<?php

namespace StoyanTodorov\Core\Services\ORM\Entity\Test;

use Carbon\Carbon;
use StoyanTodorov\Core\Services\ORM\Entity\Entity;
use StoyanTodorov\Core\Services\ORM\Mapper\Test\TestMapper;

class Test extends Entity
{
    protected static string $mapper = TestMapper::class;

    public static array $parseConfig = [
        'status'      => ['bool'],
        'json'        => ['array'],
        'enumString'  => [TestEnumString::class],
        'convertEnum' => [TestConvertEnum::class, 'bool'],
    ];

    public function __construct(
        public int|null        $id,
        public string          $title,
        public bool            $intStatus,
        public array|null      $json,
        public int             $int,
        public float           $float,
        public TestEnumString  $enumString,
        public bool            $convertEnum,
        public Carbon          $created,
        public Carbon          $updated,
    ) {
    }
}