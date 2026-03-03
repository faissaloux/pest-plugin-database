<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Drivers;

use Faissaloux\PestDatabase\Contracts\Driver;
use Illuminate\Support\Facades\DB;

final class Pgsql implements Driver
{
    public function getTables(string $database): array
    {
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_type = 'BASE TABLE' AND table_schema = 'public'");
        /** @var array<string> $tables */
        $tables = collect($tables)->pluck('table_name')->toArray();

        return $tables;
    }

    public function getDatabaseName(): string
    {
        return DB::connection()->getDatabaseName();
    }
}
