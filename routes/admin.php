<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/admin', 'users.index');

Route::middleware('auth')->group(function () {
    //view untuk user yang sudah login
    // Volt::route('/dashboard', 'dashboard.index')->name('dashboard');
    // Volt::route('/profile', 'profile.index')->name('profile');
});
