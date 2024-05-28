<?php

use App\Http\Controllers\packageController;
use App\Http\Controllers\travelAgentController;
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


//package
Route::get('travelAgent/{id}/packages', [packageController::class, 'index']);