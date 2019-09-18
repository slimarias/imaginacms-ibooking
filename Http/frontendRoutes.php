<?php

use Illuminate\Routing\Router;


if (! App::runningInConsole()) {
   
    $router->group(['prefix' => trans('ibooking::common.uri')], function (Router $router){
            
            $locale = LaravelLocalization::setLocale() ?: App::getLocale();

            $router->get('/', [
                'as' => $locale . '.ibooking.event',
                'uses' => 'PublicController@index',
            ]); 

            $router->get('{slug}', [
                'as' => $locale . '.ibooking.event.slug',
                'uses' => 'PublicController@show',
            ]);

            $router->get('{eventslug}/giftcard', [
                'as' => $locale . '.ibooking.event.giftcard',
                'uses' => 'PublicController@giftcard',
            ]);

            $router->post('/reservation/create', [
                'as' => 'ibooking.reservation.create',
                'uses' => 'PublicController@reservationCreate',
            ]);

           
 
    });

    // Routes for tests
    $router->group(['prefix' => 'testing'], function (Router $router){

        $router->get('/email', [
            'as' => 'ibooking.testing.email.new',
            'uses' => 'PublicController@testingEmailNew',
        ]);

    });
    
   
}  