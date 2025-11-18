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

// Route untuk members (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard route - langsung pakai users.blade.php
    Route::get('/dashboard', function () {
        return view('members.members');
    })->name('dashboard');
    
    // Hosting Routes
    Route::get('/hosting/plans', function () {
        return view('members.members', ['section' => 'hosting-plans']);
    })->name('hosting.plans');
    
    Route::get('/hosting/subscriptions', function () {
        return view('members.members', ['section' => 'my-subscriptions']);
    })->name('hosting.subscriptions');
    
    Route::get('/hosting/manage', function () {
        return view('members.members', ['section' => 'manage-hosting']);
    })->name('hosting.manage');
    
    // Domains Routes
    Route::get('/domains/subdomains', function () {
        return view('members.members', ['section' => 'my-subdomains']);
    })->name('domains.subdomains');
    
    Route::get('/domains/dns', function () {
        return view('members.members', ['section' => 'dns-settings']);
    })->name('domains.dns');
    
    // Billing Routes
    Route::get('/billing/invoices', function () {
        return view('members.members', ['section' => 'invoices']);
    })->name('billing.invoices');
    
    Route::get('/billing/history', function () {
        return view('members.members', ['section' => 'transaction-history']);
    })->name('billing.history');
    
    // Members Routes
    Route::get('/members/profile', function () {
        return view('members.members', ['section' => 'my-profile']);
    })->name('members.profile');
    
    Route::get('/members/settings', function () {
        return view('members.members', ['section' => 'account-settings']);
    })->name('members.settings');
    
    // Support Routes
    Route::get('/support/live-chat', function () {
        return view('members.members', ['section' => 'live-chat']);
    })->name('support.live_chat');
});

// Volt::route('/register', 'auth.register')->name('register');