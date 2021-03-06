<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PassportController;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'PassportController@login');

Route::post('register', 'PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){

Route::post('get-details', 'PassportController@getDetails');
Route::get('building/{building}', 'BuildingController@show');
Route::get('building', 'BuildingController@index');
Route::get('room/{room}', 'RoomController@show');
Route::post('room/{room}', 'RoomController@update');

Route::get('user',function(){
   return User::all();  
});

Route::get('user/{user}',function(User $user){
   return $user;  
});


});