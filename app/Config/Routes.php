<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('getData', 'UserController::getData');
$routes->post('api/main/register', 'UserController::register');
$routes->post('api/main/login', 'UserController::login');
