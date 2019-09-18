<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/days'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.ibooking.days.create',
    'uses' => 'DayApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.ibooking.days.index',
    'uses' => 'DayApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.ibooking.days.update',
    'uses' => 'DayApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.ibooking.days.delete',
    'uses' => 'DayApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.ibooking.days.show',
    'uses' => 'DayApiController@show',
  ]);

  $router->get('/availability/get', [
    'as' => $locale . 'api.ibooking.availability',
    'uses' => 'DayApiController@availability'
  ]);


});