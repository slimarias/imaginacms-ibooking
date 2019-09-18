<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/reservations'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.ibooking.reservations.create',
    'uses' => 'ReservationApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.ibooking.reservations.index',
    'uses' => 'ReservationApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.ibooking.reservations.update',
    'uses' => 'ReservationApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.ibooking.reservations.delete',
    'uses' => 'ReservationApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.ibooking.reservations.show',
    'uses' => 'ReservationApiController@show',
  ]);

});