<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('getData', 'UserController::getData');
$routes->post('api/login', 'UserController::login');
$routes->get('getDocumentsByOfficeID', 'DocuController::getDocumentsByOfficeID');
$routes->get('/getDocu', 'DocuController::getDocu');
$routes->get('/getOffice', 'DocuController::getOffice');
$routes->group('api', function ($routes) {
    $routes->post('documents/insert', 'DocuController::insert');
    $routes->get('documents/last-inserted', 'DocuController::getLastInsertedDocument'); // Fix the controller name
    $routes->get('documents/last-inserted-tracking-number', 'DocuController::getLastInsertedTrackingNumber'); // Add this line
});

$routes->get('test', function () {
    return 'Test route works!';
});



