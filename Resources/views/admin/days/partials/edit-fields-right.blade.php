<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status">
        @foreach ($status->lists() as $index => $ts)
            <option value="{{$index}}" @if($index==$day->status) selected @endif >{{$ts}}</option>
        @endforeach
    </select>
</div>

<div class="form-group" style="max-height:490px;overflow-y: auto;">
        <label for="events">{{trans('ibooking::events.plural')}}</label>
        @if(count($events)>0)
            @php
                if(isset($day->events) && count($day->events)>0){
                    $oldEvent = array();
                    foreach ($day->events as $event){
                        array_push($oldEvent,$event->id);
                    }
                }
            @endphp
	        <ul class="checkbox" style="list-style: none;padding-left: 5px;">
	        @foreach ($events as $event)
                <li>
                    <label>
                      <input type="checkbox" class="flat-blue jsInherit" name="events[]"
                        value="{{$event->id}}" @isset($oldEvent) @if(in_array($event->id, $oldEvent)) checked="checked" @endif @endisset> {{$event->title}}
                    </label>
                </li>  
	        @endforeach
            </ul>
        @endif
</div>