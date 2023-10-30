<?php

use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\StudentController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api.auth')->group(function () {
    Route::get('get-group', [GroupController::class, 'getGroup'])->name('api.group.index');
    Route::get('get-class', [ClassController::class, 'getClass'])->name('api.class.index');
    Route::get('get-student', [StudentController::class, 'getStudent'])->name('api.student.index');
});
