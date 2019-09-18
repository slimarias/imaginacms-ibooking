<?php

namespace Modules\Ibooking\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Ibooking\Transformers\ReservationTransformer;
use Modules\Ibooking\Transformers\DayTransformer;
use Modules\Ibooking\Transformers\SlotTransformer;

// Entities
use Modules\Ibooking\Entities\Reservation;
use Modules\Ibooking\Entities\Day;
use Modules\Ibooking\Entities\Slot;

// Repositories
use Modules\Ibooking\Repositories\ReservationRepository;
use Modules\Ibooking\Repositories\DayRepository;
use Modules\Ibooking\Repositories\SlotRepository;

//Support
use Illuminate\Support\Facades\Auth;

//Others
use Carbon\Carbon;

class FrontendApiController extends BaseApiController
{

  private $reservation;
  private $day;
  private $slot;
  
  public function __construct(
    ReservationRepository $reservation,
    DayRepository $day,
    SlotRepository $slot
    )
  {
    $this->reservation = $reservation;
    $this->day = $day;
    $this->slot = $slot;
  }

  /**
   * Find Reservations, Days with Slots change of date
   * @return Response
   */
  public function findRDS(Request $request)
  {
    try {

      $params = $this->getParamsRequest($request);

      if(isset($params->filter)){
          $filter = $params->filter;
          $date = $filter->date;

          // Get Reservations for this date
          $filterReservation =array(
            "startDate" => $date
          );
          $reservations = $this->reservation->getItemsBy((object)[
            'take' => false,
            'filter' => json_decode(json_encode($filterReservation))
          ]);

        
          // Get Days for a date
          $filterDay =array(
            //"status" => 1,
            "dayDate" => $date
          );
          $include = array('slots','events');

          $days = $this->day->getItemsBy((object)[
            'take' => false,
            'include' => $include,
            'filter' => json_decode(json_encode($filterDay))
          ]);


          // Day is inactive or not exist
          if(count($days)<=0){
            
            $dayNumber = date('N',strtotime($date));

            // Filter by day number
            $filterDay =array(
              //"status" => 1,
              "dayNum" => $dayNumber
            );
            $include = array('slots','events');
          
            $days = $this->day->getItemsBy((object)[
              'take' => 1,
              'include' => $include,
              'filter' => json_decode(json_encode($filterDay))
            ]);

          }// and IF days

          $slots = null;
          if(count($days)>0){

            foreach($days as $day){
              $slots = $day->slots;
              $daysStatus = $day->status;
              break;
            }


            $dateNow = date("Y-m-d");
            //$dateNow = "2019-09-12";
           
            // Esta reservando para el mismo dia
            if($dateNow==$date){

              // OJO HORA LOCAL
              $datetimezone='Europe/Madrid';
              date_default_timezone_set($datetimezone);

              $hourNow = date("H:i:s");
              //$hourNow = "08:00:00";

              // Verificar la Hora de los Bloques
              foreach ($slots as $index => $slot) {

                  // Hora ya paso
                  if($slot->hour<$hourNow){
                    unset($slots[$index]);
                  }else{
                      $rest = ibooking_subtractHours($slot->hour,$hourNow);
                      if($rest<"12:00:00"){
                          unset($slots[$index]);
                      }
                  }
              }

            }//End if date now

          }// End if days

           // Verificar si hay bloques para mostrar (Si es true es porque esta FULL)
          if(count($slots) && $daysStatus==1){
            $responseP = false;
            $slots->sortBy('hour');
          }else{
            $responseP = true;
          }

          $response['response'] = $responseP;
          $response['reservations'] = $reservations;
          $response['slots'] = $slots;


      }// End if isset
    

    } catch (\Exception $e) {
      
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];

    }
    return response()->json($response, $status ?? 200);
  }

   /**
   * Find Days status Availables to Calendar
   * @return Response
   */
  public function findDaysStatus(Request $request)
  {
    try {
      
      $params = $this->getParamsRequest($request);

      if(isset($params->filter)){
        $filter = $params->filter;
        $date = $filter->date;

        $responseP = false;
        $data = collect([]);

        $dateStart=  Carbon::parse($date);
        $dateDayIni = $dateStart->day;// Add day ini
       
        $dateEnd = $dateStart->endOfMonth();

        $dMonth = $dateStart->month;
        if ($dMonth < 10)
          $dMonth = "0".$dMonth;

        $dYear = $dateStart->year;

        $daysMonth = $dateStart->daysInMonth;

        // Get Reservations Approvers for this month
        $filterReservation =array(
          "date" => array(
            "field" => "start_date",
            "from" => $date,
            "to" => $dateEnd->toDateString()
          ),
          "status" => 1,
          "orderBy" => array(
            "field" => "start_date",
          ),
        );
        $reservations = $this->reservation->getItemsBy((object)[
          'take' => false,
          'filter' => json_decode(json_encode($filterReservation))
        ]);

        //if(count($reservations)>0){
          $responseP = true;
          // For each day - CHANGE FOR DATE INIT
          for($i=$dateDayIni;$i<=$daysMonth;$i++){

            //$dDay = $i+1;
            $dDay = $i;
            if ($dDay < 10)
                $dDay = "0".$dDay;

            $fullDate = $dYear."-".$dMonth."-".$dDay;
            $available = true;


            // Get Days for a date
            $filterDay =array(
              //"status" => 1,
              "dayDate" => $fullDate
            );
            $include = array('slots','events');

            $days = $this->day->getItemsBy((object)[
              'take' => false,
              'include' => $include,
              'filter' => json_decode(json_encode($filterDay))
            ]);

            // Day is inactive or not exist
            if(count($days)<=0){
            
              $dayNumber = date('N',strtotime($fullDate));

              // Filter by day number
              $filterDay =array(
                "status" => 1,
                "dayNum" => $dayNumber
              );
              $include = array('slots','events');
          
              $days = $this->day->getItemsBy((object)[
                'take' => 1,
                'include' => $include,
                'filter' => json_decode(json_encode($filterDay))
              ]);

            }// and IF days

            $sloterTotal = 0;
            $reservationsTotal = 0;

            if(count($days)>0){

              foreach($days as $day){
                $slots = $day->slots;
                $daysStatus = $day->status;
                break;
              }

              // Slots by day
              $sloter =  $slots;
              $sloterTotal = count($sloter);

               // Filter reservation by day
              $filtered = $reservations->where('start_date', $fullDate.' 00:00:00');
              $reservationsDay = $filtered->all();

              foreach($sloter as $slot){

                  foreach ($reservationsDay as $re) {
                          //echo "SlotName {$slot->id} - Reservation Slot {$re->slot_id} <br> ";
                      if($slot->id==$re->slot_id){
                          $reservationsTotal++;
                          break;
                      }
                        
                  }
                      
              }// End foreach reservations

            }// End count days

            // Code for Testing
            //if($fullDate=="2019-06-23"){
                //dd($fullDate,"Reservations General: ".count($reservations));
                //dd($fullDate,"Reservations By Day: ".count($reservationsDay));
                //dd($fullDate,"TotalSlots: ".$sloterTotal,"TotalReservations: ".$reservationsTotal);
                //echo "Fecha:{$fullDate} - Bloques:{$sloterTotal} - Reservaciones:{$reservationesTotal} <br>";
            //}
            
            // Note: If sloterTotal is 0 and reservation is 0 , available will be false
            if($reservationsTotal == $sloterTotal){
                $available = false;
            }

            // New Requeriment for calendar
            $statusDay = 1;
            if(count($days)==0)
              $statusDay = 0;

            // Requeriment for Escape Radar
            if(isset($daysStatus) && $daysStatus==0){
              $available = false;
              $statusDay = 0; // New Requeriment for calendar
            }
              

            $construct = array(
                'fulldate' => $fullDate, 
                'day' => $dDay, 
                'month' => $dMonth,
                'year' => $dYear,
                'available' => $available,
                'statusDay' => $statusDay
            );

            $data->push($construct);

          }// For calendar

        //}// If reservations

        $response['response'] = $responseP;
        $response['daysStatus'] = $data;
       
      }

    } catch (\Exception $e) {
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
  }

  

 


 

}
