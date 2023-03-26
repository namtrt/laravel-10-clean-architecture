<?php

use App\Http\Controllers\AuthController;
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

Route::prefix('auth')->group(static function () : void {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:api');
    Route::post('register', [AuthController::class, 'register']);
});
