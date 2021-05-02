<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback', function () {
    return view('feedback');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cheaders',[App\Http\Controllers\HomeController::class, 'chartHeaders'])->name('cheader');
Route::get('/gender',[App\Http\Controllers\ClientController::class, 'getGenders'])->name('gender');
Route::get('/weeks/appointment',[App\Http\Controllers\AppointmentController::class, 'weeksAppointment'])->name('weeksapp');
Route::post('/feedback',[App\Http\Controllers\FeedbackController::class, 'store'])->name('store.feedback');

Route::resource('appointments',App\Http\Controllers\AppointmentController::class);