<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

class Expectation
{
    public Database $database;

    public Driver $driver;

    public function __construct(?string $connection = null)
    {
        $this->database = new Database($connection);
        $this->driver = new Driver($connection);
    }
}
