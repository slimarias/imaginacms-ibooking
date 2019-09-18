<?php

namespace Modules\Ibooking\Http\Controllers\Api;

// Requests & Response
use Modules\Ibooking\Http\Requests\CreatePlanRequest;
use Modules\Ibooking\Http\Requests\UpdatePlanRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Ibooking\Transformers\PlanTransformer;

// Entities
use Modules\Ibooking\Entities\Plan;

// Repositories
use Modules\Ibooking\Repositories\PlanRepository;

//Support
use Illuminate\Support\Facades\Auth;

class PlanApiController extends BaseApiController
{

  private $plan;
  
  public function __construct(
    PlanRepository $plan
    )
  {
    $this->plan = $plan;
    
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Request to Repository
      $plans = $this->plan->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ['data' => PlanTransformer::collection($plans)];
      
      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($plans)] : false;

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
      $plan = $this->plan->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$plan) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $plan ? new PlanTransformer($plan) : '',
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
      $this->validateRequestApi(new CreatePlanRequest($data));

      //Create
      $plan = $this->plan->create($data);

      //Response
      $response = ["data" => new PlanTransformer($plan)];

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
      $this->validateRequestApi(new UpdatePlanRequest($data));

      $params = $this->getParamsRequest($request);

      $plan = $this->plan->updateBy($criteria,$data,$params);

      $response = ['data' => new PlanTransformer($plan)];

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

      $this->plan->deleteBy($criteria,$params);

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
