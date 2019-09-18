@extends('layouts.master')

@section('title')
    {{trans('ibooking::common.uri')}} | @parent
@stop


@section('content')
<div class="page ibooking ibooking-index" style="margin-top: 50px; margin-bottom: 50px; background-color:#eee;">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 category-body-1 column1">

                <div class="row">

                    @if (!empty($events))
                        @php $cont = 0; @endphp
                        @foreach($events as $event)

                            <!-- Event -->
                            <div class="col-xs-6 col-sm-3 contend event event{{$event->id}}">

                                <div class="bg-imagen">
                                    <a href="{{$event->url}}">
                                        @if(isset($event->mainimage)&&!empty($event->mainimage))
                                            <img class="image img-responsive"
                                                     src="{{url($event->mainimage)}}"
                                                     alt="{{$event->title}}"/>
                                        @else
                                            <img class="image img-responsive"
                                                     src="{{url('modules/ibooking/img/event/default.jpg')}}"
                                                     alt="{{$event->title}}"/>
                                        @endif
                                    </a>
                                </div>

                                <div class="content">
                                    <a href="{{$event->url}}"><h2>{{$event->title}}</h2></a>
                                    <p>{!! $event->summary!!}</p>
                                    <a class="btn btn-primary event-link" href="{{$event->url}}">Ver Mas
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>

                            </div>

                            @php $cont++; @endphp

                            @if($cont%4==0)
                                <div class="clearfix"></div>
                            @endif

                        @endforeach

                        <div class="clearfix"></div>
                        
                        {{--
                        <div class="pagination pagination-event row">
                            <div class="pull-right">
                                {{$events->links()}}
                            </div>
                        </div>
                        --}}

                    @endif
                </div>

            </div>{{-- category body--}}

        </div>
    </div>
</div>
@stop