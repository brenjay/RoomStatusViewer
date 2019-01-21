<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('building', 'BuildingCrudController');
    CRUD::resource('room', 'RoomCrudController');
    CRUD::resource('assignment', 'AssignmentCrudController');
    Route::get('action',function(){
        return View('backpack::actions');
    });
    Route::get('reset',function(){
        $count=0;
        foreach(\App\Models\Room::all() as $room){
            $room->cleaned = false;
            $room->passing = false; 
            $room->cleaned_by = NULL;
            $room->save();
            $count++;
        }
        return $count . " rooms have been marked unclean and not passing.";
    });
}); // this should be the absolute last line of this file