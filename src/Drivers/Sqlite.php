<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Drivers;

use Exception;
use Faissaloux\PestDatabase\Contracts\Driver;
use Illuminate\Support\Facades\DB;

final class Sqlite implements Driver
{
    public function __construct(private ?string $connection = null) {}

    public function getTables(string $database): array
    {
        if (! file_exists($database)) {
            throw new Exception('Database does not exist.');
        }

        $tables = DB::connection($this->connection)
            ->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        /** @var array<string> $tables */
        $tables = collect($tables)->pluck('name')->toArray();

        return $tables;
    }

    public function getDatabaseName(): string
    {
        $database = DB::connection($this->connection)->getDatabaseName();
        $databaseFileExplosion = explode(DIRECTORY_SEPARATOR, $database);

        return end($databaseFileExplosion);
    }
}
