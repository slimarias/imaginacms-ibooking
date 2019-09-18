<div class="booking">
  

  <div class="row booking-process-date"> 

    <div class="col-xs-12">
      <h4 class="title-booking">{{trans('ibooking::frontend.selectdate')}}:</h4>
    </div>
    <div class="clearfix"></div>

      {!! $errors->first("first_name", '<div class="alert alert-danger">:message</div>') !!}
      {!! $errors->first("buyer_email", '<div class="alert alert-danger">:message</div>') !!}
      {!! $errors->first("buyer_phone", '<div class="alert alert-danger">:message</div>') !!}

     <div class="col-sm-12 col-md-6">

       <div class="calendar">

          <div id="datepicker"></div>
          <input type="hidden" id="alternate" size="30">
          <br>
          <div class="ico-spinner text-center">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">Loading...</span>
          </div>

        </div>

     </div>
     
     <div class="col-sm-12 col-md-6">
       
        <input type="hidden" id="slotSelected" value="">
        <input type="hidden" id="slotSelectedHour" value="">

        <h3 class="title-slots">{{trans('ibooking::frontend.schedules')}}</h3>

        <div class="slots"></div>

        <div class="clearfix"></div>
        <br>
        <div class="slot-information">

          <i class="fa fa-square" aria-hidden="true"></i>
          {{trans('ibooking::frontend.slotfull')}}

          <br>
          <i class="fa fa-square" aria-hidden="true" style="color:rgba(0, 255, 0, 0.5);background-color:rgba(0, 255, 0, 0.5)"></i>
          {{trans('ibooking::frontend.slotfree')}}

        </div>

     </div>


     <div class="clearfix"></div>
     <div style="color:black;margin-left:20px;">
        {{trans('ibooking::frontend.same day reservations')}}
      </div>
     <br>

     <div id="btn-continue-form" class="col-xs-12 text-center">
        <div class="btn btn-primary btn-ibooking">
            {{trans('ibooking::frontend.button.continue')}}
        </div>
      </div>

  </div>

  
    @include('ibooking::frontend.booking.form')

             
</div>

<style type="text/css">
  .ico-spinner{
    display: none;
  }
  .slot-information{
      display: none;
  }
  #btn-continue-form{
    display: none;
  }
  .booking-process-form{
    display: none;
  }
  .disabledCalendar {
      pointer-events: none;
      opacity: 0.4;
  }
  .slots .slot-empty{
    cursor:pointer;
    background-color:rgba(0, 255, 0, 0.3);
  }
  #btn-continue-form{
    display: none;
  }
  .back{
    cursor:pointer;
  }
  .ui-datepicker-prev,
  .ui-datepicker-next{
    cursor:pointer;
  }

  .slots .slot-pending{
    background-color:#fffb93;
  }

  .block-booking-video .booking #datepicker .ui-datepicker-current-day{
      background-color: #444444 !important;
  }

  .block-booking-video .booking #datepicker .ui-datepicker-calendar td:hover{
      background-color: #888!important;
  }

  .block-infor .event-description{
     text-align: justify;
  }

  .block-infor .event-description ul{
    margin-left: 10px;
  }

  .block-infor .event-description ul li{
    margin-bottom: 10px;
  }

  .ui-datepicker-calendar tr td{
    background-color:rgba(0, 255, 0, 0.3);
  }

  
  .ui-datepicker-calendar .ui-datepicker-unselectable{
    background-color:#ddd;
  }

  .ui-datepicker-calendar .ui-datepicker-other-month{
    background-color:white;
  }
  
  .allslot-full{
    background-color: #9c050a !important;
  }
  .allslot-full a{
    color:white !important;
  }

  .allslot-nodis{
    background-color:#ddd !important;
  }
  .allslot-nodis a{
    cursor:auto;
  }
  

</style>


@section('scripts')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    
    jQuery(document).ready(function($) {

      var finding = false;

      $('#coupon_code').val("");
      $("#mode").val("");

      //================================= Find Days status

      
      var currentdate1 = new Date(); 
      var currentMonth1 = currentdate1.getMonth()+1;
      var currenYear1 = currentdate1.getFullYear();

      //dateIni1 = currenYear1+"-"+addZero(currentMonth1)+"-01"; 
      dateIni1 = currentDate();
      
      findDaysStatus(dateIni1);
      

      function findDaysStatus(dateIni){
        
        var eventID = {{$event->id}};
       
        var url = '{{url("")}}/api/ibooking/v1/frontend/findDaysStatus?filter={"date":"'+dateIni+'"}';

        $.ajax({
          
          url:url,
          type:"GET",
          dataType:"JSON",
          beforeSend: function(){
            
          },

          success: function(data){

              // Hay reservaciones
              if(data.response==true){  

                for (datas in data.daysStatus) {
                  
                  if(data.daysStatus[datas].statusDay==0){
                    var tclass = ".ui-datepicker-calendar tbody tr .dn-"+data.daysStatus[datas].day;
                    $(tclass).addClass("allslot-nodis");
                    $(tclass).addClass("ui-datepicker-unselectable");
                    $(tclass).addClass("ui-state-disabled");
                  }else{
                    if(data.daysStatus[datas].available==false){
                      var tclass = ".ui-datepicker-calendar tbody tr .dn-"+data.daysStatus[datas].day;
                      $(tclass).addClass("allslot-full");
                        
                    }
                  }
                  
                }// end for
              }// end if

          },

          error: function(data)
          {
            console.log('Error findDaysStatus:', data);
          }

        });

      }// end function

    	//================================= Booking Process

      $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
	        nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
	        currentText: 'Hoy',
	        firstDay: 1,
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['dom.','lun.','mar.','mie.','jue.','vie.','sáb.'],
          minDate: 0,
          maxDate: "+2M"
	    };


	    $.datepicker.setDefaults($.datepicker.regional['{{locale()}}']);

        $( "#datepicker" ).datepicker({
      		altField: "#alternate",
      		altFormat: "yy-mm-dd",
          onSelect: function (date) {

            if(finding==false){
              findInformation();
            }
            
            
            var datetest = $(this).datepicker('getDate');
            var currentMonth1 = datetest.getMonth()+1;
            var currenYear1 = datetest.getFullYear();
            dateIni1 = currenYear1+"-"+addZero(currentMonth1)+"-01"; 

            dateIni2 = currentDate();

            var dateSep = dateIni2.split('-');

            if(dateSep[1]==currentMonth1)
              findDaysStatus(dateIni2);
            else
              findDaysStatus(dateIni);
          
          },
          
          onChangeMonthYear: function(year, month, datepicker) {
               
            dateIni = year+"-"+addZero(month)+"-01"; 
            dateIni2 = currentDate();

            var dateSep = dateIni2.split('-');

            if(dateSep[1]==addZero(month))
              findDaysStatus(dateIni2);
            else
              findDaysStatus(dateIni);
        
          },

          beforeShowDay: function(date) {

            var infor = addZero(date.getDate());
            return [true, "dn-"+infor];
           
          }
          
         

    	});


      $('.slots').on('click', '.slot-empty', function() {

          $(".slots").find(".slot-selected" ).removeClass("slot-selected");

          $('#slotSelected').val($(this).data("id"));
          $('#slotSelectedHour').val($(this).data("hour"));
          $(this).addClass("slot-selected");

          $('#btn-continue-form').css("display","block"); 
      });

      $('#btn-continue-form').on('click', function() {
        
        $('.booking-process-date').hide(1000);

        var eventslotID = $('#slotSelected').val();
        var eventslotHour = $('#slotSelectedHour').val();
        var date = $('#alternate').val();

        $('.booking-process-form').show(1000);

        $('.dateSelect').text("");
        $('.hourSelect').text("");

        $('#buyer_date').val(date);
        $('.dateSelect').text(changeFormatDate(date));

        $('#buyer_eventSlotID').val(eventslotID);
        //$('.hourSelect').text(" - "+convertHour(eventslotHour)+")");
        //$('.hourSelect').text(" - "+eventslotHour+")");
        $('.hourSelect').text(" - "+changeFormatHour(eventslotHour)+")");

        var descriptionAll = "";

        descriptionAll = "{{$event->title}} ( "+changeFormatDate(date)+" - "+changeFormatHour(eventslotHour)+" )";


        $('#descriptionall').val(descriptionAll);
        
      });
      
      $('.back').on('click', function() {

        $('#coupon_code').val("");
        $('#coupon_code').removeClass("bg-success"); 
        $('#coupon_code').removeClass("bg-warning");

        $('.booking-process-form').hide(1000);

        $('.booking-process-date').show(1000);

      });
      

      //================================= Coupon Process

      $('#btn-coupon-find').on('click', function() {

          if($('#coupon_code').val()==""){

            alert("{{trans('ibooking::frontend.coupon.empty')}}");

          }else{

            findCoupon();
          }

      });// Event Button

      //================================= Change mode

      $(".btn-ibooking-form").css("display","none");

      $( "#mode" ).change(function() {

        $('#buyer_value').val("0");
        $('#totalListPrice').text("0€");
        $('#buyer_cantPer').val("0");

        var modeID = $(this).find(':selected').data('id');
        $('#plan_id').val(modeID);

        findPrices(modeID);
       
      });

      //================================= find Day Status Init

      //var dateToday = currentDate();
      //findDaysStatus(dateToday);

      //================================= Process
      
      function findInformation(){
             
            var eventID = {{$event->id}};
        	  var date = $("#alternate").attr("value");
            var dateToday = currentDate();
        	 
            var url = '{{url("")}}/api/ibooking/v1/frontend/findRDS?filter={"date":"'+date+'"}';

        	  $('#btn-continue-form').css("display","none");

        	  if (date!="" && date>=dateToday){
              
              //console.log("Reservations:Searching");

        	  	 $.ajax({
                    url:url,
                    type:"GET",
                    dataType:"JSON",
                    beforeSend: function(){
                       
                        $(".slots").empty();
                        $(".btn-selectday").hide();
                        $(".ico-spinner").css("display","block");
                        $('#slotSelected').val("");
                        $('#slotSelectedHour').val("");

                        finding = true;
                        $('#datepicker').addClass("disabledCalendar");
                        
                    },

                    success: function(data){

                    if(data.response==true){ 
                      $(".ico-spinner").css("display","none");
                      $(".slot-information").css("display","block");
                      $(".btn-selectday").show();
                      alert("{{trans('ibooking::frontend.noresults')}}");
                     
                    }else{ 

                    	var dhtmlSlot="";
                      var classtaken="",hourSlot="";

                      for (datas in data.slots) {

                        classtaken = "slot-empty";
                        for (datas2 in data.reservations) {
                          if(data.slots[datas].id==data.reservations[datas2].slot_id){
                            
                            if(data.reservations[datas2].status==2){
                                classtaken = "slot-pending";
                            }
                            if(data.reservations[datas2].status==1){
                                classtaken = "slot-full";
                            }

                          }

                        }
                       
                        hourSlot = changeFormatHour(data.slots[datas].hour);
                        dhtmSlot = "<div class='slot "+classtaken+"' data-id='"+data.slots[datas].id+"' data-hour='"+data.slots[datas].hour+"'>"+hourSlot+"</div>";
                        $(dhtmSlot).appendTo(".slots");
                      }

                      $(".ico-spinner").css("display","none");
                      $(".btn-selectday").show();
                      $(".slot-information").css("display","block");
                    }
                   

                    finding = false;
                    $('#datepicker').removeClass("disabledCalendar");

                    },

                    error: function(data)
                    {
                        console.log('FindSlots - Error:', data);
                        $(".ico-spinner").css("display","none"); // OJO QUITAR
                        finding = false; // OJO QUITAR
                        $('#datepicker').removeClass("disabledCalendar"); // OJO QUITAR
                    }
                });

        	  }else{

              $(".slots").empty();
              $('#slotSelected').val("");
              alert("{{trans('ibooking::frontend.dontdateallow')}}");

            }
      }

      
      function findCoupon(){

        var couponCode = $('#coupon_code').val();
        var valueTotal = $('#buyer_value').val();
        var url = "{{url('')}}/{{trans('ishoppingcart::common.uri')}}/find_coupon";
          
        $.ajax({
          url:url,
          type:"POST",
          data:{couponCode:couponCode,valueTotal:valueTotal},
          dataType:"JSON",
          beforeSend: function(){

            $('#coupon_code').removeClass("bg-success"); 
            $('#coupon_code').removeClass("bg-warning");

            $('#btn-coupon-find').addClass("disabledbutton"); 
            $('.btn-ibooking').addClass("disabledbutton"); 

            $(".ico-spinner-coupon").css("display","block");  
            
          },

          success: function(data){

            if(data.response==0){ // Code No Exist
              $('#coupon_code').val("");
              alert("{{trans('ibooking::frontend.coupon.codeNoExist')}}");
            } 

            if(data.response==1){ // Code Exist , Ya reclamado (Inactivo)
              $('#coupon_code').addClass("bg-warning");
              alert("{{trans('ibooking::frontend.coupon.codeClaimed')}}");
            } 

            if(data.response==2){ // Code Exist, Codigo Disponible
              $('#coupon_code').addClass("bg-success");

              priceTotal = $("#buyer_value").val();
              discount = getCouponDiscount(data.couponValue,data.couponType,priceTotal);
              
              msj = "{{trans('ibooking::frontend.coupon.codeAvailable')}} - Valor Cupon:"+discount+"€";

              alert(msj);
            }

            $(".ico-spinner-coupon").css("display","none");
            $('#btn-coupon-find').removeClass("disabledbutton");   
            $('.btn-ibooking').removeClass("disabledbutton"); 
          },

          error: function(data)
          {
            console.log('Error:', data);
          }
        
        });
      }

      function findPrices(modeID){
        
        var url = '{{url("")}}/api/ibooking/v1/prices?filter={"planId":'+modeID+'}';
        var idDiv = "#pricesDin";

        if(modeID!="0"){

          $.ajax({
            url:url,
            type:"GET",
            dataType:"JSON",
            beforeSend: function(){

               $(idDiv).empty();
               $(".listprices-spinner").css("display","block");
               $('#mode').attr('disabled', 'disabled');

               $(".btn-ibooking-form").css("display","none");
               
            },

            success: function(result){

              if(result!=null){
                html = "";
                counter = 0;
                for (datas in result.data) {
                    planPeople = result.data[datas].people;
                    planPrice = result.data[datas].price;

                    html += createRadio(planPeople,planPrice,counter);
                    counter++;
                }
                $(idDiv).append(html);
              }
            
              $(".listprices-spinner").css("display","none");
              $('#mode').removeAttr('disabled');
              $(".btn-ibooking-form").css("display","block");

            },

            error: function(data)
            {

              $(".listprices-spinner").css("display","none");
              $('#mode').removeAttr('disabled');
              console.log('Error:', data);
            }
          
          });

        }else{

          $(idDiv).empty();
          $('#buyer_value').val("0");
          $('#totalListPrice').text("0€");
          $('#buyer_cantPer').val("0");
          $(".btn-ibooking-form").css("display","none");

        }

      }

      

      //================================= Price RadioButton
      
      $('#buyer_value').val("0");
      $('#totalListPrice').text("0€");
      $('#buyer_cantPer').val("0");

      //$('#optprices0').prop('checked',true);
      //$('#buyer_value').val($("#optprices0").val());
      //$('#buyer_cantPer').val($("#optprices0").data("desc"));
      
      $("#pricesDin").on('click','input[name=optprices]',function () {  

        $('#buyer_value').val($(this).val());
        $('#totalListPrice').text($(this).val()+"€");
        $('#buyer_cantPer').val($(this).data("desc"));

      });
      
      
      
      //================================= Functions

      function convertHour (time) {
          time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
          if (time.length > 1) {
            time = time.slice (1);  
            time[5] = +time[0] < 12 ? 'AM' : 'PM'; 
            time[0] = +time[0] % 12 || 12; 
          }
          return time.join ('');
      }

      function currentDate(){

          var currentdate = new Date(); 
          var currentMonth = currentdate.getMonth()+1;
          var currentDay = currentdate.getDate();

          if(currentMonth<10)
            currentMonthNew = "0"+currentMonth;
          else
            currentMonthNew = currentMonth;

          if(currentDay<10)
            currentDayNew = "0"+currentDay;
          else
            currentDayNew = currentDay;

          var datetime = currentdate.getFullYear() + "-" + currentMonthNew + "-" + currentDayNew;

          return datetime;

      }

      function addZero(i) {
          if (i < 10) {
              i = "0" + i;
          }
          return i;
      }

      function currentHour() {
          var d = new Date();
         
          var h = addZero(d.getHours());
          var m = addZero(d.getMinutes());
          var s = addZero(d.getSeconds());
          
          x = h + ":" + m + ":" + s;

          return x;
      }

      function changeFormatDate(date1){

        var dateAr = date1.split('-');
        var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
       
        return newDate;

      }

      function changeFormatHour(hour1){

        var hourAr = hour1.split(':');
        var newHour = hourAr[0] + ':' + hourAr[1];
        return newHour;

      }

      function getCouponDiscount(value,type,total){

        if(type=="p")
            discount = (total * value) / 100;
        else
            discount = value;

        return discount;
      }

      function createRadio(desc,value,counter){

        htmlIni = '<div class="radio text-right"><label>';
        htmlEnd = '</label></div>';

        htmlDiv1I = '<div class="listprice pull-left" style="margin-right:40px;">';
        htmlDiv1C = desc+' {{trans('ibooking::frontend.people')}} = '+value+' €';
        htmlDiv1E = '</div>';

        htmlDiv1 = htmlDiv1I+htmlDiv1C+htmlDiv1E; 

        re="";
        if(counter==0)
          re = "required";

        htmlDiv2I = '<div class="listprice-int">';
        htmlDiv2C = '<input type="radio" name="optprices" id="optprices'+counter+'" value="'+value+'"data-desc="'+desc+'" '+re+' >';
        htmlDiv2E = '</div>';

        htmlDiv2 = htmlDiv2I+htmlDiv2C+htmlDiv2E;

        htmlRadio = htmlIni+htmlDiv1+htmlDiv2+htmlEnd;

        return htmlRadio;

      }

    });

</script>


@stop