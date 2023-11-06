<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('login', ['namespace' => 'App\Modules\Login\Controllers'], function($subroutes){

    /*** Route for Login ***/
    $subroutes->add('/', 'Login::index');
    $subroutes->post('process', 'Login::process');

});
