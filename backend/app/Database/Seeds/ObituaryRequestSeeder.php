<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObituaryRequestSeeder extends Seeder
{
    public function run()
    {
        $now = new \DateTime();

        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $status = ($i % 2 === 0) ? 'confirmed' : 'request';
            $types = ['classic', 'modern', 'elegant', 'minimalist', 'timeline'];
            $type = $types[($i - 1) % count($types)];

            $treasured = [
                [
                    'img' => '/uploads/memories/' . $i . '/memory1.png',
                    'title' => "Memory {$i}-1",
                    'descriptions' => 'Some treasured memory description',
                ],
            ];

            $family = [
                [
                    'relation' => 'spouse',
                    'relative' => 'Relative ' . $i,
                ],
            ];

            $dob = (clone $now)->modify('-' . (30 + $i) . ' years')->format('Y-m-d');
            $dod = (clone $now)->modify('-' . (1 + $i) . ' years')->format('Y-m-d');

            $data[] = [
                'first_name' => "First{$i}",
                'middle_name' => "Middle{$i}",
                'last_name' => "Last{$i}",
                'date_of_birth' => $dob,
                'date_of_death' => $dod,
                'profile_image' => '/uploads/profiles/' . $i . '.png',
                'description' => 'Description for obituary request ' . $i,
                'viewing_date_time' => (clone $now)->modify('+' . $i . ' days')->format('Y-m-d H:i:s'),
                'viewing_place' => "Viewing Place {$i}",
                'funeral_date_time' => (clone $now)->modify('+' . ($i + 1) . ' days')->format('Y-m-d H:i:s'),
                'funeral_place' => "Funeral Place {$i}",
                'burial_date_time' => (clone $now)->modify('+' . ($i + 2) . ' days')->format('Y-m-d H:i:s'),
                'burial_place' => "Burial Place {$i}",
                'status' => $status,
                'obituary_type' => $type,
                'treasured_memories' => json_encode($treasured),
                'family' => json_encode($family),
                'created_at' => $now->format('Y-m-d H:i:s'),
                'updated_at' => $now->format('Y-m-d H:i:s'),
            ];
        }

        // Insert batch
        $this->db->table('obituaryrequests')->insertBatch($data);
    }
}
