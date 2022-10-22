<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\FactoriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsController;


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
    Route::put('profile/infoUpdate/{id}', [ProfileController::class , 'infoUpdate']);
    Route::put('profile/passUpdate/{id}', [ProfileController::class , 'passUpdate']);
    // Route resources grouping
    Route::resources([
        'clients' => ClientsController::class,
        'invoices' => InvoicesController::class,
        'factories' => FactoriesController::class,
        'profile' => ProfileController::class,
    ]);
    Route::get('/{page}', [AdminController::class, 'index']);
});

