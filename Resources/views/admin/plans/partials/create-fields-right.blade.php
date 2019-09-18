
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status">
        @foreach ($status->lists() as $index => $ts)
            <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
        <label for="events">{{trans('ibooking::events.single')}}</label>
        <select class="form-control" id="event_id" name="event_id" required>
            <option value="">{{trans('ibooking::common.select')}}</option>
            @if(count($events)>0)
                @foreach ($events as $event)
                    <option value="{{$event->id}}">{{$event->title}}</option>
                @endforeach
            @endif
        </select>
</div>

    