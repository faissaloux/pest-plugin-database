<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

use Illuminate\Support\Facades\DB;
use Pest\Expectation;

class Driver {
    public function toBe(string $driver) {
        $actualDriver = DB::connection()->getConfig('driver');
        
        new Expectation($actualDriver)->toBe($driver);

        return $this;
    }
}