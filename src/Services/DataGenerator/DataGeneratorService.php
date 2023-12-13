<?php

namespace StoyanTodorov\Core\Services\DataGenerator;

use StoyanTodorov\Core\Config\DB;

class DataGeneratorService implements DataGeneratorServiceInterface
{
    public function run(): void
    {
        foreach (config(DB::class, ['dataGenerators']) as $generator) {
            instance($generator)->generate();
        }
    }
}