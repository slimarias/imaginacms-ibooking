<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/plans'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.ibooking.plans.create',
    'uses' => 'PlanApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.ibooking.plans.index',
    'uses' => 'PlanApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.ibooking.plans.update',
    'uses' => 'PlanApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.ibooking.plans.delete',
    'uses' => 'PlanApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.ibooking.plans.show',
    'uses' => 'PlanApiController@show',
  ]);

});