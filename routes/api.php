<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Mobile\LuckyDrawController;
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

Route::get('/check/token', [LoginController::class, 'getProfileData']);

Route::get('test', [LoginController::class, 'test']);
Route::post('testtoken',[LuckyDrawController::class, 'testtoken']);


// Route::post('/login/code', 'LoginController@loginWithCode')->middleware('cors');


 Route::post('login/code',[LoginController::class, 'loginWithCode'])                                                                                                                  ;
