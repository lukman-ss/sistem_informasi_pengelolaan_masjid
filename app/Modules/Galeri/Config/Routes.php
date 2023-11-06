<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('galeri', ['namespace' => 'App\Modules\Galeri\Controllers'], function($subroutes){

    /*** Route for Galeri ***/
    $subroutes->add('/', 'Galeri::index');
    $subroutes->post('store', 'Galeri::store');
    $subroutes->post('update', 'Galeri::update');
    $subroutes->get('delete/(:any)', 'Galeri::delete/$1');

});
