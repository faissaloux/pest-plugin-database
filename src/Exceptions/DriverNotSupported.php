<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Exceptions;

use Exception;

class DriverNotSupported extends Exception
{
    public function __construct(string $driver)
    {
        parent::__construct("$driver is not supported");
    }
}