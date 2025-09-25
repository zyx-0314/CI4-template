<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Employee extends BaseController
{
    public function showDashboardPage()
    {
        return view('employee/dashboard');
    }
}
