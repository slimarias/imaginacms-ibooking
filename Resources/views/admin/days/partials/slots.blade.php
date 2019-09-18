<div class="form-group">
    <label for="slots" class="text-uppercase">{{trans('ibooking::days.slots.assign hours')}}</label>
	
	<br><br>
	
	@include('ibooking::admin.days.partials.slots-search')

	<br><br>
	<button type="button" class="btn btn-primary btn-flat btn-info pull-right" data-toggle="modal" data-target="#myModal">
		{{trans('ibooking::days.slots.manage hours')}}
	</button>
	


</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
  
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">

			@include('ibooking::admin.days.partials.slots-create')

			@include('ibooking::admin.days.partials.slots-table')
	
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('ibooking::common.button.close') }}</button>
		</div>
	  </div>
  
	</div>
  </div>







