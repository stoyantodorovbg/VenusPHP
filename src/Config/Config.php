<?php

namespace StoyanTodorov\Core\Config;

abstract class Config
{
    protected array $data = [];

    public function get(array $keys): mixed
    {
        $output = $this->data();
        foreach ($keys as $key) {
            $output = $output[$key];
        }

        return $output;
    }

    abstract protected function data(): array;
}