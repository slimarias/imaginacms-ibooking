@php
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
@endphp

{!! Form::open(['route'=>$locale.'.checkout.giftcard','method' => 'post','class'=>'form-giftcard','role' => 'form']) !!}

  <div class="form-group">
    {!! Form::label('email', 'Email*') !!}
    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder' => 'Dirección de correo donde recibiras el codigo del cupon','required' => 'required']) !!}

    {!! Form::hidden('eventid', $event->id) !!}
    {!! Form::hidden('price', $precio) !!}

   </div>

   <button type="submit" class="btn btn-primary btn-default">COMPRAR</button>

 {!! Form::close() !!}