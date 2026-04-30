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

    public Tables $tables;

    public function __construct(?string $connection = null)
    {
        /** @var string $driver */
        $driver = DB::connection($connection)->getConfig('driver');
        $driverClass = 'Faissaloux\PestDatabase\Drivers\\'.ucfirst($driver);
        $driverInterface = 'Faissaloux\PestDatabase\Contracts\Driver';

        if (class_exists($driverClass) && in_array($driverInterface, class_implements($driverClass))) {
            /** @var class-string<Driver> $driverClass */
            $this->driver = new $driverClass($connection);
        } else {
            throw new DriverNotSupported($driver);
        }

        $this->tables = new Tables($this->driver, $connection);
    }

    public function toBe(string $database): Database
    {
        $actualDatabase = $this->driver->getDatabaseName();

        (new Expectation($actualDatabase))->toBe($database);

        return $this;
    }
}
