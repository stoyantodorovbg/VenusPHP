<?php

namespace StoyanTodorov\Core\Services\ORM\EntityFactory;

use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;
use StoyanTodorov\Core\Services\ORM\Mapper\MapperInterface;

abstract class EntityFactory implements EntityFactoryInterface
{
    protected string $entity = '';

    protected MapperInterface $mapper;

    public function __construct()
    {
        $this->mapper = $this->entity::mapper();
    }

    public function createEntity(array $data): EntityInterface
    {
        return $this->mapper->createOne($data, false, false);
    }

    public function storeEntity(array $data): EntityInterface
    {
        return $this->mapper->createOne($data);
    }
}