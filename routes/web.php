<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;

//Route bebas tanpa middleware
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

//Route untuk guest
Route::middleware('guest')->group(function () {
    //view untuk guest
    
    Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    // Volt::route('/register', 'auth.register')->name('register');
});

//ingin menambahkan file route lain
require __DIR__ . '/auth.php';