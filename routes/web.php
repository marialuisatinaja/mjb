<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PontSalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Models\BusinessDetails;
use App\Models\Package;
use App\Models\PackageServices;
use App\Models\Reservation;
use App\Models\SalesDetails;
use App\Models\Services;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $therapist = User::where('user_type','Therapist')->get();
    $packages = Package::all();
    $svs = PackageServices::with('services')->get();
    $services = Services::all();
    return view('welcome',compact('therapist','packages','svs','services'));
});

Route::get('/dashboard', function () {
     $walkinsCount = 0;
     $reservations = '';
     $reservationsCount = 0;
     $walkinsCount = 0;
     $walkinsData = '';
     $userCount = 0;
     $services = Services::all();
     $packages = Package::all();
    if(auth()->user()->user_type == 'Customer')
    {
        $walkinQuery = BusinessDetails::with('services', 'package')
        ->where('email', auth()->user()->email)
        ->where('offers_type', '<>', 'walkin')
        ->where(function ($query) {
            $query->where('status', 'Pending')
                  ->orWhere('status', 'Serving');
        });
        $reservationsCount = $walkinQuery->count();
        $reservations = $walkinQuery->get();

        $reservationQuery = BusinessDetails::with('services', 'package')
        ->where('email', auth()->user()->email)
        ->where('offers_type', 'walkin')
        ->where(function ($query) {
            $query->where('status', 'Pending')
                  ->orWhere('status', 'Serving');
        });
        $walkinsCount = $reservationQuery->count();
        $walkinsData = $reservationQuery->get();

    }
    else
    {
        $walkinQuery = BusinessDetails::with('services', 'package')
        ->where('offers_type', '<>', 'walkin')
        ->where(function ($query) {
            $query->where('status', 'Pending')
                  ->orWhere('status', 'Serving');
        });
        $reservationsCount = $walkinQuery->count();
        $reservations = $walkinQuery->get();

        $reservationQuery = BusinessDetails::with(['services', 'package', 'sales_details.user'])
        ->where('status', 'Serving');

        // $reservationQuery = BusinessDetails::with('services', 'package')
        // ->where('offers_type', 'walkin')
        // ->where(function ($query) {
        //     $query->where('status', 'Serving')
        //           ->orWhere('status', 'Serving');
        // });

        $walkinsCount = $reservationQuery->count();
        $walkinsData = $reservationQuery->get();

        $userQuery = User::where('user_type','Customer'); // Missing semicolon here
        $userCount = $userQuery->count();


    }
    return view('dashboard',compact('reservations','reservationsCount','walkinsCount','walkinsData','userCount','services','packages'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::name('service.')->prefix('/service')->group(function () {
    Route::get('/reserved/{id}', [ServicesController::class, 'reserved'])->name('reserved');
    Route::post('reservation', [ServicesController::class, 'reservation'])->name('reservation');
    Route::post('service', [ServicesController::class, 'service'])->name('service');
    Route::post('package', [PackageController::class, 'package'])->name('package');
    Route::post('userReseravtion', [ServicesController::class, 'userReseravtion'])->name('userReseravtion');
    Route::post('userWalkin', [ServicesController::class, 'userWalkin'])->name('userWalkin');
    
    
});

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
        Route::post('/delete', [ReservationController::class, 'destroy'])->name('delete');
        Route::put('/update_details/{id}', [ReservationController::class, 'updateDetails'])->name('update_details');
        Route::post('/details', [ReservationController::class, 'details'])->name('details');
        Route::post('/edit_details', [ReservationController::class, 'edit_details'])->name('edit_details');
        Route::post('/delete_reservation', [ReservationController::class, 'deleteReservation'])->name('delete_reservation');
        Route::post('/notification', [ReservationController::class, 'notification'])->name('notification');
    });

    Route::name('package.')->prefix('/package')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('create', [PackageController::class, 'create'])->name('create');
        Route::post('store', [PackageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PackageController::class, 'update'])->name('update');
        Route::post('/delete', [PackageController::class, 'destroy'])->name('delete');
        Route::post('/data', [PackageController::class, 'data'])->name('data');
        Route::post('/delServe', [PackageController::class, 'delServe'])->name('delServe');
        Route::post('details', [PackageController::class, 'details'])->name('details');
    });

    Route::name('point.')->prefix('/point')->group(function () {
        Route::get('/', [PontSalesController::class, 'index'])->name('index');
        Route::get('create', [PontSalesController::class, 'create'])->name('create');
        Route::post('details', [PontSalesController::class, 'details'])->name('details');
        Route::post('store', [PontSalesController::class, 'store'])->name('store');
        Route::post('package', [PontSalesController::class, 'package'])->name('package');
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
        Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
        Route::post('/delete', [UserController::class, 'destroy'])->name('delete');
    });

    Route::name('certificate.')->prefix('/certificate')->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('create', [CertificateController::class, 'create'])->name('create');
        Route::post('store', [CertificateController::class, 'store'])->name('store');
        Route::post('/delete', [CertificateController::class, 'destroy'])->name('delete');
    });

    Route::get('/print/pdfrequest', [SalesController::class, 'printPdfRequest'])->name('print.pdf.request');
    Route::get('/print/pdfcertificate/{id}', [CertificateController::class, 'printPdfCertificate'])->name('print.pdf.certificate');
    

});

require __DIR__.'/auth.php';
