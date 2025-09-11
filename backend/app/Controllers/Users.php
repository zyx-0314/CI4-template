<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;

class Users extends BaseController
{
    private $DUMMY_SERVICES = [
        ['id' => 1, 'title' => 'Basic Funeral Package', 'description' => 'Simple service with chapel of rest', 'cost' => 15000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Flowers', 'banner_image' => null],
        ['id' => 2, 'title' => 'Standard Funeral Package', 'description' => 'Includes viewing and basic catering', 'cost' => 30000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Catering', 'banner_image' => null],
        ['id' => 3, 'title' => 'Premium Funeral Package', 'description' => 'Full service with extended amenities', 'cost' => 60000, 'is_available' => 0, 'is_active' => 1, 'inclusions' => 'Chapel,Limo,Catering,Program', 'banner_image' => null],
        ['id' => 4, 'title' => 'Cremation Service', 'description' => 'Cremation-only service', 'cost' => 12000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Cremation Certificate', 'banner_image' => null],
        ['id' => 5, 'title' => 'Memorial Only', 'description' => 'Memorial service without remains', 'cost' => 8000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Venue,Sound System', 'banner_image' => null],
        ['id' => 6, 'title' => 'Archived Package', 'description' => 'Old package no longer available', 'cost' => 5000, 'is_available' => 0, 'is_active' => 0, 'inclusions' => '', 'banner_image' => null],
        ['id' => 7, 'title' => 'Express Service', 'description' => 'Quick handling and burial', 'cost' => 7000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Hearse', 'banner_image' => null],
        ['id' => 8, 'title' => 'Deluxe with Reception', 'description' => 'Includes reception after service', 'cost' => 45000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Reception,Catering,Program', 'banner_image' => null],
    ];

    public function index(): string
    {
        try {
            $model = new ServicesModel();
            $services = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
        } catch (\Exception $e) {
            // Fallback to in-memory demo data when DB is not available
            $services = $this->DUMMY_SERVICES;
        }
        return view('user/landing', ['services' => $services]);
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
        try {
            $model = new ServicesModel();
            $services = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
        } catch (\Exception $e) {
            // Fallback to in-memory demo data when DB is not available
            $services = $this->DUMMY_SERVICES;
        }

        return view('user/services', ['services' => $services]);
    }

    public function show($id = null)
    {
        $service = null;
        try {
            $model = new ServicesModel();
            $service = $model->find($id);
            if ($service) $service = $service->toArray();
        } catch (\Exception $e) {
            // fallback to in-memory
            foreach ($this->DUMMY_SERVICES as $s) {
                if ((string)$s['id'] === (string)$id) {
                    $service = $s;
                    break;
                }
            }
        }

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Service not found');
        }

        return view('user/service_show', ['service' => $service]);
    }
}
