<?php
namespace App\Services;

use Config\Database;
use App\Services\Contracts\DbHealthServiceInterface;

class DbHealthService implements DbHealthServiceInterface
{
    /**
     * Returns DB health information for a given DB group.
     *
     * @param string $dbGroup
     * @return array [connected => bool, tablesCount => int|null, error => string|null]
     */
    public function getHealth(string $dbGroup = 'default'): array
    {
        $connected = false;
        $tablesCount = null;
        $error = null;

        try {
            $db = Database::connect($dbGroup);

            // quick connectivity check
            $db->query('SELECT 1');
            $connected = true;

            if (method_exists($db, 'listTables')) {
                $tables = $db->listTables();
                $tablesCount = is_array($tables) ? count($tables) : (int) $tables;
            } else {
                // Best-effort fallback: try information_schema for MySQL
                try {
                    $res = $db->query("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = DATABASE()");
                    $tablesCount = $res ? $res->getNumRows() : null;
                } catch (\Exception $e) {
                    $tablesCount = null;
                }
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $connected = false;
        }

        return [
            'connected' => $connected,
            'tablesCount' => $tablesCount,
            'error' => $error,
        ];
    }
}
