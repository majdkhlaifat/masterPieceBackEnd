<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Api\CaloriesBurnedController;
use Illuminate\Support\Facades\View;


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

Route::any('/booking/create', [BookingController::class, 'create'])->name('user.booking.create');
Route::post('/user/booking/submit', [BookingController::class,'submit'])->name('user.booking.submit');

Route::get('/myAppointment', [BookingController::class,'myAppointment'])->name('user.my_appointment');
Route::get('/cancel_appoint/{id}', [BookingController::class, 'cancel_appoint'])->name('cancel_appoint');
Route::get('/showAppointment', [BookingController::class,'showAppointment'])->name('admin.showAppointment');

Route::get('/approved/{id}', [BookingController::class, 'approved'])->name('approved');
Route::get('/canceled/{id}', [BookingController::class, 'canceled'])->name('canceled');

Route::get('/showDoctors', [AdminController::class, 'showDoctors'])->name('admin.showDoctors');
Route::get('/deleteDoctor/{id}', [AdminController::class, 'deleteDoctor'])->name('deleteDoctor');
Route::get('/updateDoctor/{id}', [AdminController::class, 'updateDoctor'])->name('updateDoctor');
Route::post('/editDoctor/{id}', [AdminController::class, 'editDoctor'])->name('editDoctor');



    Route::get('/doctor/home', [DoctorController::class, 'home'])->name('doctor.home');

    Route::get('/patient-portal', [PatientController::class, 'patientPortal'])
    ->name('user.patientPortal')
    ->middleware('auth');

    Route::match(['get', 'post'], '/add-notice', [PatientController::class, 'addNotice'])->name('addNotice')->middleware('auth');
    Route::get('patientPortal/{patient_id}/doctor/{doctor_id}', [PatientController::class, 'doctorPatientPortal'])->name('doctor.patientPortal');


Route::get('/doctor/patient-portal/{patient_id}', [DoctorController::class, 'patientPortal'])->name('doctor.patientPortal');

Route::get('/calories-burned', [CaloriesBurnedController::class, 'getCaloriesBurned'])->name('user.calories-burned');
Route::get('/countByUserType', [AdminController::class, 'countByUserType'])->name('admin.body');

Route::get('/chatbot', [HomeController::class, 'chatbot'])->name('user.chatbot');

Route::get('/heart-age', [HomeController::class, 'heartAge'])->name('user.heart-age');

Route::get('/BMI', [HomeController::class, 'weightManagement'])->name('user.weightManagement');

Route::post('/user/booking/submit', [BookingController::class, 'submit'])->name('user.booking.submit');
