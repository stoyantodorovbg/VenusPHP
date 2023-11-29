<?php

namespace StoyanTodorov\Core\Services\DB\Query;

interface PreparedQueryInterface
{
    /**
     * Find by primary key
     *
     * @param string|int $primary
     * @return array
     */
    public function findByPrimary(string|int $primary): array;

    /**
     * Find one by criteria
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @return array
     */
    public function findOne(array $criteria, array|null $orderBy = null): array;

    /**
     * Find many by criteria
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param array|null $groupBy
     * @param int|null   $limit
     * @return array
     */
    public function findMany(array $criteria, array|null $orderBy = null, array|null $groupBy = null, int|null $limit = null): array;

    /**
     * Create one
     *
     * @param array $data
     * @param bool  $fetch
     * @return array|null
     */
    public function createOne(array $data, bool $fetch = true): array|null;

    /**
     * Create many
     *
     * @param array $data
     * @return array|null
     */
    public function createMany(array $data): array|null;

    /**
     * Update by primary key
     *
     * @param string|int $primary
     * @param array      $data
     * @param bool       $fetch
     * @return array|null
     */
    public function updateByPrimary(string|int $primary, array $data, bool $fetch = true): array|null;

    /**
     * Update one
     *
     * @param array $criteria
     * @param array $data
     * @param bool  $fetch
     * @return array|null
     */
    public function updateOne(array $criteria, array $data, bool $fetch = true): array|null;

    /**
     * Update many
     *
     * @param array $criteria
     * @param       $data
     * @return null
     */
    public function updateMany(array $criteria, $data): null;

    /**
     * Delete by primary key
     *
     * @param string|int $primary
     * @return void
     */
    public function deleteByPrimary(string|int $primary): void;

    /**
     * Delete one
     *
     * @param array $criteria
     * @return void
     */
    public function deleteOne(array $criteria): void;

    /**
     * Delete many
     *
     * @param array    $criteria
     * @param int|null $limit
     * @return void
     */
    public function deleteMany(array $criteria, int|null $limit = null): void;

    /**
     * Update or create
     *
     * @param array $criteria
     * @param array $data
     * @param bool  $fetch
     * @return array
     */
    public function updateOrCreate(array $criteria, array $data, bool $fetch = true): array;
}