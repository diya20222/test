<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Admin\VideoController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('user-login', [LoginController::class, 'userLogin']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post("create", [VideoController::class, 'store']);
    Route::post("update", [VideoController::class, 'update']);
    Route::delete("delete/{video}", [VideoController::class, 'destroy']);
});



