<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Drivers;

use Faissaloux\PestDatabase\Contracts\Driver;
use Illuminate\Support\Facades\DB;

final class Mysql implements Driver
{
    public function __construct(private ?string $connection = null) {}

    public function getTables(string $database): array
    {
        $tables = DB::connection($this->connection)->select('SHOW TABLES');
        /** @var array<string> $tables */
        $tables = collect($tables)->pluck("Tables_in_$database")->toArray();

        return $tables;
    }

    public function getDatabaseName(): string
    {
        return DB::connection($this->connection)->getDatabaseName();
    }
}
