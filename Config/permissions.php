<?php

return [
    'ibooking.events' => [
        'index' => 'ibooking::events.list resource',
        'create' => 'ibooking::events.create resource',
        'edit' => 'ibooking::events.edit resource',
        'destroy' => 'ibooking::events.destroy resource',
    ],
    'ibooking.plans' => [
        'index' => 'ibooking::plans.list resource',
        'create' => 'ibooking::plans.create resource',
        'edit' => 'ibooking::plans.edit resource',
        'destroy' => 'ibooking::plans.destroy resource',
    ],
    'ibooking.prices' => [
        'index' => 'ibooking::prices.list resource',
        'create' => 'ibooking::prices.create resource',
        'edit' => 'ibooking::prices.edit resource',
        'destroy' => 'ibooking::prices.destroy resource',
    ],
    'ibooking.days' => [
        'index' => 'ibooking::days.list resource',
        'create' => 'ibooking::days.create resource',
        'edit' => 'ibooking::days.edit resource',
        'destroy' => 'ibooking::days.destroy resource',
    ],
    'ibooking.slots' => [
        'index' => 'ibooking::slots.list resource',
        'create' => 'ibooking::slots.create resource',
        'edit' => 'ibooking::slots.edit resource',
        'destroy' => 'ibooking::slots.destroy resource',
    ],
    'ibooking.reservations' => [
        'index' => 'ibooking::reservations.list resource',
        'create' => 'ibooking::reservations.create resource',
        'edit' => 'ibooking::reservations.edit resource',
        'destroy' => 'ibooking::reservations.destroy resource',
    ],

    'ibooking.bulkload' => [
        'import' => 'ibooking::reservations.bulkload.import',
    ],

// append






];
