<?php

namespace StoyanTodorov\Core\Services\ORM\Entity;

interface EntityInterface
{
    /**
     * Create an instance by given constructor parameters sent as array values
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self;
}