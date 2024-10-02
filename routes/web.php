<?php

use App\Livewire\ProductLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductLivewire::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
