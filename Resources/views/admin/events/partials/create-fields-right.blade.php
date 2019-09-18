@php
	$op = array('required' => 'required');

@endphp

<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                @foreach ($eventStatus->lists() as $index => $ts)
                    <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
                @endforeach
            </select>
        </div>

        {!! Form::normalInput('place',trans('ibooking::events.table.place'), $errors,null,$op) !!}

        {!! Form::normalInput('duration',trans('ibooking::events.table.duration'), $errors,null) !!}

        {!! Form::normalInput('people',trans('ibooking::events.table.people'), $errors,null) !!}

        {!! Form::normalInput('inforprice',trans('ibooking::events.table.inforprice'), $errors,null) !!}

        {!! Form::normalInput('video',trans('ibooking::events.table.video'), $errors,null) !!}

    </div>
</div>

<div class="box box-primary">
    <div class="box-header">
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <div class="form-group">
            <label>{{trans('ibooking::common.table.image')}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="tab-content">
            @mediaSingle('mainimage')
        </div>
     </div>
</div>




