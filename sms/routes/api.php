<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\GeoLocationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('phonenumbers', PhonebookController::class);




Route::get('get-locations', [GeoLocationController::class,'getLocations']);
Route::post('store-locations', [GeoLocationController::class,'storeLocations']);
