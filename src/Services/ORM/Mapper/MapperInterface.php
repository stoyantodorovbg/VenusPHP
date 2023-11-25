<?php

namespace StoyanTodorov\Core\Services\ORM\Mapper;

use StoyanTodorov\Core\Services\ORM\Entity\EntityInterface;

interface MapperInterface
{
    /**
     * Find one by primary key
     *
     * @param string|int $primary
     * @return EntityInterface
     */
    public function findByPrimary(string|int $primary): EntityInterface;

    /**
     * Find one by criteria
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @return EntityInterface
     */
    public function findOne(array $criteria, array|null $orderBy = null): EntityInterface;

    /**
     * Find many by criteria
     *
     * @param array       $criteria
     * @param array|null  $orderBy
     * @param int|null    $limit
     * @param string|null $groupBy
     * @return array
     */
    public function findMany(
        array $criteria,
        array|null $orderBy = null,
        int|null $limit = null,
        string|null $groupBy =  null
    ): array;

    /**
     * Create one
     *
     * @param array $data
     * @param bool  $save
     * @return EntityInterface
     */
    public function createOne(array $data, bool $save = true): EntityInterface;

    /**
     * Create many
     *
     * @param array $data
     * @param bool  $save
     * @return array
     */
    public function createMany(array $data, bool $save = true): array;

    /**
     * Update given entity
     *
     * @param EntityInterface $entity
     * @param array           $data
     * @param bool            $save
     * @return EntityInterface
     */
    public function updateEntity(EntityInterface $entity, array $data, bool $save = true): EntityInterface;

    /**
     * Update entities
     *
     * @param array $entities
     * @param array $data
     * @param bool  $save
     * @return array
     */
    public function updateEntities(array $entities, array $data, bool $save = true): array;

    /**
     * Update one by primary key
     *
     * @param string|int $primary
     * @param array      $data
     * @param bool       $save
     * @return EntityInterface
     */
    public function updateByPrimary(string|int $primary, array $data, bool $save = true): EntityInterface;

    /**
     * Update one by criteria
     *
     * @param array $criteria
     * @param array $data
     * @param bool  $save
     * @return EntityInterface
     */
    public function updateOne(array $criteria, array $data, bool $save = true): EntityInterface;

    /**
     * Update many by criteria
     *
     * @param array $criteria
     * @param       $data
     * @param bool  $save
     * @return array
     */
    public function updateMany(array $criteria, $data, bool $save = true): array;

    /**
     * Delete entity
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function deleteEntity(EntityInterface $entity): void;

    /**
     * Delete one by primary
     *
     * @param string|int $primary
     * @return void
     */
    public function deleteByPrimary(string|int $primary): void;

    /**
     * Delete one by criteria
     *
     * @param array $criteria
     * @return void
     */
    public function deleteOne(array $criteria): void;

    /**
     * Delete many by criteria
     *
     * @param array $criteria
     * @return void
     */
    public function deleteMany(array $criteria): void;

    /**
     * Update when find one by criteria or create new one
     *
     * @param array $criteria
     * @param array $data
     * @param bool  $save
     * @return EntityInterface
     */
    public function updateOrCreate(array $criteria, array $data, bool $save = true): EntityInterface;
}