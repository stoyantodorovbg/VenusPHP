<?php

namespace StoyanTodorov\Core\Services\ORM\Entity;

use ReflectionClass;

class BaseEntity implements EntityInterface
{
    protected static bool $trackDates = true;
    protected static array $defaultParseConfig = [
        'fromRaw' => [
            'created' => ['carbon'],
            'updated' => ['carbon'],
        ],
        'toRaw'   => [
            'created' => ['string'],
            'updated' => ['string'],
        ],
    ];
    protected static array $parseConfig = [];

    protected static array $convertToRawMap = [
        'carbon' => 'string',
        'bool'   => 'int',
    ];

    public static function toRawConfig(): array
    {
        $output = self::$parseConfig;
        foreach($output as $property => $config) {
            $output[$property] = array_reverse($config);
            foreach ($config as $key => $type) {
                if (isset(self::$convertToRawMap[$type])) {
                    $output[$property][$key] = self::$convertToRawMap[$type];
                }
            }
        }

        return $output;
    }

    public function __get(string $property): mixed
    {
        return $this->getProperty($property);
    }

    public function __set(string $property, mixed $value): void
    {
        $this->setProperty($property, $value);
    }

    public static function fromArray(array $data): self
    {
        return new self(...$data);
    }

    public function toArray(): array
    {
        $output = [];
        foreach($this->propertiesReflection() as $property) {
            $output[$property->getName()] = $property->getValue();
        }

        return $output;
    }

    public function getPropertiesNames(): array
    {
        $output = [];
        foreach($this->propertiesReflection() as $property) {
            $output[] = $property->getName();
        }

        return $output;
    }

    public function getPropertiesValues(): array
    {
        $output = [];
        foreach($this->propertiesReflection() as $property) {
            $output[] = $property->getValue();
        }

        return $output;
    }

    public function getProperty(string $property): mixed
    {
        return $this->$property;
    }

    public function setProperty(string $property, mixed $value): void
    {
        $this->$property = $value;
    }

    protected function propertiesReflection(): array
    {
        return (new ReflectionClass($this))->getProperties();
    }
}