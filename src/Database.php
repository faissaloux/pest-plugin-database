<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

use Exception;
use Illuminate\Support\Facades\DB;
use Pest\Expectation;

class Database {
    public function toBe(string $database): Database
    {
        $driver = DB::connection()->getConfig('driver');
        $actualDatabase = DB::connection()->getDatabaseName();

        if ($driver === 'sqlite') {
            $databaseFileExplosion = explode(DIRECTORY_SEPARATOR, $actualDatabase);
            new Expectation(end($databaseFileExplosion))->toBe($database);
        } else {
            new Expectation($actualDatabase)->toBe($database);
        }

        return $this;
    }

    /**
     * @param array<string> $tables
     */
    public function toContainTables(array $tables): Database
    {
        $actualTables = $this->getTables();

        new Expectation($actualTables)->toContain(...$tables);

        return $this;
    }

    public function toContainTablesCount(int $count): Database
    {
        $tables = $this->getTables();

        new Expectation($tables)->toHaveCount($count);

        return $this;
    }

    /**
     * @return array<string>
     */
    private function getTables(): array
    {
        $driver = DB::connection()->getConfig('driver');
        $database = DB::connection()->getDatabaseName();
        $tables = [];

        if ($driver === 'sqlite') {
            if (!file_exists($database)) {
                throw new Exception('Database does not exist.');
            }

            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
            /** @var array<string> $tables */
            $tables = collect($tables)->pluck('name')->toArray();
        } else if ($driver === 'mysql') {
            $tables = DB::select('SHOW TABLES');
            /** @var array<string> $tables */
            $tables = collect($tables)->pluck("Tables_in_$database")->toArray();
        }

        return $tables;
    }
}