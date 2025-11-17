<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route khusus admin (hanya bisa diakses oleh role admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profile', \App\Livewire\Admin\Profile\Index::class)->name('admin-profile');
    Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard\Index::class)->name('admin-dashboard');

    // User Management Routes (using modals)
    Route::get('/admin/users', \App\Livewire\Admin\Users\Index::class)->name('admin.users.index');
    
});

// Route untuk member (jika ada)
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/profile', \App\Livewire\Admin\Profile\Index::class)->name('member-profile');
    Route::get('/dashboard', \App\Livewire\Member\Dashboard\Index::class)->name('member-dashboard');
});
