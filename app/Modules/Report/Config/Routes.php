<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('report', ['namespace' => 'App\Modules\Report\Controllers'], function($subroutes){

    /*** Route for Report ***/
    $subroutes->add('report', 'Report::index');

});
