<div class="row booking-process-form">

  <div class="col-xs-12">
    <div class="back pull-right">
      <i class="fa fa-angle-double-left" aria-hidden="true"></i>
      {{trans('ibooking::frontend.button.back')}}
    </div>
  </div>
  
  <div class="col-xs-12">
    <div class="form-information">

      @php $form_id = uniqid("form_"); @endphp


       <form id="{{$form_id}}" class="form-horizontal"  method="post" action="{{route('ibooking.reservation.create')}}">

       <div class="content-form">
          <input type="hidden" name="form_id" value="{{$form_id}}" required="">
          {{csrf_field()}}

          <div class="infor col-xs-12">
            <label class="pull-left"> {{trans('ibooking::frontend.form.event')}}: </label>
            <div class="text">

              <div class="eventName pull-left">{{$event->title}} ( </div>
              <div class="dateSelect pull-left"></div>
              <div class="hourSelect pull-left"></div>

              <input type="hidden" name="start_date" id="buyer_date" value="" >
              <input type="hidden" name="slot_id" id="buyer_eventSlotID" value="" >
      
            </div>

            <input type="hidden" name="description" id="descriptionall" value="" >
          </div>
          
          <div class="infor col-xs-12">
            <label class="pull-left">{{trans('ibooking::frontend.form.place')}}: </label>
            <div class="text"> {{$event->place}}</div>
          </div>

          <div class="infor col-xs-12">
              <label style="margin-bottom:0px;text-transform:uppercase;margin-right:10px;font-size:23px;">
                {{trans('ibooking::frontend.form.players')}}: 
              </label>
              <div class="text" style="text-align:justify;">
                  {{trans('ibooking::frontend.tickets infor')}}
              </div>
          </div>
         
          @if($event->plans->where('status',1)!=null)
            @php
              $plansAp = $event->plans->where('status',1);
            @endphp

            <div class="infor col-xs-12">

              <label class="pull-left" style="margin-right: 10px;">{{trans('ibooking::frontend.form.modes')}}: </label>
              <div class="text">
                  <select class="form-control" id="mode" name="plan" required style="width: 80%;height: 35px;text-transform:uppercase;" required>
                    <option value="" data-id="0">Seleccione...</option>
                    @foreach($plansAp as $plan)
                      <option value="{{$plan->title}}" data-id="{{$plan->id}}" >{{$plan->title}}</option>
                    @endforeach
                  </select>
              </div>

            </div>

            <input type="hidden" name="plan_id" id="plan_id" value="" >
          
          @endif
          
          <div class="listprices-spinner text-center" style="display: none;">
              <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
              <span class="sr-only">Loading...</span>
          </div>

          <div class="col-xs-12 pricesDin" id="pricesDin">

          </div>

          <div class="infor col-xs-12">
            <div class="total pull-right" id="totalListPrice">0€</div>
            <label class="pull-right">{{trans('ibooking::frontend.form.total')}}:</label>
            <input type="hidden" name="value" id="buyer_value" value="0" >
            <input type="hidden" name="people" id="buyer_cantPer" value="0">
          </div>


          <div class="condiciones col-xs-12">

            <div class="checkbox" style="margin-bottom: 10px">
              <label><input type="checkbox" name="conditions" required>Acepto condiciones</label>
              - <a href="{{url('condiciones')}}" target="_blank"><strong>ver</strong></a>
            </div>

          </div>

          
          <div class="col-xs-12">
            @include('ibooking::frontend.booking.coupon')
          </div>
          

          <div class="col-xs-12">
            <h4 class="title-infor-buyer">{{trans('ibooking::frontend.buyer')}}</h4>
          </div>

          <div class="col-xs-12 form-field">
              <label for="first_name">{{trans('ibooking::reservations.table.firstname')}}:</label>
              <input type="text" class="form-control" name="first_name" required>
          </div>

          <div class="col-xs-12 form-field">
            <label for="last_name">{{trans('ibooking::reservations.table.lastname')}}:</label>
            <input type="text" class="form-control" name="last_name" required>
          </div>

          <div class="col-xs-12 form-field">
            <label for="email">{{trans('ibooking::frontend.form.email')}}:</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="col-xs-12 form-field">
            <label for="phone">{{trans('ibooking::frontend.form.phone')}}:</label>
            <input type="text" class="form-control" name="fields[phone]" minlength=7 required>
          </div>

          <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
          
          <div class="clearfix"></div>
        </div>
         

          <div class="col-xs-12 text-center btn-ibooking-form">
            <button type="submit" class="btn btn-primary btn-ibooking">
              {{trans('ibooking::frontend.button.pay')}}
            </button>
          </div>


       </form>
      
      <div class="clearfix"></div>
    </div>
  </div>
    
</div>