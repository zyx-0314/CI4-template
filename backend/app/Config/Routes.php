<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// User exposed pages
$routes->get('/', 'Users::index');
$routes->get('mood-board', 'Users::moodBoard');
$routes->get('road-map', 'Users::roadMap');
