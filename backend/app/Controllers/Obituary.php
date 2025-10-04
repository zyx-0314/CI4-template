<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Obituary extends BaseController
{
    public function index()
    {
        // Sample obituary data for demonstration using ObituaryRequestModel structure
        $data = [
            'obituaries' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'middle_name' => null,
                    'last_name' => 'Doe',
                    'date_of_birth' => '1950-01-01',
                    'date_of_death' => '2024-12-31',
                    'profile_image' => 'https://www.treasury.gov.ph/wp-content/uploads/2022/01/male-placeholder-image.jpeg',
                    'description' => 'Beloved husband, father, and grandfather. A longtime engineer and community volunteer.',
                    'viewing_date_time' => '2025-01-05 14:00:00',
                    'viewing_place' => 'Sunset Funeral Home Chapel',
                    'funeral_date_time' => '2025-01-06 10:00:00',
                    'funeral_place' => 'St. Mary\'s Church',
                    'burial_date_time' => '2025-01-06 12:00:00',
                    'burial_place' => 'Peaceful Rest Cemetery',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/1/memory1.png',
                            'title' => 'Kind neighbor',
                            'descriptions' => 'Always looked out for the neighborhood and shared stories of the past.'
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'wife',
                            'first_name' => 'Mary',
                            'middle_initial' => null,
                            'last_name' => 'Doe',
                        ],
                        [
                            'relation' => 'daughter',
                            'first_name' => 'Sarah',
                            'middle_initial' => null,
                            'last_name' => 'Doe',
                        ],
                    ],
                    'status' => 'published',
                ],
                [
                    'id' => 2,
                    'first_name' => 'Jane',
                    'middle_name' => null,
                    'last_name' => 'Smith',
                    'date_of_birth' => '1955-03-15',
                    'date_of_death' => '2024-12-28',
                    'profile_image' => 'https://www.treasury.gov.ph/wp-content/uploads/2022/01/female-placeholder-image.png',
                    'description' => 'Jane Smith dedicated over 30 years to teaching. She was a devoted mother and community volunteer.',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/2/memory1.png',
                            'title' => 'Teaching days',
                            'descriptions' => 'Cherished moments in the classroom and with students.'
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'children',
                            'first_name' => null,
                            'middle_initial' => null,
                            'last_name' => null,
                        ],
                    ],
                    'status' => 'published',
                ],
            ],
        ];

        return view('obituary/obituaryList', $data);
    }

    public function showClassic($id = null)
    {
        $obituary = $this->getSampleObituaryData($id ?? 1, 'classic');
        return view('obituary/classic', ['obituary' => $obituary]);
    }

    public function showModern($id = null)
    {
        $obituary = $this->getSampleObituaryData($id ?? 2, 'modern');
        return view('obituary/modern', ['obituary' => $obituary]);
    }

    public function showElegant($id = null)
    {
        $obituary = $this->getSampleObituaryData($id ?? 3, 'elegant');
        return view('obituary/elegant', ['obituary' => $obituary]);
    }

    public function showMinimalist($id = null)
    {
        $obituary = $this->getSampleObituaryData($id ?? 4, 'minimalist');
        return view('obituary/minimalist', ['obituary' => $obituary]);
    }

    public function showTimeline($id = null)
    {
        $obituary = $this->getSampleObituaryData($id ?? 5, 'timeline');
        return view('obituary/timeline', ['obituary' => $obituary]);
    }

    private function getSampleObituaryData($id, $design_type)
    {
        // Sample data - shaped to match ObituaryRequestModel fields
        $base_data = [
            'id' => $id ?? 1,
            'first_name' => null,
            'middle_name' => null,
            'last_name' => null,
            'date_of_birth' => null,
            'date_of_death' => null,
            'profile_image' => 'https://www.treasury.gov.ph/wp-content/uploads/2022/01/male-placeholder-image.jpeg',
            'description' => null,
            'viewing_date_time' => null,
            'viewing_place' => null,
            'funeral_date_time' => null,
            'funeral_place' => null,
            'burial_date_time' => null,
            'burial_place' => null,
            'status' => 'published',
            'treasured_memories' => [],
            'family' => [],
        ];

        switch ($design_type) {
            case 'classic':
                return array_merge($base_data, [
                    'first_name' => 'John',
                    'middle_name' => null,
                    'last_name' => 'Doe',
                    'date_of_birth' => '1950-01-01',
                    'date_of_death' => '2024-12-31',
                    'viewing_date_time' => '2025-01-05 14:00:00',
                    'viewing_place' => 'Saint Marys Chapel',
                    'funeral_date_time' => '2025-01-06 10:00:00',
                    'funeral_place' => 'Saint Marys Chapel',
                    'burial_date_time' => '2025-01-06 12:00:00',
                    'burial_place' => 'Saint Marys Columbarium',
                    'description' => 'It is with heavy hearts that we announce the peaceful passing of John Doe, beloved husband, father, and grandfather.',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/classic/1.png',
                            'title' => 'Early Years',
                            'descriptions' => 'Born in Springfield and worked as an engineer for 40+ years',
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'wife',
                            'first_name' => 'Mary',
                            'middle_initial' => null,
                            'last_name' => 'Doe',
                        ],
                    ],
                    'status' => 'published',
                ]);

            case 'modern':
                return array_merge($base_data, [
                    'first_name' => 'Jane',
                    'middle_name' => null,
                    'last_name' => 'Smith',
                    'date_of_birth' => '1955-03-15',
                    'date_of_death' => '2024-12-28',
                    'description' => 'Jane Smith dedicated over 30 years to teaching. She was a devoted mother and community volunteer.',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/modern/1.png',
                            'title' => 'Teaching days',
                            'descriptions' => 'Cherished moments in the classroom and with students.',
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'children',
                            'first_name' => null,
                            'middle_initial' => null,
                            'last_name' => null,
                        ],
                    ],
                    'status' => 'published',
                ]);

            case 'elegant':
                return array_merge($base_data, [
                    'first_name' => 'Margaret',
                    'middle_name' => 'Rose',
                    'last_name' => 'Williams',
                    'date_of_birth' => '1945-06-12',
                    'date_of_death' => '2024-12-20',
                    'description' => 'With profound sadness and beautiful memories, we announce the peaceful passing of Margaret Rose Williams.',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/elegant/1.png',
                            'title' => 'Gardener & Teacher',
                            'descriptions' => 'Beloved teacher and gardener',
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'husband',
                            'first_name' => 'Robert',
                            'middle_initial' => null,
                            'last_name' => 'Williams',
                        ],
                    ],
                    'status' => 'published',
                ]);

            case 'minimalist':
                return array_merge($base_data, [
                    'first_name' => 'Robert',
                    'middle_name' => 'James',
                    'last_name' => 'Thompson',
                    'date_of_birth' => '1952-01-01',
                    'date_of_death' => '2024-12-15',
                    'description' => 'Robert James Thompson, beloved father, grandfather, and friend, passed away peacefully.',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/minimalist/1.png',
                            'title' => 'Environment Advocate',
                            'descriptions' => 'Lifelong advocate for the environment',
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'wife',
                            'first_name' => 'Linda',
                            'middle_initial' => null,
                            'last_name' => 'Thompson',
                        ],
                    ],
                    'status' => 'published',
                ]);

            case 'timeline':
                return array_merge($base_data, [
                    'first_name' => 'Emily',
                    'middle_name' => 'Catherine',
                    'last_name' => 'Johnson',
                    'date_of_birth' => '1960-01-01',
                    'date_of_death' => '2024-01-01',
                    'description' => 'Dr. Emily Catherine Johnson was a physician, mother, and humanitarian.',
                    'viewing_date_time' => '2025-02-10 14:00:00',
                    'viewing_place' => 'Harborview Funeral Home Chapel',
                    'funeral_date_time' => '2025-02-11 10:00:00',
                    'funeral_place' => 'St. Luke\'s Church',
                    'burial_date_time' => '2025-02-11 12:00:00',
                    'burial_place' => 'Greenwood Cemetery',
                    'treasured_memories' => [
                        [
                            'img' => '/uploads/memories/timeline/1.png',
                            'title' => 'Free Clinic',
                            'descriptions' => 'Founded free clinic to serve the community',
                        ],
                    ],
                    'family' => [
                        [
                            'relation' => 'husband',
                            'first_name' => 'Robert',
                            'middle_initial' => null,
                            'last_name' => null,
                        ],
                    ],
                    'status' => 'published',
                ]);

            default:
                return $base_data;
        }
    }
}
