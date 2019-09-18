<div class="form-group">
    <label for="nums">{{trans('ibooking::days.single')}}</label>
    <select class="form-control" id="num" name="num" required>
        <option value="">{{trans('ibooking::common.select')}}</option>
        @if(count($daysWeek)>0)
            @foreach ($daysWeek->lists() as $index => $day)
                <option value="{{$index}}" @if($index==0) selected @endif >{{$day}}</option>
            @endforeach
        @endif
    </select>
</div>

{!! Form::normalInputOfType('date','date', trans('ibooking::days.table.date'), $errors) !!}
