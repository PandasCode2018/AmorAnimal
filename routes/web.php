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

   /*  Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */

    Route::name('dashboard.')->group(function () {
        Route::get('/dashboard', \App\Livewire\Dashboard\Index::class)->name('index');
    });
    Route::name('users.')->group(function () {
        Route::get('/users', \App\Livewire\User\Index::class)->name('index');
    });
    Route::name('roles.')->group(function () {
        Route::get('/roles', \App\Livewire\Role\Index::class)->name('index');
    });
    Route::name('audits.')->group(function () {
        Route::get('/audits', \App\Livewire\Audit\Index::class)->name('index');
    });
    Route::name('responsible.')->group(function () {
        Route::get('/responsible', \App\Livewire\Responsible\Index::class)->name('index');
    });
    Route::name('animal.')->group(function () {
        Route::get('/animal', \App\Livewire\Animal\Index::class)->name('index');
    });
    Route::name('consultation.')->group(function () {
        Route::get('/consultation', \App\Livewire\Consultation\Index::class)->name('index');
    });
    Route::name('profiles.')->group(function () {
        Route::get('/profile', \App\Livewire\Profile\index::class)->name('index');
    });
});
