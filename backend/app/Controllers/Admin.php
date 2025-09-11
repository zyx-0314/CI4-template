<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function services()
    {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');
            $services = $builder
                ->where('is_active', 1)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();
            return view('admin/services', ['services' => $services]);
        } catch (\Exception $e) {
            // If DB not available, let the view fall back to its demo dataset
            return view('admin/services');
        }
    }
}
