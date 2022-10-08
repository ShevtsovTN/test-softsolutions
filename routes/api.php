<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ModelCarController;
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

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/user', [AuthController::class, 'getAuthUser'])->name('auth.user');

Route::apiResource('/brands', BrandController::class)->middleware('auth:sanctum');

Route::apiResource('/cars', CarController::class)->middleware('auth:sanctum');

Route::apiResource('/models', ModelCarController::class)->middleware('auth:sanctum');
