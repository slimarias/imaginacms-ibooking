<div class="box box-primary">

		<div class="box-header with-border">
			<h3 class="box-title text-uppercase">{{trans('ibooking::days.slots.add new hour')}}</h3>
		</div>

		<div class="box-body">

			<div class="col-xs-12 col-sm-5">
				<div class="form-group">
					<label for="hour">{{trans('ibooking::days.slots.select')}}</label>
					<input type="time" name="hour" id="hour">
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-7">
				<button id="addSlot" type="button" class="btn btn-info btn-flat btn-small">{{trans('ibooking::days.slots.add')}}</button>
			</div>

		</div>

</div>