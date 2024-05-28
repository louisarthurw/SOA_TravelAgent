<?php

use App\Http\Controllers\packageController;
use App\Http\Controllers\packageDetailController;
use App\Http\Controllers\travelAgentController;
use App\Models\package;
use App\Models\travelAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//travel agent
Route::get('travelAgent',[travelAgentController::class, 'index']);
Route::get('travelAgent/{id}', [travelAgentController::class,'show']);
Route::post('travelAgent',[travelAgentController::class,'store']);
Route::delete('travelAgent/{id}',[travelAgentController::class,'destroy']);
Route::put('travelAgent/{id}',[travelAgentController::class,'update']);
Route::get('travelAgent/{id}/packages', [packageController::class, 'index']);


//package
Route::post('packages',[packageController::class, 'store']);
Route::delete('packages/{id}',[packageController::class, 'destroy']);
Route::put('packages/{id}',[packageController::class, 'update']);


//detail
Route::post('detail',[packageDetailController::class, 'store']);
Route::put('detail/{id}',[packageDetailController::class, 'update']);
Route::delete('detail/{id}', [packageDetailController::class, 'destroy']);