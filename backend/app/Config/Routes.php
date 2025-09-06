<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('mood-board', 'User::moodBoard');
$routes->get('roadmap', 'User::roadmap');
// Auth
$routes->get('login', 'Auth::showLogin');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
// Signup
$routes->get('signup', 'Auth::showSignup');
$routes->post('signup', 'Auth::signup');
// Services pages (dynamic): /services and /services/{style}
$routes->get('services', 'Services::index');
$routes->get('services/(:segment)', 'Services::show/$1');
// Admin
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/services', 'Admin::services');
// Admin services API (backend)
$routes->get('/admin/api/services', 'Admin::servicesList');
$routes->post('/admin/api/services', 'Admin::storeService');
$routes->post('/admin/api/services/(:num)', 'Admin::updateService/$1');
$routes->delete('/admin/api/services/(:num)', 'Admin::deleteService/$1');
// Settings
$routes->get('settings/profile', 'Settings::profile');
// Employee
$routes->get('employee/dashboard', 'Employee::dashboard');
