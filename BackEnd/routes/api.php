<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('/a', function (){
    return 'a';
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('/v1')->group(function () {
//     Route::post('/auth/login', [AuthController::class, 'login']);

//     Route::middleware(['auth:sanctum'])->group(function () {
//         Route::group(['prefix' => 'attendance'], function () {
//             Route::post('/checkin', [\App\Http\Controllers\CheckInController::class, 'store']);
//             Route::post('/checkout', [\App\Http\Controllers\CheckOutController::class, 'store']);
//         });

//         Route::group(['prefix' => 'auth'], function () {
//             Route::post('/logout', [AuthController::class, 'logout']);
//         });
//     });
// });
