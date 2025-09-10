<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    private $DUMMY_SERVICES = [
        ['id' => 1, 'title' => 'Basic Funeral Package', 'description' => 'Simple service with chapel of rest', 'cost' => 15000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Flowers'],
        ['id' => 2, 'title' => 'Standard Funeral Package', 'description' => 'Includes viewing and basic catering', 'cost' => 30000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Catering'],
        ['id' => 3, 'title' => 'Premium Funeral Package', 'description' => 'Full service with extended amenities', 'cost' => 60000, 'is_available' => 0, 'is_active' => 1, 'inclusions' => 'Chapel,Limo,Catering,Program'],
        ['id' => 4, 'title' => 'Cremation Service', 'description' => 'Cremation-only service', 'cost' => 12000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Cremation Certificate'],
        ['id' => 5, 'title' => 'Memorial Only', 'description' => 'Memorial service without remains', 'cost' => 8000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Venue,Sound System'],
        ['id' => 6, 'title' => 'Archived Package', 'description' => 'Old package no longer available', 'cost' => 5000, 'is_available' => 0, 'is_active' => 0, 'inclusions' => ''],
        ['id' => 7, 'title' => 'Express Service', 'description' => 'Quick handling and burial', 'cost' => 7000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Hearse'],
        ['id' => 8, 'title' => 'Deluxe with Reception', 'description' => 'Includes reception after service', 'cost' => 45000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Reception,Catering,Program'],
    ];

    public function index(): string
    {
        return view('user/landing', ['services' => $this->DUMMY_SERVICES]);
    }

    public function moodBoard(): string
    {
        return view('user/mood_board');
    }

    public function roadMap(): string
    {
        return view('user/road_map');
    }

    public function services()
    {
        return view('user/services', ['services' => $this->DUMMY_SERVICES]);
    }

    public function show($id = null)
    {
        $service = null;
        foreach ($this->DUMMY_SERVICES as $s) {
            if ((string)$s['id'] === (string)$id) {
                $service = $s;
                break;
            }
        }

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Service not found');
        }

        return view('user/service_show', ['service' => $service]);
    }
}
