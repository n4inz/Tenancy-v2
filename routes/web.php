<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboarController;
use GuzzleHttp\Middleware;
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
Route::domain('{subdomain}.tenancy-v2.test')->middleware(['auth','domain'])->group(function () {
    Route::get('profile', function () {
        return 'laman profil';
    })->name('profile');

    Route::get('/dashboard', [DashboarController::class, 'index'])->name('dashboard');


});


Route::get('/', [AuthController::class, 'login_view'])->name('login');
Route::post('/login-store', [AuthController::class, 'login_store'])->name('login_store');

Route::get('/register', [AuthController::class, 'register_view'] )->name('register');
Route::post('register-store', [AuthController::class, 'register_store'] )->name('register_store');

Route::post('/logout', [AuthController::class, 'logout'] )->name('logout');



