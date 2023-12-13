<?php

namespace StoyanTodorov\Core\Services\ORM\Entity;

use Exception;
use ReflectionClass;
use ReflectionProperty;
use StoyanTodorov\Core\Services\ORM\Mapper\MapperInterface;
use StoyanTodorov\Core\Services\String\Interfaces\StringConverterInterface;

class Entity implements EntityInterface
{
    public static bool $trackDates = true;
    public static array $defaultParseConfig = [
        'fromRaw' => [
            'created' => ['carbon'],
            'updated' => ['carbon'],
        ],
        'toRaw'   => [
            'created' => ['string'],
            'updated' => ['string'],
        ],
    ];
    public static array $parseConfig = [];
    public static array $convertToRawMap = [
        'carbon' => 'string',
        'bool'   => 'int',
    ];

    protected static string $mapper;
    protected static string $connection = 'mysql';
    protected static string $primaryKey = 'id';
    protected static string $table = '';

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

    public static function fromArray(array $data): self
    {
        return new self(...$data);
    }


    public static function mapper(string|null $connection = null): MapperInterface
    {
        $connection = $connection ?? static::$connection;

        return instanceWithCustomParams(static::$mapper, [static::class, $connection]);
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
        if (! ($table = static::$table)) {
            $nameSpace = static::class;
            $nameData = explode('\\', $nameSpace);
            $className = $nameData[array_key_last($nameData)];

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