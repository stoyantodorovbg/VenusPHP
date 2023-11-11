<?php

namespace StoyanTodorov\Core\Services\Resolve;

interface ResolverInterface
{
    /**
     * Instantiate a class
     *
     * @param string $class
     * @param array  $dependencies
     * @return object
     */
    public function instantiate(string $class, array $dependencies = []): object;

    /**
     * Instantiate class and call method
     * Instantiate class and method dependencies and inject them
     *
     * @param string $class
     * @param string $method
     * @param array $dependencies
     * @return mixed
     */
    public function instantiateAndCallMethod(string $class, string $method, array $dependencies = []);

    /**
     * Call object method
     *
     * @param object $object
     * @param string $method
     * @param array  $dependencies
     * @return mixed
     */
    public function callMethod(object $object, string $method, array $dependencies = []);

    /**
     * Instantiate constructor parameters
     *
     * @param string $class
     * @return array
     */
    public function getClassDependencies(string $class): array;

    /**
     * @param string $class
     * @param string $method
     * @return array
     */
    public function getMethodDependencies(string $class, string $method): array;
}