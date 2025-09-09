<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $password = password_hash('Password123!', PASSWORD_DEFAULT);

        $users = [
            // 3 clients
            [
                'first_name' => 'Alice',
                'middle_name' => 'M',
                'last_name' => 'Carson',
                'email' => 'alice@example.test',
                'password_hash' => $password,
                'type' => 'client',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Bob',
                'middle_name' => null,
                'last_name' => 'Dawson',
                'email' => 'bob@example.test',
                'password_hash' => $password,
                'type' => 'client',
                'account_status' => 1,
                'email_activated' => 0,
                'newsletter' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Cara',
                'middle_name' => 'L',
                'last_name' => 'Evans',
                'email' => 'cara@example.test',
                'password_hash' => $password,
                'type' => 'client',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 1 embalmer
            [
                'first_name' => 'Ethan',
                'middle_name' => null,
                'last_name' => 'Miller',
                'email' => 'ethan.embalmer@example.test',
                'password_hash' => $password,
                'type' => 'embalmer',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 1 driver
            [
                'first_name' => 'Darren',
                'middle_name' => null,
                'last_name' => 'Rios',
                'email' => 'darren.driver@example.test',
                'password_hash' => $password,
                'type' => 'driver',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 3 staff
            [
                'first_name' => 'Sofia',
                'middle_name' => null,
                'last_name' => 'Kent',
                'email' => 'sofia.staff@example.test',
                'password_hash' => $password,
                'type' => 'staff',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Tina',
                'middle_name' => null,
                'last_name' => 'Ng',
                'email' => 'tina.staff@example.test',
                'password_hash' => $password,
                'type' => 'staff',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'first_name' => 'Marco',
                'middle_name' => null,
                'last_name' => 'Reed',
                'email' => 'marco.staff@example.test',
                'password_hash' => $password,
                'type' => 'staff',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 1 florist
            [
                'first_name' => 'Flora',
                'middle_name' => null,
                'last_name' => 'Bloom',
                'email' => 'flora.florist@example.test',
                'password_hash' => $password,
                'type' => 'florist',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 1 manager
            [
                'first_name' => 'Martin',
                'middle_name' => null,
                'last_name' => 'Gale',
                'email' => 'martin.manager@example.test',
                'password_hash' => $password,
                'type' => 'manager',
                'account_status' => 1,
                'email_activated' => 1,
                'newsletter' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
