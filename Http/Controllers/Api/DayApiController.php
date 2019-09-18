<?php

namespace Modules\Ibooking\Http\Controllers\Api;

// Requests & Response
use Modules\Ibooking\Http\Requests\CreateDayRequest;
use Modules\Ibooking\Http\Requests\UpdateDayRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Ibooking\Transformers\DayTransformer;

// Entities
use Modules\Ibooking\Entities\Day;

// Repositories
use Modules\Ibooking\Repositories\DayRepository;

//Support
use Illuminate\Support\Facades\Auth;

// Others
use Modules\Setting\Contracts\Setting;
use Carbon\Carbon;

class DayApiController extends BaseApiController
{

  private $day;
  private $setting;
  private $reservation;
  
  public function __construct(
    DayRepository $day,
    Setting $setting
    )
  {
    $this->day = $day;
    $this->setting = $setting;
    $this->reservation = app('Modules\Ibooking\Entities\Reservation');
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Request to Repository
      $days = $this->day->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ['data' => DayTransformer::collection($days)];
      
      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($days)] : false;

    } catch (\Exception $e) {
      
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];

    }
    return response()->json($response, $status ?? 200);
  }

  /** SHOW
   * @param Request $request
   *  URL GET:
   *  &fields = type string
   *  &include = type string
   */
  public function show($criteria, Request $request)
  {
    try {
      //Request to Repository
      $day = $this->day->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$day) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $day ? new DayTransformer($day) : '',
      ];

    } catch (\Exception $e) {
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {

    \DB::beginTransaction();

    try{

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new CreateDayRequest($data));

      //Create
      $day = $this->day->create($data);

      //Response
      $response = ["data" => new DayTransformer($day)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

        \Log::error($e);
        \DB::rollback();//Rollback to Data Base
        $status = $this->getStatusError($e->getCode());
        $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);

  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update($criteria, Request $request)
  {
    try {

      \DB::beginTransaction();

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new UpdateDayRequest($data));

      $params = $this->getParamsRequest($request);

      $day = $this->day->updateBy($criteria,$data,$params);

      $response = ['data' => new DayTransformer($day)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

      \Log::error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
      
    }

    return response()->json($response, $status ?? 200);

  }


  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function delete($criteria, Request $request)
  {
    try {

      //Get params
      $params = $this->getParamsRequest($request);

      $this->day->deleteBy($criteria,$params);

      $response = ['data' => 'Item deleted'];

    } catch (\Exception $e) {

      \Log::Error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
    
  }


   /**
   * Display a listing of the resource.
   * @return Response
   */
  public function availability(Request $request)
  {

    try {
     
      $codeApi = $this->setting->get('ibooking::code-api-escape-radar');
      if(empty($codeApi))
        return response()->json(['msj' => 'Error Code Api Escape - Contact WebMaster'], 400);
      
      $endTime = $request->endTime;
      $codeEscape = $request->id;

      // see if exist endtime,  if it does not exist that equals it
      if( !empty( $endTime ) ){
        $startTime =  Carbon::parse($request->startTime);
        $endTime =  Carbon::parse($request->endTime);

        // if start time is greater than end time
        if( $startTime->gt($endTime) ){
           return response()->json(['msj' => 'Error start date is less than end date'], 400);
        }

      }else{
            $startTime =  Carbon::parse($request->startTime);
            $endTime = $startTime;
      }

      

      if((!empty($startTime)) && (!empty($endTime)) && (!empty($codeEscape)) ){
        if($codeEscape===$codeApi){

          // call createCalendar and response
          $response = $this->createCalendar($startTime,$endTime,1);
          
        }else{
          return response()->json(['msj' => 'Error ID Code Api'], 400);
        }
      }else{
        return response()->json(['msj' => 'Error Parameters Request'], 400);
      }


    } catch (\Exception $e) {
      
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];

    }

    return response()->json($response, $status ?? 200);

  }

  public function createCalendar($startTime,$endTime,$eventID)
  {

    $calendarDate = [];

    // Data all Collect
    $data = collect([]);
    // parse all in dates
    $startDate = Carbon::parse($startTime);
    $endDate = Carbon::parse($endTime);
    // don't delete this query only date 
    // $reserFiltered = $this->reserva->whereDate('date', $startDate->toDateString());
    //->whereIn('status', [1, 2])

    // create reserve between start and end date
    // mount filter status with  PENDING = 1;  PUBLISHED = 2;
    $reserFiltered = $this->reservation->whereBetween('start_date', [$startDate->toDateString().' 00:00:00', $endDate->toDateString().' 23:59:59'])
                                        ->select('start_date', 'slot_id', 'status')
                                        ->whereIn('status', [1, 2])->get();

   
    // construct all days between the start and the end date
    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
      // parse count $date
      $calendarDate = Carbon::parse($date);
      $calendarString = $calendarDate->toDateString();

      // call slot in getDaySlots() Segmenting in week and weekend
      //$sloter = $this->getDaySlots($calendarString, $eventID);

      // Get Days for a date
      $filterDay =array("dayDate" => $calendarString);
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
        $filterDay =array("dayNum" => $dayNumber);
        $include = array('slots','events');
          
        $days = $this->day->getItemsBy((object)[
          'take' => 1,
          'include' => $include,
          'filter' => json_decode(json_encode($filterDay))
        ]);

      }// and IF days


      // OJO SEGUN EL MANUAL DE "ESCAPE RADAR" A JURO HAY QUE AGREGAR HORAS
      // POR EL MOMENTO AGREGO LAS MISMAS Q LAS DEL JUEVES
      /*
      $dayNumber = 4;
      if(count($days)<=0){
            
        // Filter by day number
        $filterDay =array("status" => 1,"dayNum" => $dayNumber);
        $include = array('slots','events');
          
        $days = $this->day->getItemsBy((object)[
          'take' => 1,
          'include' => $include,
          'filter' => json_decode(json_encode($filterDay))
        ]);

      }// and IF days
      */
     
      $reservedslots = [];

      $sloter = null;
      if(count($days)>0){

        foreach($days as $day){
          $sloter = $day->slots;
          $daysStatus = $day->status;
          break;
        }

        foreach ($reserFiltered as $filter) {
          // select only the variables:  date and name for  memory reduce
          $reservedslots[] = "{$filter->start_date} {$filter->slot->hour}";
        }

        foreach ($sloter as $slot) {
         
          // calls init and finish integrated and in string
          $init_hour = Carbon::parse($date->toDateString() . $slot->hour)->toDateTimeString();
          $finish_hour = Carbon::parse($date->toDateString() . $slot->hour)->addHour()->toDateTimeString();
          $available = 1;

          if (!empty($reservedslots)) {

            $init_hour2 = $date->toDateString()." 00:00:00 ".$slot->hour;
           
            // if init_our 2017-01-01 12:00:00  is equal at all array reserves $reservedslots = avalilable = asigned 0
            if (in_array($init_hour2, $reservedslots)) $available = 0;
            
          }

          // Requeriment to Escape Radar
          if($daysStatus==0)
            $available = 0;

          $construct = array('startTime' => $init_hour, 'endTime' => $finish_hour, 'Available' => $available);

          $data->push($construct);

        }// End foreach sloter
        

      }// End if days

    }// End foreach calendar

    // construct and return data and count total items
    return ['data' => $data, 'info' => ["totalItems" => $data->count()]];

  }

  


}
