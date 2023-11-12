<?php

namespace StoyanTodorov\Core\Services\Resolve;

use ReflectionClass;
use ReflectionException;
use StoyanTodorov\Core\Container\Container;

class Resolver implements ResolverInterface
{
    protected Container $container;
    protected array $predefined = [
        'null', 'bool', 'string', 'int', 'float', 'array', 'object', 'iterable', 'traversable'
    ];

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    /**
     * @throws ReflectionException
     */
    public function instantiate(string $class, array $dependencies = []): object
    {
        $dependencies = $dependencies ?: $this->getClassDependencies($class);

        return new $class(...$dependencies);
    }

    /**
     * @throws ReflectionException
     */
    public function instantiateAndCallMethod(string $class, string $method, array $dependencies = [])
    {
        return $this->callMethod(
            object: $this->instantiate($class),
            method: $method,
            dependencies: $dependencies ?: $this->getMethodDependencies($class, $method),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function callMethod(object $object, string $method, array $dependencies = [])
    {
        $dependencies = $dependencies ?: $this->getMethodDependencies($object::class, $method);

        return $object->$method(...$dependencies);
    }

    /**
     * @throws ReflectionException
     */
    public function getClassDependencies(string $class): array
    {
        if (! ($constructor = $this->reflection($class)->getConstructor()) ||
            ! ($parameters = $constructor->getParameters())
        ) {
            return [];
        }

        return $this->instantiateParameters($parameters);
    }

    /**
     * @throws ReflectionException
     */
    public function getMethodDependencies(string $class, string $method): array
    {
        if (! ($method = $this->reflection($class)->getMethod($method)) ||
            ! ($parameters = $method->getParameters())
        ) {
            return [];
        }

        return $this->instantiateParameters($parameters);
    }

    private function instantiateParameters(array $parameters): array
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            if (($type = $parameter->getType()) && ! in_array($type, $this->predefined)) {
                $dependencies[] = $this->container->get($type);
            }
        }

        return $dependencies;
    }

    /**
     * @throws ReflectionException
     */
    private function reflection(string $className): ReflectionClass
    {
        return new ReflectionClass($className);
    }
}