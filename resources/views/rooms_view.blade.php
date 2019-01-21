@extends('layouts.app')

@section('content')
<div class="container">
    
     
      <div class="col-md-12">
          <div class="card">
                <div class="card-header">{{$building->name}}</br> </div>
         </div>
     </div>
     </br>
    <!--<div class="row justify-content-center">-->
     <div class="d-flex flex-wrap justify-content-center">
        <!--<div class="col-md-8">-->
            @foreach($building->room as $room)
             @php
               $body = "";
               if(App\User::find($room->assigned_to)){
               $body = "Room assigned to: " . App\User::find($room->assigned_to)->name;
               }else{
               $body = "Room not assigned";
               }
               
               $style = "";
               if($room->cleaned == 0){
               $style = "bg-danger text-white";
               }else{
               $style = "bg-success text-white";
               }
               
            @endphp
            <a style="color:inherit;" href='{{route("room_edit", ["room" => $room->id])}}'><div class='card {{$style}}' style="margin:5px; width: 20rem;">
                <div class="card-header">{{ $room->full_name }}</br>
                </div>
                {{$body}}
            </div></a>
            </br>
            @endforeach
        </div>
    <!--</div>-->
</div>
@endsection
