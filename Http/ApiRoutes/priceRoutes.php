<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/prices'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.ibooking.prices.create',
    'uses' => 'PriceApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.ibooking.prices.index',
    'uses' => 'PriceApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.ibooking.prices.update',
    'uses' => 'PriceApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.ibooking.prices.delete',
    'uses' => 'PriceApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.ibooking.prices.show',
    'uses' => 'PriceApiController@show',
  ]);

});