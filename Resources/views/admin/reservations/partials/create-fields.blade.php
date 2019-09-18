<div class="form-group ">
    <label for="first_name">{{trans("ibooking::reservations.table.firstname")}}</label>
    <input name="first_name"  type="text" class="form-control" required="required" >
</div>

<div class="form-group ">
    <label for="last_name">{{trans("ibooking::reservations.table.lastname")}}</label>
    <input name="last_name"  type="text" class="form-control" required="required" >
</div>

<div class="form-group ">
    <label for="email">{{trans("ibooking::reservations.table.email")}}</label>
    <input name="email"  type="email" class="form-control" required="required" >
</div>

<div class="form-group ">
    <label for="phone">{{trans("ibooking::reservations.table.phone")}}</label>
    <input name="fields[phone]"  type="text" class="form-control">
</div>

<div class="form-group ">
    <label for="description">{{trans("ibooking::common.table.description")}}</label>
    <input name="description"  type="text" class="form-control" required="required" >
</div>

<div class="form-group ">
    <label for="start_date">{{trans("ibooking::reservations.table.start_date")}}</label>
    <input name="start_date"  type="date" class="form-control" required="required" >
</div>

{{--
<div class="form-group">
    <label for="days">{{trans('ibooking::days.single')}}</label>
    <select class="form-control" id="day_id" name="day_id" required>
        <option value="">{{trans('ibooking::common.select')}}</option>
        @if(count($daysWeek)>0)
            @foreach ($daysWeek->lists() as $index => $ts)
                <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
            @endforeach
        @endif
    </select>
</div>
--}}

<div class="form-group">
    <label for="slot">{{trans('ibooking::slots.single')}}</label>
    <select class="form-control" id="slot_id" name="slot_id" required>
        <option value="">{{trans('ibooking::common.select')}}</option>
        @if(count($slots)>0)
            @php $slotsOrder = $slots->sortBy('hour'); @endphp
            @foreach ($slotsOrder as $slot)
                <option value="{{$slot->id}}">{{$slot->hour}}</option>
            @endforeach
        @endif
    </select>
</div>
{{--
<br>
<div class="form-group" style="margin-left:20px;">
    <div class="checkbox">
        <label><input name="notify" type="checkbox">{{trans('ibooking::common.form.notify')}}</label>
    </div>
</div>
--}}


