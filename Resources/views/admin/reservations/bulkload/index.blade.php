@php
    //ini_set('max_execution_time', 120); 
@endphp
@extends('layouts.master')
@section('content')

<div class="text-center py-5">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">{{trans('ibooking::reservations.bulkload.title')}}</h3>
        </div>
                   
        <form role="form" method="post" enctype='multipart/form-data' action="{{route('admin.ibooking.bulkload.import')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            
                            <div class="row justify-content-center">
                                <div class="form-group form-group col-xs-12 col-sm-4 col-sm-offset-4">
                                    <label for="InputFile">{{trans('ibooking::reservations.bulkload.Select File')}}</label>
                                    <input type="file"
                                           id="InputFile"
                                           name="importfile"
                                           accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                           style="margin: auto">
                                    <p class="help-block">{{trans('ibooking::reservations.bulkload.selectFilecompatible')}}</p>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{trans('ibooking::reservations.bulkload.Submit')}}</button>
                        </div>
        </form>
                    
    </div>
            

</div>

@endsection