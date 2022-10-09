<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\FactoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientsController;


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
    return view("home");
})->middleware('auth');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index']);
    Route::resource('profile', UserController::class);
    Route::resource('clients', ClientsController::class);
    
    Route::resource('invoices', InvoicesController::class);
    Route::resource('factories', FactoriesController::class);
    Route::get('/{page}', [AdminController::class, 'index']);
});

