<?php

namespace StoyanTodorov\Core\Services\ORM\Adapter;

abstract class SqlAdapter extends ORMAdapter
{
    /**
     * Select data
     *
     * @param string $table
     * @param array  $columns
     * @return string
     */
    abstract protected function select(string $table, array $columns): string;

    /**
     * Select rows count
     *
     * @param string $table
     * @return string
     */
    abstract protected function count(string $table): string;

    /**
     * Filter data by comparisons
     *
     * @param array $criteria
     * @return string
     */
    abstract protected function where(array $criteria): string;

    /**
     * Filter data by certain values
     *
     * @param array $criteria
     * @return string
     */
    abstract protected function whereIn(array $criteria): string;

    /**
     * Order data
     *
     * @param array $orderBy
     * @return string
     */
    abstract protected function orderBy(array $orderBy): string;

    /**
     * Limit data
     *
     * @param int $limit
     * @return string
     */
    abstract protected function limit(int $limit): string;

    /**
     * Group data
     *
     * @param array $groupBy
     * @return string
     */
    abstract protected function groupBy(array $groupBy): string;

    /**
     * Insert data
     *
     * @param string $table
     * @param array  $columns
     * @param array  $values
     * @return string
     */
    abstract protected function insert(string $table, array $columns, array $values): string;

    /**
     * Update data
     *
     * @param string $table
     * @param array  $columns
     * @param array  $values
     * @return string
     */
    abstract protected function update(string $table, array $columns, array $values): string;

    /**
     * Delete data
     *
     * @param string $table
     * @return string
     */
    abstract protected function delete(string $table): string;
}