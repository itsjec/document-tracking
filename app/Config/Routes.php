<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('getData', 'UserController::getData');
$routes->post('api/login', 'UserController::login');
$routes->get('/getDocu', 'DocuController::getDocu');
$routes->get('/getOffice', 'DocuController::getOffice');
$routes->group('api', function ($routes) {
    $routes->post('documents/insert', 'DocuController::insert');
    $routes->get('documents/last-inserted', 'DocuController::getLastInsertedDocument'); 
    $routes->get('documents/last-inserted-tracking-number', 'DocuController::getLastInsertedTrackingNumber');
    $routes->get('getDocumentsByOfficeID/(:num)', 'DocuController::getDocumentsByOfficeID/$1');
    $routes->get('getPendingDocumentsByOfficeID/(:num)', 'DocuController::getPendingDocumentsByOfficeID/$1');
    $routes->get('getReceivedDocumentsByOfficeID/(:num)', 'DocuController::getReceivedDocumentsByOfficeID/$1');
    $routes->get('getCompletedDocumentsByOfficeID/(:num)', 'DocuController::getCompletedDocumentsByOfficeID/$1');
    $routes->get('getHistoryDocumentsByOfficeID/(:num)', 'DocuController::getHistoryDocumentsByOfficeID/$1');
    $routes->put('approveDocument/(:num)', 'DocuController::approveDocument/$1');
    $routes->put('completeDocument/(:num)', 'DocuController::completeDocument/$1');
    $routes->put('deleteDocument/(:num)', 'DocuController::deleteDocument/$1');
    $routes->put('sendOutDocument/(:num)', 'Documents::sendOutDocument/$1');

});

// routes.php
$routes->get('api/searchDocumentByTrackingNumber/(:any)', 'DocuController::searchDocumentByTrackingNumber/$1');


$routes->get('test', function () {
    return 'Test route works!';
});



