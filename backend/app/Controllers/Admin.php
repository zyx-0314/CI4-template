<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Admin Dashboard',
            'stats' => $this->getDashboardStats(),
        ];

        return view('admin/dashboard', $data);
    }

    private function getDashboardStats(): array
    {
        return [
            'total_users' => 150,
            'active_sessions' => 23,
            'total_posts' => 89,
            'system_health' => 'Good',
        ];
    }
}