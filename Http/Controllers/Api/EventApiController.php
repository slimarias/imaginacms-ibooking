<?php

namespace Modules\Ibooking\Http\Controllers\Api;

// Requests & Response
use Modules\Ibooking\Http\Requests\CreateEventRequest;
use Modules\Ibooking\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Ibooking\Transformers\EventTransformer;

// Entities
use Modules\Ibooking\Entities\Event;

// Repositories
use Modules\Ibooking\Repositories\EventRepository;

//Support
use Illuminate\Support\Facades\Auth;

class EventApiController extends BaseApiController
{

  private $event;
  
  public function __construct(
    EventRepository $event
    )
  {
    $this->event = $event;
    
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Request to Repository
      $events = $this->event->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ['data' => EventTransformer::collection($events)];
      
      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($events)] : false;

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
      $event = $this->event->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$event) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $event ? new EventTransformer($event) : '',
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
      $this->validateRequestApi(new CreateEventRequest($data));

      //Create
      $event = $this->event->create($data);

      //Response
      $response = ["data" => new EventTransformer($event)];

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
      $this->validateRequestApi(new UpdateEventRequest($data));

      $params = $this->getParamsRequest($request);

      $event = $this->event->updateBy($criteria,$data,$params);

      $response = ['data' => new EventTransformer($event)];

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

      $this->event->deleteBy($criteria,$params);

      $response = ['data' => 'Item deleted'];

    } catch (\Exception $e) {

      \Log::Error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
    
  }

}
