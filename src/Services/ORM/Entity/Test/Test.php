<?php

namespace StoyanTodorov\Core\Services\ORM\Entity\Test;

use Carbon\Carbon;
use StoyanTodorov\Core\Services\ORM\Entity\BaseEntity;

class Test extends BaseEntity
{
    public function __construct(
        public int             $id,
        public string          $title,
        public bool            $intStatus,
        public array           $json,
        public int             $int,
        public float           $float,
        public TestEnumString  $enumString,
        public TestConvertEnum $convertEnum,
        public Carbon          $created,
        public Carbon          $updated,
    ) {
    }

    public static array $create = [
        'status'      => ['bool'],
        'json'        => ['array'],
        'enumString'  => [TestEnumString::class],
        'convertEnum' => [TestEnumString::class, 'bool'],
    ];
}