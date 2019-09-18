<?php $cont=0; ?>
@if (count(ibooking_postgallery($event->id)) > 0)
    

        <div id="sl-single" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner" role="listbox">
            @foreach(ibooking_postgallery($event->id) as $image)

            <div class="item {{$cont==0?'active':''}}">

                <img src="{{ asset($image) }}" alt="img-{{$cont}}"/>

            </div>

            <?php $cont++; ?>
            @endforeach
        </div>

         <a class="left carousel-control" href="#sl-single" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#sl-single" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>

        </div>

@endif