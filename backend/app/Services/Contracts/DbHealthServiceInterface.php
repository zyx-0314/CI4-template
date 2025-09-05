<?php
namespace App\Services\Contracts;

interface DbHealthServiceInterface
{
    /**
     * Returns DB health information for a given DB group.
     *
     * @param string $dbGroup
     * @return array{connected: bool, tablesCount: int|null, error: string|null}
     */
    public function getHealth(string $dbGroup = 'default'): array;
}
