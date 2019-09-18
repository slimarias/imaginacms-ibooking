<div class="box box-primary">
    <input type="hidden" id="listPrices" name="listPrices">

    <div class="box-header">
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <div class="form-group"><label>{{trans('ibooking::prices.plural')}}</label></div>
    </div>

    <div class="box-body ">
        
        <div id="prices">
        <table id="tprices" class='table table-dinamic'>

            <thead>
                <tr>
                    <th>{{trans('ibooking::common.table.price')}}</th>
                    <th>{{trans('ibooking::common.table.people')}}</th>          
                </tr> 
            </thead> 
                    
            <tbody>
            @foreach ($plan->prices as $price)
                <tr>
                    <td hidden="true">
                        <input type='text' name='tpId' class="tpId" value="{{$price->id}}"/>
                    </td>
                    <td>
                        <input type='number' name='tpPrice' class='form-control' value="{{$price->price}}" min="0" step="0.01" required/>
                    </td>
                    <td>
                        <input type="text" name="tpPeople" class="form-control" value="{{$price->people}}">
                    </td>
                    <td>
                        <button type="button" class="btn-delete-dinamic2 btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
                    
            <tfoot>
                <tr>
                    <td colspan='2'></td>
                    <td class='text-left'>
                        <button type='button' data-id-op='' class='btn btn-primary btn-add-dinamic'>
                            <i class='fa fa-plus-circle'></i>
                        </button>
                    </td>
                </tr>
            </tfoot>
                    
                    
        </table>
        
        <div id="cap" style="display: none;">
                <div class="loading-del">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
        </div>
            
        </div>

    </div>
</div>

@section('scripts')
    @parent

    <style type="text/css">

    #prices table tbody tr td{
    	vertical-align: middle;
    }

    #prices table tbody tr td .remove{
    	margin-left: 10px;
    }

    #cap{
    	background: rgba(255,71,0,0.13);
    	position: absolute;
    	width: 100%;
    	height: 100%;
    	z-index: 9999;
    	top: 0;
    	left: 0;
    }

    #cap .loading-del{
    	position: absolute;
    	top: 50%;
    	left: 50%;
    	transform: translate(-50%, -50%);
    }

    </style>

@stop

@push('js-stack')

<script type="text/javascript">

$(function(){ 

	var counter2 = 0;
	
	$("#tprices").on('click',".btn-add-dinamic", function(){
		
		var newRow2 = $("<tr>");
        var cols2 = "";
        //var idSubProduct = "subp"+counter2;
        	
        cols2 += '<td>'+createInputFloatS('tpPrice','required')+'</td>';
        cols2 += '<td>'+createInputTextS('tpPeople')+'</td>';
        cols2 += '<td><button type="button" class="btn-delete-dinamic btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        newRow2.append(cols2);
        $("#tprices").append(newRow2);
        counter2++;

	});

	$("#tprices").on('click',".btn-delete-dinamic", function(){
        $(this).closest("tr").remove();
	});

    $("#tprices").on('click',".btn-delete-dinamic2", function(){

        var token = $('meta[name="token"]').attr('value');
		var idSubP = $(this).parents('tr').find('.tpId').val();
		var bandDel = 1;

        if($.isNumeric(idSubP)){

            url = '{{ url('api/ibooking/v1/prices') }}' + '/' + idSubP;

            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': token},
                beforeSend: function(){ 
                    $("#cap").css("display","block");
                },
                success: function(data) {
        
                    console.log('success');
                    $("#cap").css("display","none");
                    $(this).closest("tr").remove();
                },
                error: function(data)
                {
                    bandDel = 0;
                    $("#cap").css("display","none");
                    console.log('Error:', data);
                    alert("{{trans('ibooking::common.messages.error delete')}}")
                }
            })

            if(bandDel==1)
			    $(this).closest("tr").remove();
        }//If

	});

    function createInputFloatS(name,req=''){
		htmlInputFloatS = "<input type='number' name='"+name+"' class='form-control' min='0' step='0.01'"+req+"/>";
		return htmlInputFloatS;
	}

	function createInputTextS(name,req=''){
		htmlInputTextS = "<input type='text' name='"+name+"' class='form-control' "+req+"/>";
		return htmlInputTextS;
	}

    $( ".content form" ).submit(function(e) {
        
        jsonObj = [];
        tableDi = "#tprices tbody tr"

        $(tableDi).each(function(g){
            
            var valueId = $(this).find("input[name='tpId']").val();
            var valuePrice = $(this).find("input[name='tpPrice']").val();
            var valuePeople = $(this).find("input[name='tpPeople']").val();

            item = {};

            item['id'] = valueId;
            item['price'] = parseFloat(valuePrice);
            item["people"] = valuePeople;
			
            jsonObj.push(item);

        });

        $("#listPrices").val(JSON.stringify(jsonObj));
        //console.log(jsonObj);e.preventDefault();return false;

    });

   
    
});

</script>

@endpush