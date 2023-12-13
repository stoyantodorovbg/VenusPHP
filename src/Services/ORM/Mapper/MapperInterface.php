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
     * @param array|null $groupBy
     * @param int|null    $limit
     * @return array
     */
    public function findMany(array $criteria, array|null $orderBy = null, array|null $groupBy = null, int|null $limit = null): array;

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
     * @return array|null
     */
    public function createMany(array $data, bool $save = true): array|null;

    /**
     * Update given entity
     *
     * @param EntityInterface $entity
     * @param array           $data
     * @param bool            $save
     * @param bool            $fetch
     * @return EntityInterface|null
     */
    public function updateEntity(EntityInterface $entity, array $data, bool $save = true, bool $fetch = true): EntityInterface|null;

    /**
     * Update one by primary key
     *
     * @param string|int $primary
     * @param array      $data
     * @param bool       $save
     * @param bool       $fetch
     * @return EntityInterface|null
     */
    public function updateByPrimary(string|int $primary, array $data, bool $save = true, bool $fetch = true): EntityInterface|null;

    /**
     * Update one by criteria
     *
     * @param array $criteria
     * @param array $data
     * @param bool  $save
     * @param bool  $fetch
     * @return EntityInterface|null
     */
    public function updateOne(array $criteria, array $data, bool $save = true, bool $fetch = true): EntityInterface|null;

    /**
     * Update many by criteria
     *
     * @param array $criteria
     * @param       $data
     * @param bool  $save
     * @return array|null
     */
    public function updateMany(array $criteria, $data, bool $save = true): array|null;

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
     * @param array    $criteria
     * @param int|null $limit
     * @return void
     */
    public function deleteMany(array $criteria, int|null $limit = null): void;

    /**
     * Update when find one by criteria or create new one
     *
     * @param array $criteria
     * @param array $data
     * @return EntityInterface
     */
    public function updateOrCreate(array $criteria, array $data): EntityInterface;
}