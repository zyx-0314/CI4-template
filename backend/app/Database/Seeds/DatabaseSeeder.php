<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Clear tables that need truncation first
        $this->call('App\\Database\\Seeds\\ClearDatabaseSeeder');

        // Core data
        $this->call('App\\Database\\Seeds\\UsersSeeder');

        // Domain data
        $this->call('App\\Database\\Seeds\\FuneralRequestsSeeder');
    }
}
