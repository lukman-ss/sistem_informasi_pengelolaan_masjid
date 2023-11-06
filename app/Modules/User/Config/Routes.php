<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('user', ['namespace' => 'App\Modules\User\Controllers'], function($subroutes){

    /*** Route for User ***/
    $subroutes->add('/', 'User::index');
    $subroutes->post('store', 'User::store');
    $subroutes->post('update', 'User::update');
    $subroutes->get('delete/(:any)', 'User::delete/$1');


});
