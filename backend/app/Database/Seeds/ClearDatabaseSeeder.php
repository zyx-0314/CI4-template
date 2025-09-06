<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearDatabaseSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('funeral_requests');
        $builder = $db->table('users');

        // Use disableForeignKeyChecks if supported by the DB to avoid FK issues
        $db->disableForeignKeyChecks();
        $builder->truncate();
        $db->enableForeignKeyChecks();
    }
}
