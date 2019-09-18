@php
	if(isset($day->slots) && count($day->slots)>0){
		$oldSlot = array();
		foreach ($day->slots as $slot){
			array_push($oldSlot,$slot->id);
		}
		$slotsOrder = $slots->sortBy('hour');
	}

	
	
@endphp

<div class="form-group">
	<label for="slots_ids" style="width:100%;">{{trans('ibooking::days.slots.search hours example')}}</label>
    <select id="slots_ids" name="slots[]" class="form-control" multiple style="width:100%;">
		@if(isset($day->slots) && count($day->slots)>0)
			@foreach ($slotsOrder as $slot)
				<option value="{{$slot->id}}" @isset($oldSlot) @if(in_array($slot->id, $oldSlot)) selected @endif @endisset>{{$slot->hour}}</option>
			@endforeach
		@endif
    </select>
</div>

<link href="{{asset('modules/bcrud/vendor/select2/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('modules/bcrud/vendor/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />



@push('js-stack')

<script src="{{ asset('modules/bcrud/vendor/select2/select2.js') }}"></script>
@if(locale()=="es")
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
@endif

<script>
    jQuery(document).ready(function($) {
        $("#slots_ids").each(function (i, obj) {
            if (!$(obj).hasClass("select2-hidden-accessible")){
	            
				var urlSearch = "{{route('admin.ibooking.slot.searchSlotsComponent')}}"

                $(obj).select2({
	                theme: 'bootstrap',
	                multiple: true,
	                placeholder: "Ejemplo: 14:00:00",
	                minimumInputLength: "1",
	                language:"{{locale()}}",
	                ajax: {
		                url: urlSearch,
		                dataType: 'json',
		                quietMillis: 250,
		                data: function (params) {
		                    return {
                                q: params.term, // search term
                                page: params.page
                            };
		                },
		                processResults: function (data, params) {
							
                            params.page = params.page || 1;
								   
							return {
		                        results: $.map(data.data, function (item) { 
		                            return {
		                                text: item["hour"],
		                                id: item["id"]
		                            }
		                        }),
		                        more: data.current_page < data.last_page
		                    };
		                },
		                cache: true
	                },

	            });
	        }
        });
    });
</script>


@endpush

