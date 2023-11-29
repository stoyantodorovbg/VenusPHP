<?php

namespace StoyanTodorov\Core\Services\ORM\Entity;

use StoyanTodorov\Core\Services\ORM\Mapper\MapperInterface;

interface EntityInterface
{
    /**
     * Create an instance by given constructor parameters sent as array values
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self;

    /**
     * Convert entity to array
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Get public properties names
     *
     * @return array
     */
    public function publicPropertiesNames(): array;

    /**
     * Get public properties values
     *
     * @return array
     */
    public function publicPropertiesValues(): array;

    /**
     * Get public property value
     *
     * @param string $property
     * @return mixed
     */
    public function getProperty(string $property): mixed;

    /**
     * Set public property value
     *
     * @param string $property
     * @param mixed  $value
     * @return void
     */
    public function setProperty(string $property, mixed $value): void;

    /**
     * Get entity mapper instance
     *
     * @param string|null $connection
     * @return MapperInterface
     */
    public static function mapper(string|null $connection = null): MapperInterface;

    /**
     * Get primary key name
     *
     * @return string
     */
    public static function primaryKey(): string;

    /**
     * get connection name
     *
     * @return string
     */
    public static function connection(): string;
}