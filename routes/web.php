<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

    Route::name('users.')->group(function () {
        Route::get('/users', \App\Livewire\User\Index::class)->name('index');
    });
    Route::name('audits.')->group(function () {
        Route::get('/audits', \App\Livewire\Audit\Index::class)->name('index');
    });
});
