<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class HealthCheck extends BaseCommand
{
    protected $group       = 'app';
    protected $name        = 'health:check';
    protected $description = 'Checks CodeIgniter boot and database connectivity.';

    public function run(array $params)
    {
        $ciVersion = \CodeIgniter\CodeIgniter::CI_VERSION ?? 'unknown';
        CLI::write("CodeIgniter: up (version {$ciVersion})");

        try {
            $db = Database::connect();
            $start = microtime(true);
            $row = $db->query('SELECT 1 AS ok')->getRowArray();
            $latency = round((microtime(true) - $start) * 1000, 2);

            if (! isset($row['ok']) || (int)$row['ok'] !== 1) {
                CLI::error('Database: down (unexpected query result)');
                return 2;
            }

            CLI::write("Database: up ({$latency} ms)");
            return 0;
        } catch (\Throwable $e) {
            CLI::error('Database: down ('.$e->getMessage().')');
            return 2;
        }
    }
}
