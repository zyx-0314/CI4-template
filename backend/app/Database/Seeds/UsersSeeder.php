<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        helper('text');

        // Simple UUID v4 generator fallback (if ramsey/uuid not installed)
        $uuid = function () {
            // generate 16 bytes (128 bits) and set version to 4
            $data = random_bytes(16);
            $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
            $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        };

        $now = date('Y-m-d H:i:s');

        $password = password_hash('Password123!', PASSWORD_DEFAULT);

        $users = [
            // 3 clients
            [
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
                'id' => $uuid(),
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
