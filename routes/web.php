<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Models\Services;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('service.')->prefix('/service')->group(function () {
        Route::get('/', [ServicesController::class, 'index'])->name('index');
        Route::get('create', [ServicesController::class, 'create'])->name('create');
        Route::post('store', [ServicesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ServicesController::class, 'update'])->name('update');
        Route::post('/delete', [ServicesController::class, 'destroy'])->name('delete');
    });

    Route::name('reservation.')->prefix('/reservation')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::get('create', [ReservationController::class, 'create'])->name('create');
        Route::post('store', [ReservationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ReservationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ReservationController::class, 'update'])->name('update');
        Route::post('/delete', [ReservationController::class, 'destroy'])->name('delete');
    });

    Route::name('package.')->prefix('/package')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('create', [PackageController::class, 'create'])->name('create');
        Route::post('store', [PackageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PackageController::class, 'update'])->name('update');
        Route::post('/delete', [PackageController::class, 'destroy'])->name('delete');
    });

    Route::name('sale.')->prefix('/sale')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::get('create', [SalesController::class, 'create'])->name('create');
        Route::post('store', [SalesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SalesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SalesController::class, 'update'])->name('update');
        Route::post('/delete', [SalesController::class, 'destroy'])->name('delete');
    });

    Route::name('user.')->prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/delete', [UserController::class, 'destroy'])->name('delete');
    });
});

require __DIR__.'/auth.php';
