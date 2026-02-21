<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

use Faissaloux\PestDatabase\Contracts\Driver;
use Faissaloux\PestDatabase\Exceptions\DriverNotSupported;
use Illuminate\Support\Facades\DB;
use Pest\Expectation;

class Database
{
    private Driver $driver;

    public function __construct()
    {
        /** @var string $driver */
        $driver = DB::connection()->getConfig('driver');
        $driverClass = 'Faissaloux\PestDatabase\Drivers\\' . ucfirst($driver);
        $driverInterface = 'Faissaloux\PestDatabase\Contracts\Driver';

        if (class_exists($driverClass) && in_array($driverInterface, class_implements($driverClass))) {
            /** @var class-string<Driver> $driverClass */
            $this->driver = new $driverClass;
        } else {
            throw new DriverNotSupported($driver);
        }
    }

    public function toBe(string $database): Database
    {
        $actualDatabase = $this->driver->getDatabaseName();

        (new Expectation($actualDatabase))->toBe($database);

        return $this;
    }

    /**
     * @param  array<string>  $tables
     */
    public function toContainTables(array $tables): Database
    {
        $actualTables = $this->getTables();

        (new Expectation($actualTables))->toContain(...$tables);

        return $this;
    }

    public function toContainTablesCount(int $count): Database
    {
        $tables = $this->getTables();

        (new Expectation($tables))->toHaveCount($count);

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
