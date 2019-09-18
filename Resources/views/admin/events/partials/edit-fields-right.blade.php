@php
	$op = array('required' => 'required');

@endphp

<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                @foreach ($eventStatus->lists() as $index => $ts)
                    <option value="{{$index}}" @if($index==$event->status) selected @endif >{{$ts}}</option>
                @endforeach
            </select>
        </div>
            
        {!! Form::normalInput('place',trans('ibooking::events.table.place'), $errors,$event,$op) !!}
            
        {!! Form::normalInput('duration',trans('ibooking::events.table.duration'), $errors,$event) !!}
            
        {!! Form::normalInput('people',trans('ibooking::events.table.people'), $errors,$event) !!}

        {!! Form::normalInput('inforprice',trans('ibooking::events.table.inforprice'), $errors,$event) !!}
            
        {!! Form::normalInput('video',trans('ibooking::events.table.video'), $errors,$event) !!}

    </div>
</div>

<div class="box box-primary">

    <div class="box-header">
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i>
                </button>
        </div>
        <div class="form-group">
                <label>{{trans('ibooking::common.table.image')}}</label>
        </div>
    </div>
    <div class="box-body">
            <div class="tab-content">
                @mediaSingle('mainimage',$event)
            </div>
    </div>
</div>
