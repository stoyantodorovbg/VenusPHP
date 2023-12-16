<?php

namespace StoyanTodorov\Core\Services\DB\Adapter;

use PDO;

class Mysql extends SqlAdapter
{
    protected string $connectionId = 'mysql';

    public function rawQuery(string $statement): array
    {
        $connection = $this->connect()->query($statement);

        return $connection->fetchAll(PDO::FETCH_ASSOC);
    }

    public function preparedQuery(array $data, array $values): array|int|string|null
    {
        $connection = $this->connect();
        $query = $this->prepareQuery($data);
        $statement = $connection->prepare($query);

        $key = 1;
        foreach ($values as $value) {
            if (! is_array($value)) {
                $statement->bindValue($key, $value, $this->pdoValueType($value));
                $key++;

                continue;
            }
            foreach($value as $innerValue) {
                $statement->bindValue($key, $innerValue, $this->pdoValueType($innerValue));
                $key++;
            }
        }

        if ($statement->execute()) {
            return array_key_exists('insert', $data) ?
                $connection->lastInsertId() :
                $statement->fetchAll();
        }
    }

    protected function prepareQuery(array $data): string
    {
        $query = '';
        foreach ($data as $method => $parameters) {
            $query .= $this->$method(...$parameters);
        }

        return "{$query};";
    }

    protected function pdoValueType($value): int
    {
        return match(gettype($value)) {
            'NULL'    => PDO::PARAM_NULL,
            'integer' => PDO::PARAM_INT,
            'boolean' => PDO::PARAM_BOOL,
            default   => PDO::PARAM_STR,
        };
    }

    protected function select(string $table, array $columns = []): string
    {
        $columns = array_map(fn($column) => "`{$column}`", $columns);
        $columns = $columns ? implode(', ', $columns) : '*';

        return "SELECT {$columns} FROM `{$table}`";
    }

    protected function count(string $table): string
    {
        return "SELECT count(*) as count FROM `{$table}`";
    }

    protected function where(array $criteria): string
    {
        $output = ' WHERE';
        $lastKey = array_key_last($criteria);
        foreach ($criteria as $key => $data) {
            $output .= " `{$data[0]}` {$data[1]} ?";
            if ($lastKey !== $key) {
                $output .= ' AND';
            }
        }

        return $output;
    }

    protected function whereIn(array $criteria): string
    {
        $output = " WHERE `{$criteria['column']}` IN (";
        $lastKey = array_key_last($criteria['values']);
        foreach ($criteria['values'] as $key => $value) {
            $output .= " ?";
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
            $output .= " `{$data[0]}` {$data[1]}";
            if ($lastKey !== $key) {
                $output .= ',';
            }
        }

        return $output;
    }

    protected function limit(): string
    {
        return ' LIMIT ?';
    }

    protected function groupBy(array $groupBy): string
    {
        $output = ' GROUP BY';
        $lastKey = array_key_last($groupBy);
        foreach ($groupBy as $key => $column) {
            $output .= " `{$column}`";
            if ($lastKey !== $key) {
                $output .= ',';
            }
        }

        return $output;
    }

    protected function insert(string $table, array $data): string
    {
        $columnsData = array_keys($data);
        $columns = [];
        foreach ($columnsData as $column) {
            if (is_string($column)) {
                $columns[] = "`{$column}`";
                continue;
            }
            foreach (array_keys($data[$column]) as $innerColumn) {
                $columns[] = "`{$innerColumn}`";
            }
            break;
        }

        $columnsQuery = implode(', ', $columns);
        $valuesQuery = '';
        $values = array_values($data);
        $lastKey = array_key_last($values);
        $multipleRows = false;

        foreach ($values as $key => $row) {
            if (is_array($row)) {
                $lastRowKey = array_key_last($row);
                $valuesQuery .= '(';
                foreach ($row as $rowKey => $rowValues) {
                    $valuesQuery .= ' ?';
                    if ($lastRowKey !== $rowKey) {
                        $valuesQuery .= ',';
                    }
                }
                $valuesQuery .= ')';
                $multipleRows = true;
            } else {
                $valuesQuery .= ' ?';
            }

            if ($lastKey !== $key) {
                $valuesQuery .= ',';
            }
        }
        $firstBracket = $multipleRows ? '' : '(';
        $lastBracket = $multipleRows ? '' : ')';

        return "INSERT INTO `{$table}` ({$columnsQuery}) VALUES {$firstBracket}{$valuesQuery}{$lastBracket}";
    }

    protected function update(string $table, array $columns): string
    {
        $data ='';
        $lastKey = array_key_last($columns);
        foreach ($columns as $key => $column) {
            $data .= " `{$column}` = ?";
            if ($lastKey !== $key) {
                $data .= ',';
            }
        }

        return "UPDATE `{$table}` SET {$data}";
    }

    protected function delete(string $table): string
    {
        return "DELETE FROM `{$table}`";
    }
}