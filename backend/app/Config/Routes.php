<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// User exposed pages
$routes->get('/', 'Users::index');
$routes->get('mood-board', 'Users::moodBoard');
$routes->get('road-map', 'Users::roadMap');
$routes->get('services', 'Users::services');
$routes->get('services/(:segment)', 'Users::show/$1');

// Reservations
$routes->get('reservation', 'Reservation::create');
$routes->post('reservation', 'Reservation::store');

// Auth
$routes->get('login', 'Auth::showLogin');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('signup', 'Auth::showSignup');
$routes->post('signup', 'Auth::signup');

// Admin:Manager
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/services', 'Admin::services');
// Create service (AJAX)
$routes->post('/admin/services/create', 'Admin::createService');
// Update service (AJAX)
$routes->post('/admin/services/update', 'Admin::updateService');
// Delete service (soft delete via AJAX)
$routes->post('/admin/services/delete', 'Admin::deleteService');

// Employee
$routes->get('employee/dashboard', 'Employee::dashboard');

// Debug
$routes->get('auth-debug', 'Auth::debugCheck');
