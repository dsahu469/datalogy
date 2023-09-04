<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'do_login')->name('do_login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('home', 'index')->name('home');
        Route::get('payment', 'payment')->name('payment');
        Route::post('payment', 'purchase')->name('payment');
        Route::get('transaction', 'transaction')->name('transaction');
    });

    Route::controller(AuthController::class)->group(function(){
        Route::get('logout', 'logout')->name('home');
    });
});