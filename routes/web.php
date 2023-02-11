<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\NeracaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PerubahanModalController;
use Spatie\Permission\Contracts\Role;

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::controller(TransaksiController::class)
    ->prefix('transaksi')
    ->as('transaksi.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/transaksi/save', 'save')->name('save');
        Route::patch('/transaksi/update/{id}', 'update')->name('update');
        Route::delete('/transaksi/delete/{id}', 'delete')->name('delete');
    });
Route::controller(KategoriController::class)
    ->prefix('kategori')
    ->as('kategori.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/kategori/save', 'save')->name('save')->middleware(['permission:create kategori']);
        Route::patch('/kategori/update/{id}', 'update')->name('update')->middleware(['permission:edit kategori']);
        Route::delete('/kategori/delete/{id}', 'delete')->name('delete')->middleware(['permission:delete kategori']);
    });

Route::get('/jurnal', [JurnalController::class, 'index']);

Route::get('/neraca', [NeracaController::class, 'index']);

Route::get('/labarugi', [LabaRugiController::class, 'index']);

Route::get('/perubahanmodal', [PerubahanModalController::class, 'index']);

Route::controller(AkunController::class)
    ->prefix('users')
    ->as('users.')
    ->middleware(['auth', 'role:super admin'])
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/user/save', 'save')->name('save');
        Route::post('/user/update/{id}', 'update')->name('update');
        Route::delete('/user/delete/{id}', 'delete')->name('delete');
        Route::get('/role/{id}', 'role')->name('role');
        Route::post('/user/{id}/role', 'assignRole')->name('role.save');
        Route::delete('/user/{user}/role/{role}', 'deleteRole')->name('role.delete');
    });
