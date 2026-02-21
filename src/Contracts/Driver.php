<?php

declare(strict_types=1);

namespace Faissaloux\PestDatabase\Contracts;

interface Driver
{
    /**
     * @return array<string>
     */
    public function getTables(string $database): array;
    public function getDatabaseName(): string;
}
