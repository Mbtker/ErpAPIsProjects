<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/LoginFunc',[UserController::class, 'LoginFunc'])->name('LoginFunc');

Route::get('/GetObjectType',[UserController::class, 'GetObjectType'])->name('GetObjectType');
Route::post('/CreateObjectType',[UserController::class, 'CreateObjectType'])->name('CreateObjectType');
Route::post('/SearchObjectType',[UserController::class, 'SearchObjectType'])->name('SearchObjectType');
Route::post('/EditObjectType',[UserController::class, 'EditObjectType'])->name('EditObjectType');

Route::get('/GetObjectData',[UserController::class, 'GetObjectData'])->name('GetObjectData');
Route::post('/CreateObjectData',[UserController::class, 'CreateObjectData'])->name('CreateObjectData');
Route::post('/SearchObjectData',[UserController::class, 'SearchObjectData'])->name('SearchObjectData');
Route::post('/EditObjectData',[UserController::class, 'EditObjectData'])->name('EditObjectData');

