


    <table width="528" border="0" align="center" cellpadding="0" cellspacing="0"
           class="mainContent">
        <tbody>
        <tr>
            <td mc:edit="title1" class="main-header"
                style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                <multiline>
                    Reservacion creada
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

                    <br><br>
                    <div style="margin-bottom: 5px"><span
                                style="color: #484848;">Sr/Sra</span>

                            
                        @if(isset($reservation))
   
                            {{$reservation->customer->first_name}} {{$reservation->customer->last_name}}
                            
                        @endif
                    </div>

                    <div style="margin-bottom: 5px"><span
                    style="color: #484848;">Reservacion #{{$reservation->id}}</span>
                    </div>

                   
                        @if(isset($reservation))
                            
                            <div style="margin-bottom: 5px"><span
                                    style="color: #484848;">Descripcion</span>
                            {!! $reservation->description !!}
                            </div>

                            @if(isset($reservation->people) && !empty($reservation->people))
                            <div style="margin-bottom: 5px"><span
                                style="color: #484848;">Cantidad Personas:</span>
                                {!! $reservation->people !!}
                            </div>
                            @endif

                            @if(isset($reservation->plan) && !empty($reservation->plan))
                            <div style="margin-bottom: 5px"><span
                                style="color: #484848;">Modo:</span>
                                {!! $reservation->plan!!}
                            </div>
                            @endif

                            <div style="margin-bottom: 5px"><span
                                style="color: #484848;">Status</span>
                                {!! $reservation->present()->status !!}
                            </div>

                        @else

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
