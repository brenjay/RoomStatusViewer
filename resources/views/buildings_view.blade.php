@extends('layouts.app')

@section('content')
<div class="container">
    
    @if(Auth::user()->team)
     <div class="col-md-12">
          <div class="card">
                <div class="card-header">{{Auth::user()->team->name}}'s Assigned Rooms</br> </div>
         </div>
     </div>
     </br>
            <div class="d-flex flex-wrap justify-content-center">
                
                 @foreach(Auth::user()->team->user as $user)
                     @foreach($user->room as $room)
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
                @endforeach
    
    
    
    
        </div>
    @endif
    <!--
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
    -->
     </br>
      <div class="col-md-12">
          <div class="card">
                <div class="card-header">Campus Buildings</br> </div>
         </div>
     </div>
     </br>
    <!--<div class="row justify-content-center">-->
     <div class="d-flex flex-wrap justify-content-center">
        <!--<div class="col-md-8">-->
            @foreach($buildings as $building)
            <a href='{{route("rooms_view", ["building" => $building->id])}}'><div class="card" style="margin:5px; width: 20rem;">
                <div class="card-header">{{ $building->name }}</br>
                </div>
                
                @php

                   $passing_count = 0;
                   $total_count = 0;
                   
                       foreach($building->room as $room){
                       $total_count++;
                           if($room->passing == 1)
                               $passing_count++;
                       }
                   
                   if($total_count == 0){
                   $percent = 0;
                   }else{
                   $percent = floor(($passing_count/$total_count)*100);
                   }
                   
                   $type = "";
                   
                       if($percent >= 0 && $percent <= 25){
                           $type = "bg-danger";
                       }elseif($percent > 25 && $percent <= 50){
                           $type = "bg-warning";
                       }elseif($percent > 50 && $percent <= 75){
                           $type = "bg-info";
                       }else{
                           $type = "bg-success";
                       }

                @endphp
                
                        <div class="progress" style="height:30px;">
                              <div class='progress-bar {{$type}}' role="progressbar" style='width: {{$percent}}%;' aria-valuenow='{{$percent}}' aria-valuemin="0" aria-valuemax="100">{{$percent}}%</div>
                        </div>

            </div> </a>
            </br>
            @endforeach
        </div>
    <!--</div>-->
</div>
@endsection
