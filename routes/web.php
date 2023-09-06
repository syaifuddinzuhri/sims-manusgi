<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('guest.web')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'loginPage'])->name('login.show');
        Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    });
});

Route::middleware('auth.web')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('auth')->group(function () {
        Route::get('/profil', [AuthController::class, 'profilePage'])->name('profile.show');
        Route::post('/logout', [AuthController::class, 'logoutSubmit'])->name('logout.submit');
    });

    Route::prefix('master')->group(function () {
        Route::resource('grup', GroupController::class);
        Route::resource('kelas', ClassController::class);
        Route::resource('tahun-ajaran', AcademicYearController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('siswa', StudentController::class);
    });
});

Route::get('/{any}', function ($any) {
    Artisan::call('optimize:clear');
})->where('any', '.*');
