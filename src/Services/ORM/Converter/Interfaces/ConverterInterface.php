<?php

namespace StoyanTodorov\Core\Services\ORM\Converter\Interfaces;

interface ConverterInterface
{
    /**
     * Convert to certain type
     *
     * @param mixed  $value
     * @param string $type
     * @return mixed
     */
    public function convert(mixed $value, string $type): mixed;
}