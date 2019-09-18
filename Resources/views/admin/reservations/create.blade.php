@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibooking::reservations.title.create reservation') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ibooking.reservation.index') }}">{{ trans('ibooking::reservations.title.reservations') }}</a></li>
        <li class="active">{{ trans('ibooking::reservations.title.create reservation') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.ibooking.reservation.store'], 'method' => 'post']) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-8">
            <div class="box box-primary">
                <div class="box-body">
                    @include('ibooking::admin.reservations.partials.create-fields')
                </div>
            </div>        
        </div>

        <div class="col-xs-12 col-sm-4">
            <div class="box box-primary">
                <div class="box-body">
                    @include('ibooking::admin.reservations.partials.create-fields-right')
                </div>
            </div>


            @include('ibooking::admin.reservations.partials.coupon')
        

        </div>

        <div class="col-xs-12">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ibooking.reservation.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.ibooking.reservation.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
