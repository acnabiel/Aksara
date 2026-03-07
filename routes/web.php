<?php

use App\Livewire\CrewPage;
use App\Livewire\Dashboard;
use App\Livewire\GalleryPage;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', GalleryPage::class)->name('home');
Route::get('/crew', CrewPage::class)->name('crew');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', Login::class)
    ->middleware('guest')
    ->name('login');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
});
