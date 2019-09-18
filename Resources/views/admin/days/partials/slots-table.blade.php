<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title text-uppercase">{{trans('ibooking::days.slots.available hours')}}</h3>
	</div>
	<div class="box-body">
		
		<div class="table-responsive">
			<table id="tableSlots" class="data-table table table-bordered table-hover" style="width:100%;">
				<thead>
					<tr class="titles">
						<th>ID</th>
						<th>{{trans('ibooking::slots.single')}}</th>
						<th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>{{trans('ibooking::slots.single')}}</th>
						<th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>

</div>

@push('js-stack')

<?php $locale = locale(); ?>
<script type="text/javascript">

 
    $(function(){

        var locale = "<?php echo $locale ?>";
		//var url = "{{url('')}}/api/ibooking/v1/slots";
		var url = "{{route('admin.ibooking.slot.searchSlots')}}";
		
        var table = $('.data-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": url,
            "lengthMenu": [[8, 16, 24], [8, 16, 24]],
            "columns": [
                {"data":"id"},
                {"data":"hour"},
                {"data":"id"},
			],
			"columnDefs": [ {
                "targets": 2,
                "data": "",
                "render": function ( data, type, row, meta ) {
                    
					htmlDel = '<button data-id="'+data+'" title="Eliminar Hora" type="button" class="btn-delete-dinamic2 btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>';
					htmlResult = htmlDel;
                    return htmlResult;
                }//render
			}],
            "order": [[ 1, "desc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }

        });

		$("#addSlot").on('click', function(){

			var token = $('meta[name="token"]').attr('value');
			var hourNew = $('#hour').val();
			
		
			if(hourNew!=""){

				var attributes = {'hour':hourNew}

				url = '{{ url('api/ibooking/v1/slots') }}';
				$.ajax({
					type: "POST",
					url: url,
					data:{
						attributes:attributes
					},
					headers: {'X-CSRF-TOKEN': token},
					beforeSend: function(){ 
						$('#addSlot').addClass("disabled");
					},
					success: function(data) {
						alert("Registro Exitoso");
						table.ajax.reload();
						$('#hour').val("");
						$('#addSlot').removeClass("disabled");
					},
					error: function(data)
					{
						console.log('Error:', data);
						alert("Ha ocurrido un error");
						$('#addSlot').removeClass("disabled");
						
					}
				})

			}else{
				alert("Debe ingresar la hora");
			}
			
			
		});

		$("#tableSlots").on('click',".btn-delete-dinamic2", function(){

			var token = $('meta[name="token"]').attr('value');
			var idSlot = $(this).data("id");

			url = '{{ url('api/ibooking/v1/slots') }}' + '/' + idSlot;

			$(this).addClass("disabled");	

			$.ajax({
				type: "DELETE",
				url: url,
				dataType: "json",
				headers: {'X-CSRF-TOKEN': token},
				beforeSend: function(){ 
					
				},
				success: function(data) {
					$(this).removeClass("disabled");
					alert("Registro Eliminado");
					table.ajax.reload();
					
				},
				error: function(data)
				{
					$(this).removeClass("disabled");	
					console.log('Error:', data);
					alert("Advertencia - No se puede eliminar el registro");
				}
			})
			
			$(this).removeClass("disabled");

		});



    });

   
    
</script>


@endpush