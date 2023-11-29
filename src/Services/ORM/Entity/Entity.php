<?php

namespace StoyanTodorov\Core\Services\ORM\Entity;

use Exception;
use ReflectionClass;
use ReflectionProperty;
use StoyanTodorov\Core\Services\String\Interfaces\StringConverterInterface;

class Entity implements EntityInterface
{
    protected static string $connection = 'mysql';
    protected static string $primaryKey = 'id';
    protected static string $table = '';
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

    /**
     * @throws Exception
     */
    public function __get(string $property): mixed
    {
        return $this->getProperty($property);
    }

    /**
     * @throws Exception
     */
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

    public function publicPropertiesNames(): array
    {
        $output = [];
        foreach($this->propertiesReflection(ReflectionProperty::IS_PUBLIC) as $property) {
            $output[] = $property->getName();
        }

        return $output;
    }

    public function publicPropertiesValues(): array
    {
        $output = [];
        foreach($this->propertiesReflection(ReflectionProperty::IS_PUBLIC) as $property) {
            $output[] = $property->getValue();
        }

        return $output;
    }

    /**
     * @throws Exception
     */
    public function getProperty(string $property): mixed
    {
        $this->accessProperty($property);

        return $this->$property;
    }

    /**
     * @throws Exception
     */
    public function setProperty(string $property, mixed $value): void
    {
        $this->accessProperty($property);
        $this->$property = $value;
    }

    public static function primaryKey(): string
    {
        return self::$primaryKey;
    }

    public static function connection(): string
    {
        return self::$connection;
    }

    public static function table(): string
    {
        if (! ($table = self::$table)) {
            $nameSpace = self::class;
            $nameData = explode('\\', $nameSpace);
            $className = $nameSpace[array_key_last($nameData)];
            $table = instance(StringConverterInterface::class)->pascalToSnake($className);
        }

        return $table;
    }

    protected function propertiesReflection(int $type): array
    {
        return (new ReflectionClass($this))->getProperties($type);
    }

    /**
     * @throws Exception
     */
    protected function accessProperty(string $property): void
    {
        $public = get_object_vars($this);
        if (! array_key_exists($property, $public)) {
            throw new Exception("{$property} can't be accessed.");
        }
    }
}