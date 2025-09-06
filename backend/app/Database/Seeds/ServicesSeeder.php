<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $services = [
            [
                'title' => 'Traditional Filipino',
                'description' => 'Full traditional Filipino funeral service including wake, vigil, and burial logistics.',
                'inclusions' => 'embalming,coffin,transport,prayers,burial-permit',
                'cost' => '1200.00',
                'banner_image' => null,
                'is_active' => 1,
                'is_available' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Cremation',
                'description' => 'Cremation package with memorial service, urn options, and ashes return.',
                'inclusions' => 'cremation,urn,memorial-service,transport',
                'cost' => '800.00',
                'banner_image' => null,
                'is_active' => 1,
                'is_available' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Green Burial',
                'description' => 'Environmentally friendly burial option with biodegradable materials.',
                'inclusions' => 'biodegradable-coffin,transport,burial-permit',
                'cost' => '900.00',
                'banner_image' => null,
                'is_active' => 1,
                'is_available' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Hybrid Funeral',
                'description' => 'A hybrid service combining elements of burial and cremation to suit family preferences.',
                'inclusions' => 'custom-options,transport,service-coordination',
                'cost' => '1000.00',
                'banner_image' => null,
                'is_active' => 1,
                'is_available' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('services')->insertBatch($services);
    }
}
