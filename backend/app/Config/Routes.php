<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('mood-board', 'User::moodBoard');
$routes->get('roadmap', 'User::roadmap');
