<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/ibooking/v1'], function (Router $router) {

  //======  EVENTS
  require('ApiRoutes/eventRoutes.php');

  //======  PLANS
  require('ApiRoutes/planRoutes.php');

  //======  PRICES
  require('ApiRoutes/priceRoutes.php');

   //====== DAYS
   require('ApiRoutes/dayRoutes.php');

   //====== SLOTS
   require('ApiRoutes/slotRoutes.php');

   //====== RESERVATIONS
   require('ApiRoutes/reservationRoutes.php');

   //====== FrontendProccess
   require('ApiRoutes/frontendRoutes.php');

});
