<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

//Route bebas tanpa middleware

//Route untuk guest
Route::middleware('guest')->group(function () {
    //view untuk guest
    Route::get('/', function () {
        return view('frontend.index');
    })->name('index');
    
    // Volt::route('/login', 'auth.login')->name('login');
    // Volt::route('/register', 'auth.register')->name('register');
});

//ingin menambahkan file route lain
require __DIR__ . '/admin.php';