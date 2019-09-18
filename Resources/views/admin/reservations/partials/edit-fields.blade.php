<div class="form-group ">
    <label for="first_name">{{trans("ibooking::reservations.table.firstname")}}</label>
    <input name="first_name"  type="text" class="form-control" required="required" value="{{$reservation->customer->first_name}}" readonly>
</div>

<div class="form-group ">
    <label for="last_name">{{trans("ibooking::reservations.table.lastname")}}</label>
    <input name="last_name"  type="text" class="form-control" required="required" value="{{$reservation->customer->last_name}}" readonly >
</div>

<div class="form-group ">
    <label for="email">{{trans("ibooking::reservations.table.email")}}</label>
    <input name="email"  type="email" class="form-control" required="required" value="{{$reservation->customer->email}}" readonly>
</div>

<div class="form-group ">
    <label for="phone">{{trans("ibooking::reservations.table.phone")}}</label>
    <input name="fields[phone]"  type="text" class="form-control" @if(isset($fields['phone']) && !empty($fields['phone'])) value="{{$fields['phone']}}" @endif readonly>
</div>

<div class="form-group ">
    <label for="description">{{trans("ibooking::common.table.description")}}</label>
    <input name="description"  type="text" class="form-control" required="required" value="{{$reservation->description}}" readonly>
</div>


<div class="form-group ">
    <label for="start_date">{{trans("ibooking::reservations.table.start_date")}}</label>
    <input name="start_date"  type="date" class="form-control" required="required" value="{{$reservation->present()->dateF($reservation->start_date,'Y-m-d')}}" readonly>
</div>

<div class="form-group">
    <label for="slot">{{trans('ibooking::slots.single')}}</label>
    <input name="slot"  type="text" class="form-control" required="required" value="{{$reservation->slot->hour}}" readonly>
</div>
{{--
<div class="form-group">
    <label for="slot">{{trans('ibooking::slots.single')}}</label>
    <select class="form-control" id="slot_id" name="slot_id" required readonly>
        <option value="">{{trans('ibooking::common.select')}}</option>
        @if(count($slots)>0)
            @foreach ($slots as $slot)
                <option value="{{$slot->id}}" @if($slot->id==$reservation->slot_id) selected @endif>{{$slot->hour}}</option>
            @endforeach
        @endif
    </select>
</div>
--}}

{{--
<br>
<div class="form-group" style="margin-left:20px;">
    <div class="checkbox">
        <label><input name="notify" type="checkbox">{{trans('ibooking::common.form.notify')}}</label>
    </div>
</div>
--}}