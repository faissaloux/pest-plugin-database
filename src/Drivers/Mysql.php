<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Drivers;

use Faissaloux\PestDatabase\Contracts\Driver;
use Illuminate\Support\Facades\DB;

final class Mysql implements Driver
{
    public function getTables(string $database): array
    {
        $tables = DB::select('SHOW TABLES');
        /** @var array<string> $tables */
        $tables = collect($tables)->pluck("Tables_in_$database")->toArray();

        return $tables;
    }

    public function getDatabaseName(): string
    {
        return DB::connection()->getDatabaseName();
    }
}
