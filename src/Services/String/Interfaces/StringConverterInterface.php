<?php

namespace StoyanTodorov\Core\Services\String\Interfaces;

use StoyanTodorov\Core\Services\String\Enum\StringStyle;

interface StringConverterInterface
{
    /**
     * Convert string to certain style
     *
     * @param string      $string
     * @param StringStyle $style
     * @return string
     */
    public function convert(string $string, StringStyle $style): string;

    /**
     * Convert string to snake case
     *
     * @param string $string
     * @return string
     */
    public function snake(string $string): string;

    /**
     * Convert string from pascal to snake case
     *
     * @param string $string
     * @return string
     */
    public function pascalToSnake(string $string): string;
}