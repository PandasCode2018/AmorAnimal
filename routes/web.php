<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;

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


// Grupo de  rutas para páginas públicas (sin autenticación)
Route::middleware('guest')->name('public.')->group(function () {
    Route::get('/companies', [CompanyController::class, 'index'])->name('company.form');
    Route::post('/companies', [CompanyController::class, 'store'])->name('company.store');    
});


# Grupo de rutas privadas y protegidas
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::name('historial.')->group(function () {
        Route::get('/historial', \App\Livewire\Historial\Index::class)->name('index');
    });
    Route::name('profiles.')->group(function () {
        Route::get('/profile', \App\Livewire\Profile\index::class)->name('index');
    });
    Route::name('Suggestions.')->group(function () {
        Route::get('/Suggestion', \App\Livewire\Suggestion\index::class)->name('index');
    });
});
