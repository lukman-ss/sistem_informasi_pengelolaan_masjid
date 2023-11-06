<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('berita', ['namespace' => 'App\Modules\Berita\Controllers'], function($subroutes){

    /*** Route for Berita ***/
    $subroutes->add('/', 'Berita::index');
    $subroutes->post('store', 'Berita::store');
    $subroutes->post('update', 'Berita::update');
    $subroutes->get('delete/(:any)', 'Berita::delete/$1');

});
