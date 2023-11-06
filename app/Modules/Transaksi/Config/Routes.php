<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('transaksi', ['namespace' => 'App\Modules\Transaksi\Controllers'], function($subroutes){

    /*** Route for Transaksi ***/
    $subroutes->get('/', 'Transaksi::index');
    $subroutes->get('update_valid/(:any)/(:any)', 'Transaksi::update_valid/$1/$2');
    $subroutes->post('user_insert_transaksi', 'Transaksi::user_insert_transaksi');

});
