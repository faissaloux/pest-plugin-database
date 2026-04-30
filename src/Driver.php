<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

use Illuminate\Support\Facades\DB;
use Pest\Expectation;

class Driver
{
    public function __construct(private ?string $connection = null) {}

    public function toBe(string $driver): Driver
    {
        $actualDriver = DB::connection($this->connection)->getConfig('driver');

        (new Expectation($actualDriver))->toBe($driver);

        return $this;
    }
}
