<?php

namespace StoyanTodorov\Core\Services\String;

use StoyanTodorov\Core\Services\String\Enum\StringStyle;
use StoyanTodorov\Core\Services\String\Interfaces\StringConverterInterface;

class StringConverterConverter implements StringConverterInterface
{
    public function convert(string $string, StringStyle $style): string
    {
        $method = $style->value;

        return $this->$method($string);
    }

    public function snake(string $string): string
    {
        $string = str_replace([' ', '-', ',', '.'], ['_', '_', '_', '_'], $string);
        $string = ltrim($string, '_');
        $string = $this->pascalToSnake($string);
        while(str_contains($string, '__')) {
            $string = str_replace('__', '_', $string);
        }

        return $string;
    }

    public function pascalToSnake(string $string): string
    {
        $string = preg_replace('/[A-Z]/', '_$0', $string);

        return trim($string, '_');
    }
}