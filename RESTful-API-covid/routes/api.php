<?php

use App\Http\Controllers\CovidController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Author;

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


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/patients', [CovidController::class, 'index']);
    Route::post('/patients', [CovidController::class, 'store']);
    Route::get('/patients/{id}', [CovidController::class, 'show']);
    Route::put('/patients/{id}', [CovidController::class, 'update']);
    Route::delete('/patients/{id}', [CovidController::class, 'destroy']);
    Route::get('/patients/search/{nama}', [CovidController::class, 'search']);
    Route::get('/patients/status/{status}', [CovidController::class, 'status']);
    Route::get('/patients/status/{status}', [CovidController::class, 'status']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
