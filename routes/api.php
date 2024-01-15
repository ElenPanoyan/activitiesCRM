<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::middleware('auth:api')->group(function () {
    Route::get('/user-info', function (Request $request) {
        return $request->user();
    });
    Route::get('/get-user-activities', [ActivityController::class, 'getUserActivities']);
});
Route::post('/sign-up', [UserController::class, 'signUp'])->name('signUp');
Route::post('/sign-in', [UserController::class, 'signIn'])->name('signIn');
