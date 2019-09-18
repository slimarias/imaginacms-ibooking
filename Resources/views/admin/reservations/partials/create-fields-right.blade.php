<div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach ($status->lists() as $index => $ts)
                <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
            @endforeach
        </select>
</div>

<div class="form-group">
    <label for="plans">{{trans('ibooking::plans.single')}}</label>
    @if(count($plans)>0)
        <select class="form-control" id="plan_id" name="plan_id" required>
            <option value="">{{trans('ibooking::common.select')}}</option>
            @foreach ($plans as $plan)
                <option value="{{$plan->id}}" data-id="{{$plan->id}}">{{$plan->title}}</option>
            @endforeach
        </select> 
    @endif
</div>

<div class="form-group">
    <label for="prices">{{trans('ibooking::common.table.people')}}</label>
    <select class="form-control" id="prices" name="people" required>
        <option value="">{{trans('ibooking::common.select')}}</option>
        
    </select> 
</div>

<div class="form-group ">
    <label for="value">{{trans("ibooking::common.table.price")}}</label>
    <input id="value" name="value"  type="text" class="form-control" required="required" >
</div>

@push('js-stack')

<script type="text/javascript">

$(function(){ 
    
    $("#plan_id").change(function(){

        var planID = $(this).find(':selected').data('id');
        var url = '{{url("")}}/api/ibooking/v1/prices?filter={"planId":'+planID+'}';

        var idDiv = "#prices";

        if(planID!=undefined){

            $.ajax({
                url:url,
                type:"GET",
                dataType:"JSON",
                beforeSend: function(){
                    $(idDiv).empty();
                    $('#plan_id').attr('disabled', 'disabled');
                },

                success: function(result){

                    if(result!=null){
                        htmlOp = "";
                        for (datas in result.data) {
                            people = result.data[datas].people;
                            price = result.data[datas].price;

                            htmlOp+="<option value='"+people+"' data-price='"+price+"'>"+people+"</option>";
                            //console.log(result.data[datas].price);
                        }
                        $(idDiv).append(htmlOp);
                    }
                    $('#plan_id').removeAttr('disabled');
                },

                error: function(result)
                {
                    $('#plan_id').removeAttr('disabled');
                    console.log('Error:', result);
                }
            
            });

        }else{

            $(idDiv).empty();
       
        }

    });
    /*
    $("#prices").change(function(){
        console.log($(this).data('price'));
        //$("#value").val($(this).data('value'));
    });
    */

});//end Jquery

</script>

@endpush