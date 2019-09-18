@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibooking::reservations.title.reservations') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('ibooking::reservations.title.reservations') }}</li>
    </ol>
@stop

@section('content')
    
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.ibooking.reservation.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('ibooking::reservations.button.create reservation') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="table-responsive">
                        <table id="tableReservations" class="data-table table table-bordered table-hover" style="width:100%;">
                            <thead>
                                <tr class="titles">
                                    <th>ID</th>
                                    <th>{{ trans('ibooking::common.table.description') }}</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>{{ trans('core::core.table.created at') }}</th>
                                    <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('ibooking::common.table.description') }}</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>{{ trans('core::core.table.created at') }}</th>
                                    <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section("scripts")
    @parent
    <style>
        #tableReservations .bg-warning{
            background-color:darkgoldenrod;
        }
        #tableReservations .bg-info{
            background-color:deepskyblue;
        }
    </style>   
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('ibooking::reservations.title.create reservation') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.ibooking.reservation.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
           
            var url = "{{route('admin.ibooking.reservation.searchReservations')}}";

            var table = $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": url,
                "lengthMenu": [[20, 50, 100], [20, 50, 100]],
                "columns": [
                    {"data":"id"},
                    {"data":"description"},
                    {"data":"plan"},
                    {
                        "data":"status",
                        "render":function ( data, type, row, meta ) {
                            if(data==0){
                                return "<span class='label bg-red'>{{trans('ibooking::common.reservationStatus.declined')}}</span>";
                            }
                            if(data==1){
                                return "<span class='label bg-green'>{{trans('ibooking::common.reservationStatus.approved')}}</span>";
                            }
                            if(data==2){
                                return "<span class='label bg-info'>{{trans('ibooking::common.reservationStatus.pending')}}</span>";
                            }
                            if(data==3){
                                return "<span class='label bg-warning'>{{trans('ibooking::common.reservationStatus.expired')}}</span>";
                            }
                            if(data==4){
                                return "<span class='label bg-red'>{{trans('ibooking::common.reservationStatus.error')}}</span>";
                            }
                        }
                    },
                    {"data":"created_at"},
                    {"data":"id"},
                ],
                "columnDefs": [ {
                    "targets": 5,
                    "data": "",
                    "render": function ( data, type, row, meta ) {
                       
                        //rout = "{{route('admin.ibooking.reservation.edit', ["+data+"]) }}";
                        rout = "{{url('backend/ibooking/reservations')}}/"+data+"/edit";
                        
                        etiA = '<a title="ver" href="'+rout+'" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>'
                        
                        htmlDel = '<div class="btn-group"> '+etiA+'</div>';

                        htmlResult = htmlDel;
                        return htmlResult;
                    }//render
                }],
                "order": [[ 1, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
               

            });
            

        });
    </script>
@endpush
