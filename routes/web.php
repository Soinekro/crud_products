<?php

use Illuminate\Support\Facades\Route;
use Src\Tienda\Infraestructure\Http\ProductLivewire;

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
