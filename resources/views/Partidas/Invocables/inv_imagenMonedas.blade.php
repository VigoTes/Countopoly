
@php
     if($miles>9)
          $miles = 9;
     
@endphp

@if($miles!=0)

     <img class="ml-4 mr-2" src="/img/monedas/{{$miles}} Monedas.png"
     width="25px" style=" transform: rotate(-90deg);">

@endif