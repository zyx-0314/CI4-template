<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AdminDashboardViewTest extends TestCase
{
    public function testAdminDashboardViewExists()
    {
        $viewPath = '/home/runner/work/CI4-template/CI4-template/backend/app/Views/admin/dashboard.php';
        $this->assertFileExists($viewPath);
    }

    public function testAdminDashboardViewRendersWithValidData()
    {
        $title = 'Test Admin Dashboard';
        $stats = [
            'total_users' => 100,
            'active_sessions' => 15,
            'total_posts' => 50,
            'system_health' => 'Excellent',
        ];

        // Define constants for testing
        if (!defined('ENVIRONMENT')) {
            define('ENVIRONMENT', 'testing');
        }

        // Extract variables for the view
        extract(compact('title', 'stats'));

        // Capture view output
        ob_start();
        include '/home/runner/work/CI4-template/CI4-template/backend/app/Views/admin/dashboard.php';
        $output = ob_get_clean();

        // Assertions
        $this->assertStringContainsString('Test Admin Dashboard', $output);
        $this->assertStringContainsString('100', $output);
        $this->assertStringContainsString('15', $output);
        $this->assertStringContainsString('50', $output);
        $this->assertStringContainsString('Excellent', $output);
        $this->assertStringContainsString('tailwindcss.com', $output);
        $this->assertStringContainsString('Total Users', $output);
        $this->assertStringContainsString('Active Sessions', $output);
        $this->assertStringContainsString('System Health', $output);
    }

    public function testAdminDashboardViewHasRequiredSections()
    {
        $title = 'Admin Dashboard';
        $stats = [
            'total_users' => 150,
            'active_sessions' => 23,
            'total_posts' => 89,
            'system_health' => 'Good',
        ];

        // Extract variables for the view
        extract(compact('title', 'stats'));

        // Capture view output
        ob_start();
        include '/home/runner/work/CI4-template/CI4-template/backend/app/Views/admin/dashboard.php';
        $output = ob_get_clean();

        // Check for required sections
        $this->assertStringContainsString('Recent Activity', $output);
        $this->assertStringContainsString('Quick Actions', $output);
        $this->assertStringContainsString('System Information', $output);
        $this->assertStringContainsString('Dashboard Overview', $output);
        
        // Check for navigation elements
        $this->assertStringContainsString('Dashboard', $output);
        $this->assertStringContainsString('Users', $output);
        $this->assertStringContainsString('Settings', $output);
        
        // Check for action buttons
        $this->assertStringContainsString('Add User', $output);
        $this->assertStringContainsString('Create Post', $output);
        $this->assertStringContainsString('System Backup', $output);
        $this->assertStringContainsString('View Logs', $output);
    }
}