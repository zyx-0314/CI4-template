<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;

class Users extends BaseController
{
    public function index(): string
    {
        try {
            // Persist service to database using ServicesModel
            $model = new ServicesModel();

            // Query Builder Searching for availble Services the Data in Database
            $services = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
        } catch (\Exception $e) {
            // Incase a issue with the system appear
            $services = "Server Issue: " . $e;
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
            // Persist service to database using ServicesModel
            $model = new ServicesModel();

            // Query Builder Searching for availble Services the Data in Database
            $services = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
        } catch (\Exception $e) {
            // Incase a issue with the system appear
            $services = "Server Issue: " . $e;
        }

        return view('user/services', ['services' => $services]);
    }

    public function showSpecificService($id = null)
    {
        try {
            // Persist service to database using ServicesModel
            $model = new ServicesModel();

            // Query Builder Searching for specific Service in Database
            $service = $model->find($id);
        } catch (\Exception $e) {
            // Incase a issue with the system appear
            $service = "Server Issue: " . $e;
        }

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Service not found');
        }

        return view('user/service_show', ['service' => $service]);
    }
}
