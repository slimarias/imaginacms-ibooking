@extends('layouts.master')


@section('meta')
    <meta name="description" content="{!! $event->summary !!}">
    <!-- Schema.org para Google+ -->
    <meta itemprop="name" content="{{$event->title}}">
    <meta itemprop="description" content="{!! $event->summary !!}">
    <meta itemprop="image" content=" {{url($event->mainimage) }}">
    <!-- Open Graph para Facebook-->
    <meta property="og:title" content="{{$event->title}}"/>
    <meta property="og:type" content="articulo"/>
    <meta property="og:url" content="{{url($event->slug)}}"/>
    <meta property="og:image" content="{{url($event->mainimage)}}"/>
    <meta property="og:description" content="{!! $event->summary !!}"/>
    <meta property="og:site_name" content="{{Setting::get('core::site-name') }}"/>
    <meta property="og:locale" content="{{locale().'_CO'}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
    <meta name="twitter:title" content="{{$event->title}}">
    <meta name="twitter:description" content="{!! $event->summary !!}">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="{{url($event->mainimage)}}">
@stop


@section('title')
    {{ $event->title }} | @parent
@stop

<style type="text/css">

    .fondo-reservas{
        max-height: 500px;
        overflow: hidden; 
    }

    /*Color para pruebas*/
    .ibooking-single{
        background-color:#02020245;
    }

</style>

@section('content')


<div class="page ibooking ibooking-single ibooking-single-{{$event->id}}">

    <div class="fondo-reservas">
        <img src="{{ Theme::url('img/bombillo.jpg') }}" alt="fondo-new">
    </div>

    <div class="container">

        {{--###################################### Icons --}}
        <div class="row block-icons">

            <div class="col-sm-2 col-sm-offset-3 ">

                <img class="center-block" src="{{ Theme::url('img/ico/duracion.png') }}">
                <h2 class="text-center">Duración</h2>
                
                <span class="text-center">
                    {{$event->duration}}
                </span>

                @php $duracion = $event->duration; @endphp
                
            </div>

            <div class="col-sm-2">

                <img class="center-block" src="{{ Theme::url('img/ico/participantes.png') }}">
                <h2 class="text-center">Participantes</h2>
               
                <span class="text-center">
                    {{$event->people}}
                    <div style="font-size:15px;">
                        * {{trans('ibooking::frontend.icon-text-participantes')}} 
                    </div>
                </span>
                    
                @php $participantes = $event->people; @endphp

            </div>

            <div class="col-sm-2 ">
                
                <img class="center-block" src="{{ Theme::url('img/ico/precio.png') }}">
                <h2 class="text-center">Precio</h2>

                <span class="text-center">
                    {{$event->inforprice}} €
                    <div style="font-size:15px;">
                        Según jugadores
                    </div>
                </span>

                @php $precio = $event->price; @endphp

            </div>

        </div>

      
        {{--###################################### Title --}}
        <div class="row block-title">
            <div class="col-xs-12">
                <h1>{{$event->title}}</h1>
            </div>
        </div>

        {{--###################################### Infor-Gallery --}}

        <div class="row block-infor-gallery">
            
            <div class="col-xs-12 col-sm-12 col-md-6 block-infor">

                <h2>{{trans('ibooking::frontend.description')}}</h2>
                <div class="event-description">
                    {!!$event->description!!}
                </div>
                
                <div class="btn-gift">
                    <a href="{{route(locale().'.ibooking.event.giftcard',[$event->slug])}}">¿Quieres comprar una tarjeta de regalo?</a>
                </div>

                <style type="text/css">
                    .btn-gift{background-color: #DE050F;padding: 4.5px 25px;display: inline-block;margin-bottom: 20px;}
                    .btn-gift a{color:white;text-transform: uppercase;font-size: 23px;}
                </style>
               
            </div>

            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 block-gallery">
               
               @include('ibooking::frontend.gallery.slider')
    
            </div>

        </div>

        {{--###################################### Ibooking-Video --}}

        <div class="row block-booking-video">

            <div class="col-xs-12 col-sm-12 col-md-6">
                @include('ibooking::frontend.booking.index')
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 block-video"> 
                @if(isset($event->video))
                   
                    <iframe width="100%" height="315" src="{{$event->video}}" frameborder="0" allowfullscreen></iframe>
                    
                @else
                    <div class="alert alert-danger">
                        {{trans('ibooking::frontend.dontexist')}}
                    </div>
                @endif
            </div>
    
        </div>
        

    </div>
</div>
    
@stop
