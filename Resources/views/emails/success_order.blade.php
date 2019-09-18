@extends('email.plantilla')

@section('content')
    <table width="528" border="0" align="center" cellpadding="0" cellspacing="0"
           class="mainContent">
        <tbody>
        <tr>
            <td mc:edit="title1" class="main-header"
                style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                <multiline>
                    {{$data['title'] or ''}}
                </multiline>
            </td>
        </tr>
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td mc:edit="subtitle1" class="main-subheader"
                style="color: #a4a4a4; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                <multiline>
                    {{$data['intro'] or ''}}
                    <br><br>
                    <div style="margin-bottom: 5px"><span
                                style="color: #484848;">Sr/Sra</span>

                        @if(isset($data['content']['reservation']))
                            @php $reservation=$data['content']['reservation'] @endphp

                           {{$reservation->customer->first_name}} {{$reservation->customer->last_name}}
                            
                        @endif
                    </div>



                   
                        @if(isset($data['content']['reservation']))
                             @php $reservation=$data['content']['reservation'] @endphp

                             @php

                                if(isset($data['content']['fields'])){
                                     
                                     $userFields = $data['content']['fields'];
                                     if(!empty($userFields['phone'])){
                                        $phone = $userFields['phone'];
                                     }
                                }else{
                                     $phone = "";
                                }
                                
                             @endphp

                        <div style="margin-bottom: 5px"><p
                                    style="color: #484848;">
                                Hola soy Tomás, de la inmobiliaria, muchas gracias por confirmar la visita para ver uno de nuestros inmuebles, el día {{format_date($reservation->start_date,"%d/%m/%Y")}} a {{$reservation->slot->hour}}
                                Permanecer atentos el día de la visita al móvil {{$phone}}, estamos en contacto por Whatsapp.
                            </p>
                            <p style="color: #484848;">
                               <strong style="color: #484848;">Nos vemos en la Plaza de la fuente 1 (Arco de la Villa) – NALDA.</strong>
                            </p>

                        </div>

                        <div style="margin-bottom: 5px"><p style="color: #484848;">Atentamente Tomás.</p>
                            <strong style="color: #484848;">Inmobiliaria Insidious</strong>

                            <p>
                                <strong style="color: red;">IMPORTANTE:</strong> 
                                    Debes estar estar 10 min antes de la hora de la visita 
                            <p>
                        </div>

                        @else
                        <div style="margin-bottom: 5px"><span
                                    style="color: #484848;">Su orden numero {{$data['content']['order'] or ''}}</span>
                            fue procesada Satisfactoriamente
                        </div>
                             @php $coupon=$data['content']['coupon'] @endphp

                             <div style="margin-bottom: 5px"><span
                                    style="color: #484848;">Codigo del Cupon:</span>
                            {!! $coupon->code !!}
                            </div>

                        @endif

                </multiline>
            </td>
        </tr>

        </tbody>
    </table>
@endsection