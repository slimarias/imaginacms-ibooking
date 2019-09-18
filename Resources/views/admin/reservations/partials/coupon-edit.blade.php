@if(isset($coupons) && count($coupons)>0 && !empty($reservation->coupon_id))
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            <label for="coupon_id">{{trans('ishoppingcart::coupon.single')}}</label>
            
                <select class="form-control" id="coupon_id" name="coupon_id" disabled>
                    <option value="">{{trans('ibooking::common.select')}}</option>
                    @foreach ($coupons as $coupon)
                        <option value="{{$coupon->id}}" data-id="{{$coupon->id}}" @if($coupon->id==$reservation->coupon_id) selected @endif>{{$coupon->code}}</option>
                    @endforeach
                </select> 
            
        </div>
    </div>
</div>
@endif