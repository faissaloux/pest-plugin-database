<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase;

function expect(?string $connection = null): Expectation
{
    return new Expectation($connection);
}
