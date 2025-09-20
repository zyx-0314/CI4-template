<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\\Database\\Seeds\\ClearDatabaseSeeder');

        // $this->call('App\\Database\\Seeds\\<name of the seeder here>');
    }
}
