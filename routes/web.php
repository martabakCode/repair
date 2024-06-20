<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerbaikanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Routes for admin


    // Routes for admin and teknisi
    Route::middleware(['role:admin,teknisi'])->group(function () {
        Route::resource('teknisi', TeknisiController::class);
        Route::resource('perbaikan', PerbaikanController::class);
        Route::resource('mesin', MesinController::class);
        Route::resource('sparepart', SparepartController::class);
    });

    // Route tambahan yang hanya bisa diakses oleh admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Routes for user
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/perbaikan', 'App\Http\Controllers\User\PerbaikanController@create')->name('user.perbaikan.create');
        Route::post('/user/perbaikan/store', 'App\Http\Controllers\User\PerbaikanController@store')->name('user.perbaikan.store');
        Route::get('/user/perbaikan/create', 'App\Http\Controllers\User\PerbaikanController@index')->name('user.perbaikan.index');
    });

    // Laporan route accessible to all authenticated users
    Route::get('/laporan', [PerbaikanController::class, 'indexLaporan'])->name('perbaikan.indexLaporan');
    Route::put('/perbaikan/{id}/update-status', [PerbaikanController::class, 'updateStatus'])->name('perbaikan.updateStatus');
});
