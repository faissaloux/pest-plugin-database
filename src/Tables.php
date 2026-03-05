<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

use Faissaloux\PestDatabase\Contracts\Driver;
use Illuminate\Support\Facades\DB;
use Pest\Expectation;

class Tables
{
    public function __construct(private Driver $driver) {}

    /**
     * @param  array<string>  $tables
     */
    public function toBe(array $tables): Tables
    {
        $actualTables = $this->getTables();

        (new Expectation($actualTables))->toContain(...$tables);

        return $this;
    }

    public function toHaveCount(int $count): Tables
    {
        $actualTables = $this->getTables();

        (new Expectation($actualTables))->toHaveCount($count);

        return $this;
    }

    /**
     * @return array<string>
     */
    private function getTables(): array
    {
        $database = DB::connection()->getDatabaseName();
        $tables = $this->driver->getTables($database);

        return $tables;
    }
}