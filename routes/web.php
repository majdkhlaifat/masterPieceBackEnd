<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;


Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::get('/home', [HomeController::class, 'redirect'])->name('user.home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class, 'addview']);
Route::post('/upload_doctor', [AdminController::class, 'upload']);
Route::get('/telemedicine', [AdminController::class, 'view'])->name('user.telemedicine');

Route::post('/bookings/create', [BookingController::class,'create'])->name('user.booking');

Route::post('/appointment', [BookingController::class,'appointment'])->name('user.booking');
Route::get('/myAppointment', [BookingController::class,'myAppointment'])->name('user.booking');
Route::get('/cancel_appoint/{id}', [BookingController::class, 'cancel_appoint'])->name('cancel_appoint');
Route::get('/showAppointment', [BookingController::class,'showAppointment'])->name('admin.showAppointment');

Route::get('/approved/{id}', [BookingController::class, 'approved'])->name('approved');
Route::get('/canceled/{id}', [BookingController::class, 'canceled'])->name('canceled');

Route::get('/showDoctors', [AdminController::class, 'showDoctors'])->name('admin.showDoctors');
Route::get('/deleteDoctor/{id}', [AdminController::class, 'deleteDoctor'])->name('deleteDoctor');
Route::get('/updateDoctor/{id}', [AdminController::class, 'updateDoctor'])->name('updateDoctor');
Route::post('/editDoctor/{id}', [AdminController::class, 'editDoctor'])->name('editDoctor');
