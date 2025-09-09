<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase
{
    public function testAdminControllerExists()
    {
        $this->assertTrue(class_exists('App\Controllers\Admin'));
    }

    public function testAdminControllerExtendsBaseController()
    {
        $this->assertTrue(is_subclass_of('App\Controllers\Admin', 'App\Controllers\BaseController'));
    }

    public function testAdminControllerHasIndexMethod()
    {
        $this->assertTrue(method_exists('App\Controllers\Admin', 'index'));
    }

    public function testDashboardStatsStructure()
    {
        $adminController = new \App\Controllers\Admin();
        
        // Use reflection to access private method for testing
        $reflection = new \ReflectionClass($adminController);
        $method = $reflection->getMethod('getDashboardStats');
        $method->setAccessible(true);
        
        $stats = $method->invoke($adminController);
        
        $this->assertIsArray($stats);
        $this->assertArrayHasKey('total_users', $stats);
        $this->assertArrayHasKey('active_sessions', $stats);
        $this->assertArrayHasKey('total_posts', $stats);
        $this->assertArrayHasKey('system_health', $stats);
        
        $this->assertIsInt($stats['total_users']);
        $this->assertIsInt($stats['active_sessions']);
        $this->assertIsInt($stats['total_posts']);
        $this->assertIsString($stats['system_health']);
    }
}