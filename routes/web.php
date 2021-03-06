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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'getAll'])->name('services');

Route::post('/orders',[App\Http\Controllers\OrderController::class,'setOrder']);
Route::post('/servicesIntoOrder',[\App\Http\Controllers\OrderServicesController::class,'setOrderServices']);

