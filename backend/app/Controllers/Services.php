<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function index()
    {
        // Static list for now
        $data = [
            'services' => [
                [
                    'slug' => 'traditional-filipino',
                    'title' => 'Traditional Filipino',
                    'summary' => 'Full traditional Filipino funeral service including wake, vigil, and burial logistics.',
                    'cost' => '1200.00',
                ],
                [
                    'slug' => 'cremation',
                    'title' => 'Cremation',
                    'summary' => 'Cremation package with memorial service, urn options, and ashes return.',
                    'cost' => '800.00',
                ],
                [
                    'slug' => 'green-burial',
                    'title' => 'Green Burial',
                    'summary' => 'Environmentally friendly burial option with biodegradable materials.',
                    'cost' => '900.00',
                ],
                [
                    'slug' => 'hybrid-funeral',
                    'title' => 'Hybrid Funeral',
                    'summary' => 'A hybrid service combining elements of burial and cremation to suit family preferences.',
                    'cost' => '1000.00',
                ],
            ],
        ];

        return view('services/index', $data);
    }

    public function show(string $slug)
    {
        // Static lookup
        $map = [
            'traditional-filipino' => [
                'title' => 'Traditional Filipino',
                'description' => 'Traditional Filipino funeral services including wakes, vigils, and full burial logistics.',
                'inclusions' => 'embalming,coffin,transport,prayers,burial-permit',
                'cost' => '1200.00',
            ],
            'cremation' => [
                'title' => 'Cremation',
                'description' => 'Cremation package with memorial service and urn options.',
                'inclusions' => 'cremation,urn,memorial-service,transport',
                'cost' => '800.00',
            ],
            'green-burial' => [
                'title' => 'Green Burial',
                'description' => 'Environmentally friendly burial option with biodegradable materials.',
                'inclusions' => 'biodegradable-coffin,transport,burial-permit',
                'cost' => '900.00',
            ],
            'hybrid-funeral' => [
                'title' => 'Hybrid Funeral',
                'description' => 'A hybrid service combining elements of burial and cremation.',
                'inclusions' => 'custom-options,transport,service-coordination',
                'cost' => '1000.00',
            ],
        ];

        if (! array_key_exists($slug, $map)) {
            return redirect()->to('/services');
        }

        $data = $map[$slug];
        $data['slug'] = $slug;

        return view('services/show', $data);
    }
}
