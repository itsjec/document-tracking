<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('getData', 'UserController::getData');
$routes->post('api/main/register', 'UserController::register');
$routes->post('api/main/login', 'UserController::login');
$routes->get('/getDocu', 'DocuController::getDocu');
$routes->get('/getOffice', 'DocuController::getOffice');
$routes->post('/saveDocument', 'DocuController::saveDocument');
