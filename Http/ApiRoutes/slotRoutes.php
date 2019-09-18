<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/slots'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.ibooking.slots.create',
    'uses' => 'SlotApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.ibooking.slots.index',
    'uses' => 'SlotApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.ibooking.slots.update',
    'uses' => 'SlotApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.ibooking.slots.delete',
    'uses' => 'SlotApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.ibooking.slots.show',
    'uses' => 'SlotApiController@show',
  ]);

});