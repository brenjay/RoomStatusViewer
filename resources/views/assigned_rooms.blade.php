@extends('layouts.app')

@section('content')
<div class="container">
    
     <div class="col-md-12">
          <div class="card">
                <div class="card-header">{{Auth::user()->name}}'s Assigned Rooms</br> </div>
         </div>
     </div>
     </br>
                  <div class="d-flex flex-wrap justify-content-center">
    
                 @foreach(Auth::user()->room as $room)
                 @php
                 
                     $style = "";
                     
                     if($room->passing == 0){
                     $style = "btn-danger";
                     }else{
                     $style = "btn-success";
                     }
                     
                 @endphp
                <a href='{{route("room_edit", ["room" => $room->id])}}'><button type='button' class='btn {{$style}}' style="margin:5px; width: 20rem;">{{$room->full_name}}</button></a>
                @endforeach
    
    
    
    
    
        </div>
    
    
    <!--</div>-->
</div>
@endsection
