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
    .bg-danger{
        background-color: rgba(255, 11, 11, 0.5) !important;
    }
</style>

@section('content')


<div class="page ibooking ibooking-single ibooking-single-{{$event->id}} ibooking-giftcard-single">

    <div class="fondo-reservas">
        {{--
        <img src="{{ Theme::url('img/podreis-atraparlo-a-tiempo-2.jpg') }}" alt="fondo-new">
        --}}
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
                     85 €
                </span>

                @php $precio = 85; @endphp

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
                
                <h2>Obten tu Tarjeta de Regalo</h2>

                <p class="bg-danger" style="padding: 15px;">
                    *tiene una caducidad de 3 meses.
                </p>
                
                <div class="event-description">
                    
                    @include('ibooking::frontend.giftcard.form')

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 block-gallery">

                @include('ibooking::frontend.gallery.slider')
                
            </div>

        </div>

        

    </div>
</div>
    
@stop
