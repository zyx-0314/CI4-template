<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'title' => 'Basic Funeral Package', 'description' => 'Simple service with chapel of rest', 'cost' => 15000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Flowers', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 2, 'title' => 'Standard Funeral Package', 'description' => 'Includes viewing and basic catering', 'cost' => 30000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Catering', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 3, 'title' => 'Premium Funeral Package', 'description' => 'Full service with extended amenities', 'cost' => 60000, 'is_available' => 0, 'is_active' => 1, 'inclusions' => 'Chapel,Limo,Catering,Program', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 4, 'title' => 'Cremation Service', 'description' => 'Cremation-only service', 'cost' => 12000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Cremation Certificate', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 5, 'title' => 'Memorial Only', 'description' => 'Memorial service without remains', 'cost' => 8000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Venue,Sound System', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 6, 'title' => 'Archived Package', 'description' => 'Old package no longer available', 'cost' => 5000, 'is_available' => 0, 'is_active' => 0, 'inclusions' => '', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 7, 'title' => 'Express Service', 'description' => 'Quick handling and burial', 'cost' => 7000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Hearse', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
            ['id' => 8, 'title' => 'Deluxe with Reception', 'description' => 'Includes reception after service', 'cost' => 45000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Reception,Catering,Program', 'banner_image' => null, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null],
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');

            // If table has rows, skip seeding to avoid duplicates
            $existing = 0;
            try {
                $existing = (int) $builder->countAllResults();
            } catch (\Throwable $e) {
                // table may not exist yet or driver doesn't support countAllResults this way; fallback to insert
                $existing = 0;
            }

            if ($existing === 0) {
                $builder->insertBatch($data);
            }
        } catch (\Exception $e) {
            // swallow errors to avoid interrupting the seeding process in different environments
        }
    }
}

