<?php

namespace Modules\Ibooking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibooking\Entities\Plan;
use Modules\Ibooking\Http\Requests\CreatePlanRequest;
use Modules\Ibooking\Http\Requests\UpdatePlanRequest;
use Modules\Ibooking\Repositories\PlanRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ibooking\Entities\Status;
use Modules\Ibooking\Repositories\EventRepository;

class PlanController extends AdminBaseController
{
    /**
     * @var PlanRepository
     */
    private $plan;
    private $event;

    public function __construct(
        PlanRepository $plan,
        Status $status,
        EventRepository $event
    )
    {
        parent::__construct();
        $this->plan = $plan;
        $this->status = $status;
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $plans = $this->plan->all();
        return view('ibooking::admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = $this->status;
        $events = $this->event->all();
        return view('ibooking::admin.plans.create',compact('status','events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePlanRequest $request
     * @return Response
     */
    public function store(CreatePlanRequest $request)
    {
        $this->plan->create($request->all());

        return redirect()->route('admin.ibooking.plan.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibooking::plans.title.plans')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Plan $plan
     * @return Response
     */
    public function edit(Plan $plan)
    {   
        $status = $this->status;
        $events = $this->event->all();
        return view('ibooking::admin.plans.edit', compact('plan','status','events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Plan $plan
     * @param  UpdatePlanRequest $request
     * @return Response
     */
    public function update(Plan $plan, UpdatePlanRequest $request)
    {
        $this->plan->update($plan, $request->all());

        return redirect()->route('admin.ibooking.plan.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibooking::plans.title.plans')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Plan $plan
     * @return Response
     */
    public function destroy(Plan $plan)
    {
        try {
            $this->plan->destroy($plan);

            return redirect()->route('admin.ibooking.plan.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibooking::plans.title.plans')]));
        
        } catch (\Exception $e) {
                \Log::error($e);
                return redirect()->back()
                    ->withError(trans('core::core.messages.resource error', ['name' => trans('ibooking::plans.title.plans')]));
    
        }
    }
}
