<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

      public function show(Room $room)
    {
        return $room;
    }
    
     public function submit(Request $request)
    {
        return $room;
    }
    
      public function update(Request $request, Room $room)
    {
        $room->update($request->all());

        return response()->json($room, 200);
    }


    
}
