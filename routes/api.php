<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('book', [ReservationController::class, 'store']);
    Route::get('search', [ReservationController::class, 'availableSeats']);
});
Route::post('login', [LoginController::class, 'login']);
