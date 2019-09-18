<div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach ($status->lists() as $index => $ts)
                <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
            @endforeach
        </select>
</div>

<div class="form-group" style="max-height:490px;overflow-y: auto;">
        <label for="events">{{trans('ibooking::events.plural')}}</label>
        @if(count($events)>0)
	        <ul class="checkbox" style="list-style: none;padding-left: 5px;">
	        @foreach ($events as $event)
                <li>
                    <label>
                      <input type="checkbox" class="flat-blue jsInherit" name="events[]"
                        value="{{$event->id}}"> {{$event->title}}
                    </label>
                </li>  
	        @endforeach
            </ul>
        @endif
</div>