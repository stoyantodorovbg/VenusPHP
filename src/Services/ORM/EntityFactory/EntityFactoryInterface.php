<?php

namespace StoyanTodorov\Core\Services\ORM\EntityFactory;

use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

interface EntityFactoryInterface
{
    /**
     * Create an entity
     *
     * @param array $data
     * @return EntityInterface
     */
    public function createEntity(array $data): EntityInterface;

    /**
     * Create an entity and store it
     *
     * @param array $data
     * @return EntityInterface
     */
    public function storeEntity(array $data): EntityInterface;
}