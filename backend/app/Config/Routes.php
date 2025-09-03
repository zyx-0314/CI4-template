<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('mood-board', 'User::moodBoard');
$routes->get('roadmap', 'User::roadmap');
// Services pages (dynamic): /services and /services/{style}
$routes->get('services', 'User::services');
$routes->get('services/(:segment)', 'User::services/$1');
