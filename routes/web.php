<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JournalCategoryController;
use App\Http\Controllers\JournalPemasukanController;
use App\Http\Controllers\JournalPengeluaranController;
use App\Http\Controllers\PaymentCategoryController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\SettingController;
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
        Route::get('/grup/permission/{id}', [GroupController::class, 'permissionPage'])->name('permission.index');
        Route::put('/grup/permission/{id}', [GroupController::class, 'submitPermission'])->name('permission.submit');
        Route::get('/staff/password/{id}', [StaffController::class, 'passwordPage'])->name('staff.password.index');
        Route::put('/staff/password/{id}', [StaffController::class, 'changePassword'])->name('staff.password.submit');
        Route::get('/siswa/password/{id}', [StudentController::class, 'passwordPage'])->name('siswa.password.index');
        Route::put('/siswa/password/{id}', [StudentController::class, 'changePassword'])->name('siswa.password.submit');
        Route::get('/siswa/import', [StudentController::class, 'importPage'])->name('siswa.import.index');
        Route::post('/siswa/import', [StudentController::class, 'importSubmit'])->name('siswa.import.submit');
        Route::resource('grup', GroupController::class);
        Route::resource('kelas', ClassController::class);
        Route::resource('tahun-ajaran', AcademicYearController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('siswa', StudentController::class);
        Route::resource('jurusan', DepartmentController::class);
    });

    Route::prefix('manajemen-pembayaran')->group(function () {
        Route::resource('tipe', PaymentTypeController::class);
        Route::resource('jenis', PaymentCategoryController::class);
    });

    Route::prefix('jurnal')->group(function () {
        Route::resource('kategori', JournalCategoryController::class);
        Route::resource('pemasukan', JournalPemasukanController::class);
        Route::resource('pengeluaran', JournalPengeluaranController::class);
    });

    Route::prefix('pengaturan')->group(function () {
        Route::get('umum', [SettingController::class, 'index'])->name('umum.index');
        Route::post('umum', [SettingController::class, 'update'])->name('umum.submit');
    });
});

Route::get('/{any}', function ($any) {
    Artisan::call('optimize:clear');
})->where('any', '.*');
