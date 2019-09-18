
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status">
        @foreach ($status->lists() as $index => $ts)
            <option value="{{$index}}" @if($index==$plan->status) selected @endif >{{$ts}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
        <label for="events">{{trans('ibooking::events.single')}}</label>
        <select class="form-control" id="event_id" name="event_id" required>
            <option value="">{{trans('ibooking::common.select')}}</option>
            @if(count($events)>0)
                @foreach ($events as $event)
                    <option value="{{$event->id}}"  @if($event->id==$plan->event_id) selected @endif>{{$event->title}}</option>
                @endforeach
            @endif
        </select>
</div>

    