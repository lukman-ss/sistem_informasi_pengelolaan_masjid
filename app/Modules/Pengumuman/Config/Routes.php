<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('pengumuman', ['namespace' => 'App\Modules\Pengumuman\Controllers'], function($subroutes){

    /*** Route for Pengumuman ***/
    $subroutes->add('/', 'Pengumuman::index');
    $subroutes->post('store', 'Pengumuman::store');
    $subroutes->post('update', 'Pengumuman::update');
    $subroutes->get('delete/(:any)', 'Pengumuman::delete/$1');

});
