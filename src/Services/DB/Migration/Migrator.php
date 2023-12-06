<?php

namespace StoyanTodorov\Core\Services\DB\Migration;

use StoyanTodorov\Core\Config\DB;
use StoyanTodorov\Core\Services\DB\Migration\Enum\MigrationStatus;
use StoyanTodorov\Core\Services\DB\Migration\Interfaces\MigratorInterface;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\PreparedQueryInterface;
use StoyanTodorov\Core\Services\DB\Query\Interfaces\RawQueryInterface;
use StoyanTodorov\Core\Services\DB\Query\PreparedQuery;

class Migrator implements MigratorInterface
{
    protected string $connection = '';
    protected PreparedQueryInterface $preparedQuery;

    public function __construct(protected RawQueryInterface $rawQuery)
    {
        $this->preparedQuery = new PreparedQuery($this->connection, 'migrations');
    }

    public function forward(): void
    {
        if (! $this->rawQuery->execute("SHOW TABLES LIKE 'migrations';")) {
            $instance = instanceWithCustomParams(MigrationsTable::class, [$this->rawQuery]);
            $instance->forward();
        }

        $migrations = config(DB::class, ['migrations']);
        $lastVersion = $this->lastVersion();
        $batch = $this->lastBatch() + 1;

        foreach ($migrations as $migration) {
            $instance = instanceWithCustomParams($migration, [$this->rawQuery]);
            $version = $instance->getVersion();
            if ($version > $lastVersion && ! $this->preparedQuery->count([['version', '=', $version]])) {
                $instance->forward();
                $this->preparedQuery->createOne([
                    'version' => $version,
                    'status'  => MigrationStatus::MIGRATED->value,
                    'batch'   => $batch,
                ]);
                continue;
            }

            if ($this->migrationByStatus($version, MigrationStatus::NOT_MIGRATED)) {
                $instance->forward();
                $this->updateMigrationStatus($version, MigrationStatus::MIGRATED);
            }
        }
    }

    public function backward(): void
    {
        $migrations = config(DB::class, ['migrations']);
        $lastBatch = $this->lastBatch();

        foreach ($migrations as $migration) {
            $instance = instanceWithCustomParams($migration, [$this->rawQuery]);
            $version = $instance->getVersion();
            if ($this->migrationByStatus($version, MigrationStatus::MIGRATED, $lastBatch)) {
                $instance->backward();
                $this->updateMigrationStatus($version, MigrationStatus::NOT_MIGRATED);
            }
        }
    }

    protected function lastVersion(): string
    {
        $raw = $this->preparedQuery->findOne(
            criteria: [['status', '=', MigrationStatus::MIGRATED->value]],
            orderBy: [['id', 'DESC']],
            columns: ['version']
        );
        if (isset($raw[0]) && isset($raw[0]['version'])) {
            return $raw[0]['version'];
        }

        return '0.0.0';
    }

    protected function lastBatch(): int
    {
        $raw = $this->preparedQuery->findOne(
            criteria: [['status', '=', MigrationStatus::MIGRATED->value]],
            orderBy: [['id', 'DESC']],
            columns: ['id', 'batch']
        );

        if (isset($raw[0]) && isset($raw[0]['batch'])) {
            return $raw[0]['batch'];
        }

        return 0;
    }

    protected function migrationByStatus(string $version, MigrationStatus $status, int|null $batch = null): int
    {
        $criteria = [['status', '=', $status->value], ['version', '=', $version]];
        if ($batch) {
            $criteria[] = ['batch', '=', $batch];
        }
        return $this->preparedQuery->count(criteria: $criteria);
    }

    protected function updateMigrationStatus(string $version, MigrationStatus $status): void
    {
        $this->preparedQuery->updateOne(criteria: [['version', '=', $version]], data: ['status' => $status->value]);
    }
}