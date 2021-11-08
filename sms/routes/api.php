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
Route::get('get-tree', [GeoLocationController::class,'getTree']);
//Route::get('get-division', [GeoLocationController::class,'getStates']);
Route::get('get-divisions', [GeoLocationController::class,'GetDivisions']);
Route::get('get-districts', [GeoLocationController::class,'GetDistricts']);
Route::get('get-areas', [GeoLocationController::class,'GetAreas']);
Route::get('get-sub_areas', [GeoLocationController::class,'GetSubAreas']);
Route::get('get-roads', [GeoLocationController::class,'GetRoads']);


//Delere tree
Route::delete('delete-countries/{id}', [GeoLocationController::class,'deleteCountry']);
Route::delete('delete-divisions/{id}', [GeoLocationController::class,'deleteDivisions']);
Route::delete('delete-districts/{id}', [GeoLocationController::class,'deleteDistricts']);
Route::delete('delete-areas/{id}', [GeoLocationController::class,'deleteAreas']);
Route::delete('delete-sub-areas/{id}', [GeoLocationController::class,'deleteSubAreas']);
Route::delete('delete-roads/{id}', [GeoLocationController::class,'deleteRoads']);
