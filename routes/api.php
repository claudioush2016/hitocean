<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//RUTAS ADMIN

Route::group(['middleware' => [], 'prefix' => ""], function () {
    Route::get('auth/all-ultis', [AdminController::class, 'getAllUlti']);
    Route::post('auth/new-user', [AdminController::class, 'register']);
    Route::post('auth/new-item', [AdminController::class, 'addItem']);
    Route::put('auth/edit-item/{item_id}', [AdminController::class, 'modifyItem']);
});


//Rutas Players
Route::group(['middleware' => [], 'prefix' => ""], function () {
    Route::post('player/set-arm/{item_id}', [UserController::class, 'setEquipament']);
    Route::post('player/attack/{userby}/{userto}', [UserController::class, 'attack']);
});
