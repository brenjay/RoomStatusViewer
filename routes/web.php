<?php

use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web']], function () {
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/home', function(){
                return View("buildings_view")->with('buildings', Building::all() );
    })->name('home');
    
    Route::get('/room/{room}', function(Room $room){
                 return View("room_edit")->with('location', $room );
    })->name('room_edit');
    
    Route::post('/room/{room}', function(Request $request, Room $room){
        $request->request->add(['cleaned' => '1']);
        $request->request->add(['passing' => '1']);
        $request->request->add(['last_checked' => $request->last_cleaned]);
        $room->update($request->all());
        return Redirect('/home');
    })->name('update_room');
    
    
    Route::get('/building/{building}', function(Building $building){
                 return View("rooms_view")->with('building', $building );
    })->name('rooms_view');
    
    Route::get('/assigned', function(Building $building){
                 return View("assigned_rooms");
    })->name('assigned');
    
    Route::get('/info', function(Building $building){
                 $user = Auth::user();
                // $user->assignRole('admin');
                app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
                 return (Auth::user()->hasRole('admin'))? "yes" : "no";
    })->name('info');
    
});
});


