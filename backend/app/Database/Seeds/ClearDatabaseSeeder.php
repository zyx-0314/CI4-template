<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearDatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Order matters: child tables first, then parents
        // List down your tables here
        $tablesInOrder = [];

        $db->disableForeignKeyChecks();

        try {
            foreach ($tablesInOrder as $table) {
                if (method_exists($db, 'tableExists') && $db->tableExists($table)) {
                    // TRUNCATE resets AUTO_INCREMENT in MySQL
                    $db->table($table)->truncate();
                }
            }
        } finally {
            $db->enableForeignKeyChecks();
        }
    }
}
