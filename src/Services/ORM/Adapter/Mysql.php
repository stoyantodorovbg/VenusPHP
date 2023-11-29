<?php

namespace StoyanTodorov\Core\Services\ORM\Adapter;

class Mysql extends SqlAdapter
{
    protected string $connectionId = 'mysql';

    public function query(array $data, array $values): array|int|string|null
    {
        $connection = $this->connect();
        $connection->prepare($this->prepareQuery($data));
        $output = $this->execute($connection, $values);

        return array_key_exists('insert', $data) ? $connection->lastInsertId() : $output;
    }

    protected function prepareQuery(array $data): string
    {
        $query = '';
        foreach ($data as $method => $parameters) {
            $query .= $this->$method(...$parameters);
        }

        return "{$query};";
    }

    protected function execute(object $connection, array $values = []): array|null
    {
        return $connection->execute($values);
    }

    protected function select(string $table, array $columns): string
    {
        $columns = $columns ? implode(', ', $columns) : '*';

        return "SELECT {$columns} FROM {$table}";
    }

    protected function count(string $table): string
    {
        return "SELECT count(*) FROM {$table}";
    }

    protected function where(array $criteria): string
    {
        $output = ' WHERE';
        $lastKey = array_key_last($criteria);
        foreach ($criteria as $key => $data) {
            $output .= " {$data['column']} {$data['operator']} ':{$data['column']}'";
            if ($lastKey !== $key) {
                $output .= ' AND';
            }
        }

        return $output;
    }

    protected function whereIn(array $criteria): string
    {
        $output = " WHERE {$criteria['column']} IN (";
        $lastKey = array_key_last($criteria['values']);
        foreach ($criteria['values'] as $key => $value) {
            $output .= " ':{$value}'";
            if ($lastKey !== $key) {
                $output .= ',';
            }
        }
        $output .= ')';

        return $output;
    }

    protected function orderBy(array $orderBy): string
    {
        $output = ' ORDER BY';
        $lastKey = array_key_last($orderBy);
        foreach ($orderBy as $key => $data) {
            $output .= " {$data['column']} {$data['direction']}";
            if ($lastKey !== $key) {
                $output .= ',';
            }
        }

        return $output;
    }

    protected function limit(int $limit): string
    {
        return " LIMIT {$limit}";
    }

    protected function groupBy(array $groupBy): string
    {
        $output = ' GROUP BY';
        $lastKey = array_key_last($groupBy);
        foreach ($groupBy as $key => $column) {
            $output .= " {$column}";
            if ($lastKey !== $key) {
                $output .= ',';
            }
        }

        return $output;
    }

    protected function insert(string $table, array $columns, array $values): string
    {
        $columns = implode(', ', $columns);
        $data = '';
        $lastKey = array_key_last($values);
        foreach ($values as $key => $row) {
            $lastRowKey = array_key_last($row);
            $data .= '(';
            foreach ($row as $rowKey => $rowValues) {
                $data .= " ':{$row['column']}'";
                if ($lastRowKey !== $rowKey) {
                    $data .= ',';
                }
            }
            $data .= ')';
            if ($lastKey !== $key) {
                $data .= ', ';
            }
        }

        return "INSERT INTO {$table} ({$columns}) VALUES {$data}";
    }

    protected function update(string $table, array $columns, array $values): string
    {
        $data ='';
        $lastColumn = array_key_last($columns);
        foreach ($columns as $key => $column) {
            $data .= " {$column} = ':{$values[$key]}'}";
            if ($lastColumn !== $column) {
                $data .= ',';
            }
        }

        return "UPDATE {$table} SET {$data}";
    }

    protected function delete(string $table): string
    {
        return "DELETE FROM {$table}";
    }
}