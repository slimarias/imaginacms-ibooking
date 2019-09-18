<div class="coupon">
    <label class="pull-left">{{trans('ibooking::frontend.coupon.title')}}</label>
    <input type="text" name="coupon_code" id="coupon_code" class="pull-left">
    <div id="btn-coupon-find" class="btn-coupon btn pull-left">{{trans('ibooking::frontend.coupon.button')}}</div>
    <div class="ico-spinner-coupon pull-left">
          <i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
          <span class="sr-only">Loading...</span>
    </div>
    <div class="clearfix"></div>
</div>
  
<style type="text/css">
  
    .ico-spinner-coupon{
        display: none;
    }
  
    .disabledbutton {
        pointer-events: none;
        opacity: 0.4;
    }
  
</style>