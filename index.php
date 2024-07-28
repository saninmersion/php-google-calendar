<?php

require __DIR__.'/vendor/autoload.php';

session_start();

$router = new \Bramus\Router\Router();
$router->setNamespace('\PhpGoogleCalendar\Controllers');

$router->get('/', 'HomeController@index');
$router->get('/events', 'EventController@index');
$router->post('/events', 'EventController@store');
$router->get('/events/delete', 'EventController@delete');
$router->get('/logout', 'HomeController@logout');

$router->run();
