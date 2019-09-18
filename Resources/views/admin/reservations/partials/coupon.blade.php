@if(isset($coupons) && count($coupons)>0)
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            <label for="coupon_id">{{trans('ishoppingcart::coupon.single')}}</label>
            
                <select class="form-control" id="coupon_id" name="coupon_id">
                    <option value="">{{trans('ibooking::common.select')}}</option>
                    @foreach ($coupons as $coupon)
                        <option value="{{$coupon->id}}" data-id="{{$coupon->id}}">{{$coupon->code}}</option>
                    @endforeach
                </select> 
            
        </div>
    </div>
</div>
@endif