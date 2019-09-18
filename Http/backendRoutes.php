<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ibooking'], function (Router $router) {
    $router->bind('event', function ($id) {
        return app('Modules\Ibooking\Repositories\EventRepository')->find($id);
    });
    $router->get('events', [
        'as' => 'admin.ibooking.event.index',
        'uses' => 'EventController@index',
        'middleware' => 'can:ibooking.events.index'
    ]);
    $router->get('events/create', [
        'as' => 'admin.ibooking.event.create',
        'uses' => 'EventController@create',
        'middleware' => 'can:ibooking.events.create'
    ]);
    $router->post('events', [
        'as' => 'admin.ibooking.event.store',
        'uses' => 'EventController@store',
        'middleware' => 'can:ibooking.events.create'
    ]);
    $router->get('events/{event}/edit', [
        'as' => 'admin.ibooking.event.edit',
        'uses' => 'EventController@edit',
        'middleware' => 'can:ibooking.events.edit'
    ]);
    $router->put('events/{event}', [
        'as' => 'admin.ibooking.event.update',
        'uses' => 'EventController@update',
        'middleware' => 'can:ibooking.events.edit'
    ]);
    $router->delete('events/{event}', [
        'as' => 'admin.ibooking.event.destroy',
        'uses' => 'EventController@destroy',
        'middleware' => 'can:ibooking.events.destroy'
    ]);
    $router->bind('plan', function ($id) {
        return app('Modules\Ibooking\Repositories\PlanRepository')->find($id);
    });
    $router->get('plans', [
        'as' => 'admin.ibooking.plan.index',
        'uses' => 'PlanController@index',
        'middleware' => 'can:ibooking.plans.index'
    ]);
    $router->get('plans/create', [
        'as' => 'admin.ibooking.plan.create',
        'uses' => 'PlanController@create',
        'middleware' => 'can:ibooking.plans.create'
    ]);
    $router->post('plans', [
        'as' => 'admin.ibooking.plan.store',
        'uses' => 'PlanController@store',
        'middleware' => 'can:ibooking.plans.create'
    ]);
    $router->get('plans/{plan}/edit', [
        'as' => 'admin.ibooking.plan.edit',
        'uses' => 'PlanController@edit',
        'middleware' => 'can:ibooking.plans.edit'
    ]);
    $router->put('plans/{plan}', [
        'as' => 'admin.ibooking.plan.update',
        'uses' => 'PlanController@update',
        'middleware' => 'can:ibooking.plans.edit'
    ]);
    $router->delete('plans/{plan}', [
        'as' => 'admin.ibooking.plan.destroy',
        'uses' => 'PlanController@destroy',
        'middleware' => 'can:ibooking.plans.destroy'
    ]);
    $router->bind('price', function ($id) {
        return app('Modules\Ibooking\Repositories\PriceRepository')->find($id);
    });
    $router->get('prices', [
        'as' => 'admin.ibooking.price.index',
        'uses' => 'PriceController@index',
        'middleware' => 'can:ibooking.prices.index'
    ]);
    $router->get('prices/create', [
        'as' => 'admin.ibooking.price.create',
        'uses' => 'PriceController@create',
        'middleware' => 'can:ibooking.prices.create'
    ]);
    $router->post('prices', [
        'as' => 'admin.ibooking.price.store',
        'uses' => 'PriceController@store',
        'middleware' => 'can:ibooking.prices.create'
    ]);
    $router->get('prices/{price}/edit', [
        'as' => 'admin.ibooking.price.edit',
        'uses' => 'PriceController@edit',
        'middleware' => 'can:ibooking.prices.edit'
    ]);
    $router->put('prices/{price}', [
        'as' => 'admin.ibooking.price.update',
        'uses' => 'PriceController@update',
        'middleware' => 'can:ibooking.prices.edit'
    ]);
    $router->delete('prices/{price}', [
        'as' => 'admin.ibooking.price.destroy',
        'uses' => 'PriceController@destroy',
        'middleware' => 'can:ibooking.prices.destroy'
    ]);
    $router->bind('day', function ($id) {
        return app('Modules\Ibooking\Repositories\DayRepository')->find($id);
    });
    $router->get('days', [
        'as' => 'admin.ibooking.day.index',
        'uses' => 'DayController@index',
        'middleware' => 'can:ibooking.days.index'
    ]);
    $router->get('days/create', [
        'as' => 'admin.ibooking.day.create',
        'uses' => 'DayController@create',
        'middleware' => 'can:ibooking.days.create'
    ]);
    $router->post('days', [
        'as' => 'admin.ibooking.day.store',
        'uses' => 'DayController@store',
        'middleware' => 'can:ibooking.days.create'
    ]);
    $router->get('days/{day}/edit', [
        'as' => 'admin.ibooking.day.edit',
        'uses' => 'DayController@edit',
        'middleware' => 'can:ibooking.days.edit'
    ]);
    $router->put('days/{day}', [
        'as' => 'admin.ibooking.day.update',
        'uses' => 'DayController@update',
        'middleware' => 'can:ibooking.days.edit'
    ]);
    $router->delete('days/{day}', [
        'as' => 'admin.ibooking.day.destroy',
        'uses' => 'DayController@destroy',
        'middleware' => 'can:ibooking.days.destroy'
    ]);

  
    $router->bind('slot', function ($id) {
        return app('Modules\Ibooking\Repositories\SlotRepository')->find($id);
    });
    $router->get('slots', [
        'as' => 'admin.ibooking.slot.index',
        'uses' => 'SlotController@index',
        'middleware' => 'can:ibooking.slots.index'
    ]);
    $router->get('slots/create', [
        'as' => 'admin.ibooking.slot.create',
        'uses' => 'SlotController@create',
        'middleware' => 'can:ibooking.slots.create'
    ]);
    $router->post('slots', [
        'as' => 'admin.ibooking.slot.store',
        'uses' => 'SlotController@store',
        'middleware' => 'can:ibooking.slots.create'
    ]);
    $router->get('slots/{slot}/edit', [
        'as' => 'admin.ibooking.slot.edit',
        'uses' => 'SlotController@edit',
        'middleware' => 'can:ibooking.slots.edit'
    ]);
    $router->put('slots/{slot}', [
        'as' => 'admin.ibooking.slot.update',
        'uses' => 'SlotController@update',
        'middleware' => 'can:ibooking.slots.edit'
    ]);
    $router->delete('slots/{slot}', [
        'as' => 'admin.ibooking.slot.destroy',
        'uses' => 'SlotController@destroy',
        'middleware' => 'can:ibooking.slots.destroy'
    ]);

    $router->get('slots/searchSlots', [
        'as'    => 'admin.ibooking.slot.searchSlots',
        'uses'  => 'SlotController@searchTable'
    ]);

    $router->get('slots/searchSlotsComponent', [
        'as'    => 'admin.ibooking.slot.searchSlotsComponent',
        'uses'  => 'SlotController@searchSlots'
    ]);


    $router->bind('reservation', function ($id) {
        return app('Modules\Ibooking\Repositories\ReservationRepository')->find($id);
    });
    $router->get('reservations', [
        'as' => 'admin.ibooking.reservation.index',
        'uses' => 'ReservationController@index',
        'middleware' => 'can:ibooking.reservations.index'
    ]);
    $router->get('reservations/create', [
        'as' => 'admin.ibooking.reservation.create',
        'uses' => 'ReservationController@create',
        'middleware' => 'can:ibooking.reservations.create'
    ]);
    $router->post('reservations', [
        'as' => 'admin.ibooking.reservation.store',
        'uses' => 'ReservationController@store',
        'middleware' => 'can:ibooking.reservations.create'
    ]);
    $router->get('reservations/{reservation}/edit', [
        'as' => 'admin.ibooking.reservation.edit',
        'uses' => 'ReservationController@edit',
        'middleware' => 'can:ibooking.reservations.edit'
    ]);
    $router->put('reservations/{reservation}', [
        'as' => 'admin.ibooking.reservation.update',
        'uses' => 'ReservationController@update',
        'middleware' => 'can:ibooking.reservations.edit'
    ]);
    $router->delete('reservations/{reservation}', [
        'as' => 'admin.ibooking.reservation.destroy',
        'uses' => 'ReservationController@destroy',
        'middleware' => 'can:ibooking.reservations.destroy'
    ]);

    $router->get('reservations/searchReservations', [
        'as'    => 'admin.ibooking.reservation.searchReservations',
        'uses'  => 'ReservationController@searchTable'
    ]);

    $router->group(['prefix' =>'bulkload'], function (Router $router){

        $router->get('index',[
            'as'=>'admin.ibooking.bulkload.index',
            'uses'=>'ReservationController@indeximport',
            'middleware'=>'can:ibooking.bulkload.import',
        ]);

        $router->post('import',[
            'as'=>'admin.ibooking.bulkload.import',
            'uses'=>'ReservationController@importReservations',
            'middleware'=>'can:ibooking.bulkload.import',
        ]);

    });

// append






});
