<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

class Expectation {
    public Database $database;
    public driver $driver;

    public function __construct() {
        $this->database = new Database();
        $this->driver = new Driver();
    }
}