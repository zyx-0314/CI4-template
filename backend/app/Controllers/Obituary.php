<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Obituary extends BaseController
{
    /**
     * Show obituary listing page
     */
    public function index()
    {
        // Sample obituary data for demonstration
        $data = [
            'obituaries' => [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'birth_date' => 'January 1, 1950',
                    'death_date' => 'December 31, 2024',
                    'photo' => '/logo/default-profile.jpg',
                    'preview' => 'Beloved husband, father, and grandfather...'
                ],
                [
                    'id' => 2,
                    'name' => 'Jane Smith',
                    'birth_date' => 'March 15, 1955',
                    'death_date' => 'December 28, 2024',
                    'photo' => '/logo/default-profile.jpg',
                    'preview' => 'Beloved mother, teacher, and friend...'
                ]
            ]
        ];

        return view('obituary/index', $data);
    }

    /**
     * Show specific obituary design - Classic
     */
    public function showClassic($id = null)
    {
        $data = [
            'obituary' => $this->getSampleObituaryData($id, 'classic')
        ];

        return view('obituary/classic', $data);
    }

    /**
     * Show specific obituary design - Modern
     */
    public function showModern($id = null)
    {
        $data = [
            'obituary' => $this->getSampleObituaryData($id, 'modern')
        ];

        return view('obituary/modern', $data);
    }

    /**
     * Show specific obituary design - Elegant
     */
    public function showElegant($id = null)
    {
        $data = [
            'obituary' => $this->getSampleObituaryData($id, 'elegant')
        ];

        return view('obituary/elegant', $data);
    }

    /**
     * Show specific obituary design - Minimalist
     */
    public function showMinimalist($id = null)
    {
        $data = [
            'obituary' => $this->getSampleObituaryData($id, 'minimalist')
        ];

        return view('obituary/minimalist', $data);
    }

    /**
     * Show specific obituary design - Timeline
     */
    public function showTimeline($id = null)
    {
        $data = [
            'obituary' => $this->getSampleObituaryData($id, 'timeline')
        ];

        return view('obituary/timeline', $data);
    }

    /**
     * Get sample obituary data based on design type
     * In production, this would fetch from database
     */
    private function getSampleObituaryData($id, $design_type)
    {
        // Sample data - in production this would come from database
        $base_data = [
            'id' => $id ?? 1,
            'photo' => '/logo/default-profile.jpg',
        ];

        switch ($design_type) {
            case 'classic':
                return array_merge($base_data, [
                    'name' => 'John Doe',
                    'birth_date' => 'January 1, 1950',
                    'death_date' => 'December 31, 2024',
                    'age' => '74',
                    'obituary_text' => 'It is with heavy hearts that we announce the peaceful passing of John Doe, beloved husband, father, and grandfather. John passed away surrounded by his loving family on December 31, 2024, at the age of 74.',
                    'life_story' => 'Born in Springfield on January 1, 1950, John lived a full and meaningful life dedicated to his family and community. He worked for over 40 years as an engineer and was known for his kindness, wisdom, and infectious laugh.',
                    'family_info' => 'John is survived by his loving wife of 50 years, Mary; his children Sarah (Mike) and David (Jennifer); and his cherished grandchildren Emma, Lucas, and Sophie. He was preceded in death by his parents and his brother Robert.',
                    'viewing_date' => 'January 5, 2025 - 2:00 PM to 6:00 PM',
                    'viewing_location' => 'Sunset Funeral Home Chapel',
                    'service_date' => 'January 6, 2025 - 10:00 AM',
                    'service_location' => 'St. Mary\'s Church',
                    'burial_date' => 'January 6, 2025 - 12:00 PM',
                    'burial_location' => 'Peaceful Rest Cemetery',
                    'charity_name' => 'American Heart Association',
                    'charity_address' => '123 Charity Lane, Springfield, IL 62701',
                    'guestbook' => []
                ]);

            case 'modern':
                return array_merge($base_data, [
                    'name' => 'Jane Smith',
                    'birth_date' => 'March 15, 1955',
                    'death_date' => 'December 28, 2024',
                    'subtitle' => 'Beloved Mother, Teacher, and Friend',
                    'opening' => 'Jane Smith, age 69, passed peacefully surrounded by loved ones on December 28, 2024. Her life was a testament to compassion, dedication, and the power of education to change lives.',
                    'early_life' => 'Born in Chicago, Jane dedicated over 30 years to teaching elementary school, touching the lives of hundreds of students. She believed every child had potential waiting to be unlocked.',
                    'family_passions' => 'A devoted mother of three and grandmother of seven, Jane loved gardening, painting watercolors, and volunteering at the local animal shelter.',
                    'visitation' => 'January 3, 2025, 4-8 PM',
                    'visitation_location' => 'Sunset Funeral Home',
                    'memorial_service' => 'January 4, 2025, 2:00 PM',
                    'memorial_location' => 'First Presbyterian Church',
                    'gallery' => [
                        ['src' => '/logo/default-profile.jpg', 'caption' => 'Teaching days'],
                        ['src' => '/logo/default-profile.jpg', 'caption' => 'Family vacation'],
                        ['src' => '/logo/default-profile.jpg', 'caption' => 'Graduation ceremony'],
                        ['src' => '/logo/default-profile.jpg', 'caption' => 'Garden flowers']
                    ],
                    'messages' => []
                ]);

            case 'elegant':
                return array_merge($base_data, [
                    'name' => 'Margaret Rose Williams',
                    'birth_date' => 'June 12, 1945',
                    'death_date' => 'December 20, 2024',
                    'quote' => 'Love never ends',
                    'intro' => 'With profound sadness and beautiful memories, we announce the peaceful passing of our beloved Margaret Rose Williams.',
                    'summary' => 'Margaret was a beacon of love, grace, and wisdom who touched countless lives throughout her 79 years. Her legacy of compassion and joy will forever bloom in the hearts of those who knew her.',
                    'early_life' => 'Born in the spring of 1945 in Portland, Oregon, Margaret grew up surrounded by the beauty of nature that would inspire her lifelong love of gardening and flowers.',
                    'career' => 'After graduating from Oregon State University with a degree in Elementary Education, Margaret devoted 35 years to teaching young minds.',
                    'family' => 'In 1968, she married her college sweetheart, Robert Williams, and together they built a loving home filled with laughter, music, and the aroma of her famous apple pies.',
                    'visitation_date' => 'December 23, 2024',
                    'visitation_time' => '2:00 PM - 7:00 PM',
                    'visitation_location' => 'Sunset Funeral Home',
                    'service_date' => 'December 24, 2024',
                    'service_time' => '11:00 AM',
                    'service_location' => 'Grace Community Church',
                    'charity1' => 'Children\'s Education Fund',
                    'charity1_desc' => 'Supporting local schools',
                    'charity2' => 'Community Garden Project',
                    'charity2_desc' => 'Beautifying neighborhoods',
                    'survived_by' => 'Loving husband Robert of 56 years; Children: Elizabeth (James), Michael (Sarah), Sarah (David); 8 grandchildren; 2 great-grandchildren; Sister Helen and brother Thomas.',
                    'memories' => [
                        [
                            'name' => 'Former Student',
                            'relationship' => 'Student',
                            'memory' => 'Mrs. Williams taught me in 3rd grade. She made learning magical and always believed in every student. Her flower garden lessons taught me more than just botany - they taught me patience and care.',
                            'date' => '2 days ago'
                        ]
                    ]
                ]);

            case 'minimalist':
                return array_merge($base_data, [
                    'name' => 'Robert James Thompson',
                    'birth_date' => '1952',
                    'death_date' => '2024',
                    'opening' => 'Robert James Thompson, beloved father, grandfather, and friend, passed away peacefully on December 15, 2024, at the age of 72.',
                    'life_summary' => 'Robert was born in Denver, Colorado, where he spent his childhood exploring the Rocky Mountains and developing a deep love for the outdoors.',
                    'career_achievements' => 'After graduating from Colorado State University with a degree in Environmental Science, Robert dedicated 40 years to protecting natural habitats.',
                    'personal_life' => 'Robert married his college sweetheart, Linda, in 1975. Together, they raised two children, Sarah and Michael.',
                    'legacy' => 'Robert\'s legacy lives on through the national parks he helped preserve and the countless lives he touched through his environmental education programs.',
                    'service_date' => 'Saturday, December 21, 2024 at 2:00 PM',
                    'service_location' => 'Mountain View Community Center',
                    'service_address' => '1234 Pine Street, Denver, CO 80202',
                    'survivors' => [
                        'Wife Linda Thompson',
                        'Daughter Sarah Thompson-Miller (James)',
                        'Son Michael Thompson (Jennifer)',
                        'Grandchildren: Emma, Lucas, and Sophia',
                        'Brother David Thompson (Mary)'
                    ],
                    'preceded_by' => [
                        'Parents James and Mary Thompson',
                        'Sister Patricia Thompson-Lee'
                    ],
                    'memorial_charities' => [
                        [
                            'name' => 'National Park Foundation',
                            'description' => 'Protecting America\'s national parks',
                            'website' => 'www.nationalparks.org'
                        ],
                        [
                            'name' => 'Colorado Environmental Coalition',
                            'description' => 'Local environmental conservation efforts',
                            'website' => 'www.ourcolorado.org'
                        ]
                    ],
                    'condolences' => []
                ]);

            case 'timeline':
                return array_merge($base_data, [
                    'name' => 'Dr. Emily Catherine Johnson',
                    'title' => 'Physician • Mother • Humanitarian',
                    'birth_year' => '1960',
                    'death_year' => '2024',
                    'early_life' => 'Born in Boston, Massachusetts, Emily showed an early interest in helping others. As the youngest of four children, she was known for caring for injured animals.',
                    'education' => 'Emily excelled at Harvard University, graduating summa cum laude with a degree in Biology. She then attended Johns Hopkins Medical School.',
                    'career_start' => 'Dr. Johnson began her career at Children\'s Hospital Boston, where she quickly became known for her compassionate care.',
                    'achievements' => [
                        'Chief of Pediatrics (2000-2020)',
                        'Published 50+ research papers',
                        'Established free clinic for underserved children',
                        'Received Humanitarian Award 2015'
                    ],
                    'family_life' => 'Emily married her medical school classmate, Dr. Robert Johnson, in 1985. Together they raised three wonderful children.',
                    'family_survived' => 'Survived by: Husband Robert, children Sarah (Mark), Michael (Jennifer), David (Lisa), and 6 grandchildren',
                    'legacy' => 'Dr. Emily Johnson\'s impact extends far beyond her medical practice. She touched thousands of lives through her compassionate care.',
                    'patients_helped' => '10,000+',
                    'doctors_trained' => '200+',
                    'years_service' => '34',
                    'celebration_date' => 'January 8, 2025 at 2:00 PM',
                    'celebration_location' => 'Boston Convention Center, Grand Ballroom',
                    'burial_info' => 'Family burial service at Mount Auburn Cemetery',
                    'early_photo' => '/logo/default-profile.jpg',
                    'education_photo' => '/logo/default-profile.jpg',
                    'career_photo' => '/logo/default-profile.jpg',
                    'family_photo1' => '/logo/default-profile.jpg',
                    'family_photo2' => '/logo/default-profile.jpg',
                    'family_photo3' => '/logo/default-profile.jpg'
                ]);

            default:
                return $base_data;
        }
    }
}
