<?php

namespace StoyanTodorov\Core\Services\ORM\Converter;

use Carbon\Carbon;
use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\ConverterInterface;

class Converter implements ConverterInterface
{
    public function convert(mixed $value, string $type): mixed
    {
        if (is_object($value) && enum_exists($value::class)) {
            return $value->value;
        }

        if (class_exists($type)) {
            return enum_exists($type) ? $this->enum($type, $value) : $this->object($type, $value);
        }

        return $this->$type($value);
    }

    protected function object(string $type, mixed $value): object
    {
        return new $type($value);
    }

    protected function enum(string $type, mixed $value): object
    {
        return $type::from($value);
    }

    protected function int(mixed $value): int
    {
        return (int) $value;
    }

    protected function float(mixed $value): float
    {
        return (float) $value;
    }

    protected function string(mixed $value): string
    {
        return match ($this->getType($value)) {
            Carbon::class => $value->toDateTimeString(),
            'array'       => implode($value),
            default       => (string) $value,
        };
    }

    protected function bool(mixed $value): bool
    {
        return (bool) $value;
    }

    protected function array(mixed $value): array
    {
        return (array) $value;
    }

    protected function json(mixed $value): string
    {
        return json_encode($value);
    }

    protected function carbon(string $raw): Carbon
    {
        return Carbon::parse($raw);
    }

    protected function getType(mixed $value): string
    {
        if (($type = gettype($value)) === 'object') {
            $type = $value::class;
        }

        return $type;
    }
}