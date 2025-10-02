<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// User exposed pages
$routes->get('/', 'Users::index');
$routes->get('/mood-board', 'Users::moodBoard');
$routes->get('/road-map', 'Users::roadMap');
$routes->get('/services', 'Users::services');
$routes->get('/services/(:segment)', 'Users::showSpecificService/$1');

// Reservations
$routes->get('/reservation/(:num)', 'Reservation::showReservationRequestPage/$1');
$routes->post('/reservation/(:num)', 'Reservation::createRequest/$1');

// Obituary Pages
$routes->get('/obituary', 'Obituary::index');
$routes->get('/obituary/classic/(:num)', 'Obituary::showClassic/$1');
$routes->get('/obituary/modern/(:num)', 'Obituary::showModern/$1');
$routes->get('/obituary/elegant/(:num)', 'Obituary::showElegant/$1');
$routes->get('/obituary/minimalist/(:num)', 'Obituary::showMinimalist/$1');
$routes->get('/obituary/timeline/(:num)', 'Obituary::showTimeline/$1');
// Obituary request form & submission
$routes->get('/obituary/request', 'Obituary::requestForm');
$routes->get('/obituary/request/(:num)', 'Obituary::requestForm/$1');
$routes->post('/obituary/request', 'Obituary::submitRequest');

// Auth
$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');

// Settings
$routes->get('/settings/profile', 'Setting::showProfilePage');
$routes->get('/settings/edit', 'Setting::showProfileSettingPage');
$routes->post('/settings/edit', 'Setting::updateProfile');
$routes->post('/settings/send-verification', 'Setting::sendEmailVerification');
$routes->post('/settings/verify-email', 'Setting::verifyEmail');

// Admin:Manager
$routes->get('/admin/dashboard', 'Admin::showDashboardPage');
$routes->get('/admin/inquiries', 'Admin::showInquiriesPage');
$routes->get('/admin/services', 'Admin::showServicesPage');
$routes->get('/admin/accounts', 'Admin::showAccountsPage');
$routes->get('/admin/obituaries', 'Admin::showObituariesPage');
// Create service (AJAX)
$routes->post('/admin/services/create', 'Admin::createService');
// Create account (AJAX)
$routes->post('/admin/accounts/create', 'Admin::createAccounts');
// Update request (AJAX)
$routes->post('/admin/requests/update', 'Admin::updateRequest');
// Update obituary (AJAX)
$routes->post('/admin/obituaries/update', 'Admin::updateObituary');
// Update service (AJAX)
$routes->post('/admin/services/update', 'Admin::updateService');
// Update account (AJAX)
$routes->post('/admin/accounts/update', 'Admin::updateAccount');
// Delete service (soft delete via AJAX)
$routes->post('/admin/services/delete', 'Admin::deleteService');
// Delete account (soft delete via AJAX)
$routes->post('/admin/accounts/delete', 'Admin::deleteAccount');

// Employee
$routes->get('/employee/dashboard', 'Employee::showDashboardPage');

// Debug
$routes->get('/auth-debug', 'Auth::debugCheck');
