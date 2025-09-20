<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Statuses to use: not open, un available, called, messaged, meeting scheduled, assigned, on going, complete
        $statuses = ['not open', 'un available', 'called', 'messaged', 'meeting scheduled', 'assigned', 'on going', 'complete'];

        // We'll reference users seeded in UsersSeeder; users are inserted in a predictable order there.
        // UsersSeeder inserts clients first then staff/embalmer/driver/manager at the end.
        // Example user ids (based on insertion order): 1..11

        $data = [
            // 1. Client request without account (no user_id), basic service, not open
            [
                'service_id' => 1,
                'user_id' => null,
                'first_name' => 'Grace',
                'last_name' => 'Palmer',
                'phone' => '09171234567',
                'email' => 'grace.palmer@example.test',
                'date_start' => date('Y-m-d', strtotime('+7 days')),
                'date_end' => date('Y-m-d', strtotime('+8 days')),
                'additional_requests' => null,
                'status' => $statuses[0],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 2. Client with account (user_id = 1) requesting premium package, with additional requests
            [
                'service_id' => 3,
                'user_id' => 1,
                'first_name' => 'Alice',
                'last_name' => 'Carson',
                'phone' => '09171230001',
                'email' => 'alice@example.test',
                'date_start' => date('Y-m-d', strtotime('+14 days')),
                'date_end' => date('Y-m-d', strtotime('+15 days')),
                'additional_requests' => 'Chair,Flowers,Microphone',
                'status' => $statuses[2], // called
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 3. Manager-created request linked to manager account (user_id = 10)
            [
                'service_id' => 2,
                'user_id' => 10,
                'first_name' => 'Martin',
                'last_name' => 'Gale',
                'phone' => '09170001111',
                'email' => 'martin.manager@example.test',
                'date_start' => date('Y-m-d', strtotime('+3 days')),
                'date_end' => date('Y-m-d', strtotime('+4 days')),
                'additional_requests' => 'Audio,System Check',
                'status' => $statuses[5], // assigned
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 4. Staff (embalmer) as requester (user_id 4), service 4, meeting scheduled
            [
                'service_id' => 4,
                'user_id' => 4,
                'first_name' => 'Ethan',
                'last_name' => 'Miller',
                'phone' => '09172223333',
                'email' => 'ethan.embalmer@example.test',
                'date_start' => date('Y-m-d', strtotime('+1 days')),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'additional_requests' => null,
                'status' => $statuses[4], // meeting scheduled
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 5. Request for an unavailable service
            [
                'service_id' => 3,
                'user_id' => 2,
                'first_name' => 'Bob',
                'last_name' => 'Dawson',
                'phone' => '09173334444',
                'email' => 'bob@example.test',
                'date_start' => date('Y-m-d', strtotime('+20 days')),
                'date_end' => date('Y-m-d', strtotime('+21 days')),
                'additional_requests' => 'Extra Seating',
                'status' => $statuses[1], // un available
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 6. Ongoing request without additional requests
            [
                'service_id' => 5,
                'user_id' => 3,
                'first_name' => 'Cara',
                'last_name' => 'Evans',
                'phone' => '09174445555',
                'email' => 'cara@example.test',
                'date_start' => date('Y-m-d', strtotime('-2 days')),
                'date_end' => date('Y-m-d', strtotime('+1 days')),
                'additional_requests' => null,
                'status' => $statuses[6], // on going
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 7. Completed request (archived) with human name
            [
                'service_id' => 6,
                'user_id' => null,
                'first_name' => 'Helen',
                'last_name' => 'Ward',
                'phone' => '09175556666',
                'email' => 'helen.ward@example.test',
                'date_start' => date('Y-m-d', strtotime('-60 days')),
                'date_end' => date('Y-m-d', strtotime('-59 days')),
                'additional_requests' => 'None',
                'status' => $statuses[7], // complete
                'is_active' => 0,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => $now,
            ],

            // 8. Message initiated
            [
                'service_id' => 1,
                'user_id' => 5,
                'first_name' => 'Darren',
                'last_name' => 'Rios',
                'phone' => '09176667777',
                'email' => 'darren.driver@example.test',
                'date_start' => date('Y-m-d', strtotime('+5 days')),
                'date_end' => date('Y-m-d', strtotime('+6 days')),
                'additional_requests' => 'Wheelchair Access',
                'status' => $statuses[3], // messaged
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 9. Meeting scheduled with manager
            [
                'service_id' => 2,
                'user_id' => 10,
                'first_name' => 'Martin',
                'last_name' => 'Gale',
                'phone' => '09170001111',
                'email' => 'martin.manager@example.test',
                'date_start' => date('Y-m-d', strtotime('+2 days')),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'additional_requests' => 'Projector',
                'status' => $statuses[4],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 10. Assigned request for staff
            [
                'service_id' => 7,
                'user_id' => 7,
                'first_name' => 'Sofia',
                'last_name' => 'Kent',
                'phone' => '09178889999',
                'email' => 'sofia.staff@example.test',
                'date_start' => date('Y-m-d', strtotime('+9 days')),
                'date_end' => date('Y-m-d', strtotime('+10 days')),
                'additional_requests' => 'Extra Towels',
                'status' => $statuses[5], // assigned
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 11. Not open, no user
            [
                'service_id' => 8,
                'user_id' => null,
                'first_name' => 'Liam',
                'last_name' => 'Hayes',
                'phone' => '09179990000',
                'email' => 'liam.hayes@example.test',
                'date_start' => date('Y-m-d', strtotime('+30 days')),
                'date_end' => date('Y-m-d', strtotime('+31 days')),
                'additional_requests' => null,
                'status' => $statuses[0],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 12. Ongoing with additional requests
            [
                'service_id' => 2,
                'user_id' => 8,
                'first_name' => 'Tina',
                'last_name' => 'Ng',
                'phone' => '09171112222',
                'email' => 'tina.staff@example.test',
                'date_start' => date('Y-m-d', strtotime('-1 days')),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'additional_requests' => 'Signage,PA System',
                'status' => $statuses[6],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 13. Called but no additional requests
            [
                'service_id' => 4,
                'user_id' => 6,
                'first_name' => 'Flora',
                'last_name' => 'Bloom',
                'phone' => '09172223344',
                'email' => 'flora.florist@example.test',
                'date_start' => date('Y-m-d', strtotime('+4 days')),
                'date_end' => date('Y-m-d', strtotime('+5 days')),
                'additional_requests' => null,
                'status' => $statuses[2],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 14. Messaged, with multiple additional requests
            [
                'service_id' => 1,
                'user_id' => 9,
                'first_name' => 'Marco',
                'last_name' => 'Reed',
                'phone' => '09173330011',
                'email' => 'marco.staff@example.test',
                'date_start' => date('Y-m-d', strtotime('+6 days')),
                'date_end' => date('Y-m-d', strtotime('+6 days')),
                'additional_requests' => 'Chairs,Flowers,Wheelchair',
                'status' => $statuses[3],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 15. Assigned and ongoing
            [
                'service_id' => 8,
                'user_id' => 11,
                'first_name' => 'Jordan',
                'last_name' => 'Cole',
                'phone' => '09174440055',
                'email' => 'jordan.cole@example.test',
                'date_start' => date('Y-m-d', strtotime('-3 days')),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'additional_requests' => 'Reception Setup',
                'status' => $statuses[5],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('requests');

            // If table has rows, skip seeding to avoid duplicates
            $existing = 0;
            try {
                $existing = (int) $builder->countAllResults();
            } catch (\Throwable $e) {
                $existing = 0;
            }

            if ($existing === 0) {
                $builder->insertBatch($data);
            }
        } catch (\Exception $e) {
            // swallow errors to avoid interrupting seeding process in different environments
        }
    }
}
