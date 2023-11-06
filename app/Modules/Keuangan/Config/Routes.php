<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('keuangan', ['namespace' => 'App\Modules\Keuangan\Controllers'], function($subroutes){

    /*** Route for Keuangan ***/
    $subroutes->add('keuangan', 'Keuangan::index');

});
