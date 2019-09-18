<?php

namespace Modules\Ibooking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibooking\Entities\Event;
use Modules\Ibooking\Http\Requests\CreateEventRequest;
use Modules\Ibooking\Http\Requests\UpdateEventRequest;
use Modules\Ibooking\Repositories\EventRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ibooking\Entities\EventStatus;

class EventController extends AdminBaseController
{
    /**
     * @var EventRepository
     */
    private $event;
    private $eventStatus;

    public function __construct(
        EventRepository $event,
        EventStatus $eventStatus
    )
    {
        parent::__construct();
        $this->event = $event;
        $this->eventStatus = $eventStatus;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = $this->event->all();
        $eventStatus = $this->eventStatus;
        return view('ibooking::admin.events.index', compact('events','eventStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        $eventStatus = $this->eventStatus;
        return view('ibooking::admin.events.create',compact('eventStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEventRequest $request
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {

        $this->event->create($request->all());

        return redirect()->route('admin.ibooking.event.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibooking::events.title.events')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        $eventStatus = $this->eventStatus;
        return view('ibooking::admin.events.edit', compact('event','eventStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Event $event
     * @param  UpdateEventRequest $request
     * @return Response
     */
    public function update(Event $event, UpdateEventRequest $request)
    {
        $this->event->update($event, $request->all());

        return redirect()->route('admin.ibooking.event.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibooking::events.title.events')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return Response
     */
    public function destroy(Event $event)
    {
        $this->event->destroy($event);

        return redirect()->route('admin.ibooking.event.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibooking::events.title.events')]));
    }
}
