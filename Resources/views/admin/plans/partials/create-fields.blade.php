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
            
            var valuePrice = $(this).find("input[name='tpPrice']").val();
            var valuePeople = $(this).find("input[name='tpPeople']").val();

            item = {};

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