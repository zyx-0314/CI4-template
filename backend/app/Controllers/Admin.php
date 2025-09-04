<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function dashboard()
    {
        // Minimal data for the dashboard now; components will fetch their own info
        return view('admin/dashboard');
    }
}
