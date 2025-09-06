<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Employee extends BaseController
{
    /**
     * Simple frontend-only dashboard for employee users (session-based)
     */
    public function dashboard()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $user = $session->get('user');
        $userArr = is_array($user) ? $user : (method_exists($user, 'toArray') ? $user->toArray() : (array) $user);

        return view('employee/dashboard', ['user' => $userArr]);
    }
}
