<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('dashboard', ['namespace' => 'App\Modules\Dashboard\Controllers',  'filter' => 'AuthCheck'], function($subroutes){

    /*** Route for Dashboard ***/
    $subroutes->add('/', 'Dashboard::index');

});
