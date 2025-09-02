<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\SalonController;
use App\Http\Controllers\Api\ServiceController;
// use App\Http\Controllers\ServiceController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
    Route::get('/banners',[BannerController::class,'get']);
    Route::get('/popular/services',[ServiceController::class , 'get']);
    Route::get('/popular/salons',[SalonController::class , 'get']);
});



Route::post('/request/otp', [AuthController::class, 'requestOtp']);
Route::post('/request/verifyOtp', [AuthController::class, 'verifyOTP']);
