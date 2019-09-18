<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/frontend'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->get('/findRDS', [
    'as' => $locale . 'api.ibooking.findrds.findrds',
    'uses' => 'FrontendApiController@findrds',
  ]);

  $router->get('/findDaysStatus', [
    'as' => $locale . 'api.ibooking.finddaysstatus',
    'uses' => 'FrontendApiController@findDaysStatus',
  ]);
 

});