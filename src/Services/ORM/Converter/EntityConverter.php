<?php

namespace StoyanTodorov\Core\Services\ORM\Converter;

use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

class EntityConverter extends Converter implements EntityConverterInterface
{
    public function toEntity(array $data, string $entityClass): EntityInterface
    {
        $config = $this->fromRawConfig($entityClass);
        $data = $this->convertData($data, $config);

        return new $entityClass(...$data);
    }

    public function toRaw(EntityInterface $entity, string $entityClass): array
    {
        $data = (array) $entityClass;
        $config = $this->toRawConfig($entityClass);

        return $this->convertData($data, $config);
    }

    protected function convertData(array $data, array $config): array
    {
        foreach($data as $property => $value) {
            if (isset($config[$property])) {
                foreach ($config[$property] as $type) {
                    $data[$property] = $this->converter->convert($data[$property], $type);
                }
            }
        }

        return $data;
    }

    protected function fromRawConfig(string $entityClass): array
    {
        $defaultParseConfig = $entityClass::$trackDates ? $entityClass::$defaultParseConfig['fromRaw'] : [];

        return array_merge($entityClass::$parseConfig, $defaultParseConfig);
    }

    protected function toRawConfig(string $entityClass): array
    {
        $output = $entityClass::$parseConfig;
        foreach($output as $property => $config) {
            $output[$property] = array_reverse($config);
            foreach ($config as $key => $type) {
                if (isset($entityClass::$convertToRawMap[$type])) {
                    $output[$property][$key] = $entityClass::$convertToRawMap[$type];
                }
            }
        }

        return $output;
    }
}