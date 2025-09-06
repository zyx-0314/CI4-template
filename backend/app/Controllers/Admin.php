<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\FuneralRequestModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        // Gather simple counts for the admin dashboard. If tables or DB
        // are not available yet, fall back to zero so the UI stays stable.
        $servicesModel = new ServicesModel();
        $funeralModel  = new FuneralRequestModel();

        $totalServices   = 0;
        $totalInquiries  = 0;
        $upcomingServices = 0;

        try {
            $totalServices = $servicesModel->countAllResults();
        } catch (\Throwable $e) {
            // ignore and leave default 0
        }

        try {
            $totalInquiries = $funeralModel->countAllResults();
            $today = date('Y-m-d');
            $upcomingServices = $funeralModel
                ->where('preferred_date >=', $today)
                ->where('status !=', 'completed')
                ->countAllResults();
        } catch (\Throwable $e) {
            // ignore and leave defaults
        }

        return view('admin/dashboard', [
            'totalServices'    => $totalServices,
            'totalInquiries'   => $totalInquiries,
            'upcomingServices' => $upcomingServices,
        ]);
    }

    /**
     * Show admin services management (static for now)
     */
    public function services()
    {
        // If you want to make this dynamic later, replace with ServicesModel fetch.
        return view('admin/services');
    }
}
