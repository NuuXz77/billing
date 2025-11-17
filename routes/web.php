<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

//Route bebas tanpa middleware

//Route untuk guest
Route::middleware('guest')->group(function () {
    //view untuk landing page
    Route::get('/', function () {
        return view('frontend.landing_page');
    })->name('landing_page');
    
    Route::get('/home', function () {
        return view('frontend.landing_page', ['scrollTo' => 'home']);
    })->name('home');
    
    Route::get('/features', function () {
        return view('frontend.landing_page', ['scrollTo' => 'features']);
    })->name('features');
    
    Route::get('/pricing', function () {
        return view('frontend.landing_page', ['scrollTo' => 'pricing']);
    })->name('pricing');
    
    Route::get('/cta', function () {
        return view('frontend.landing_page', ['scrollTo' => 'cta']);
    })->name('cta');
    
    Route::get('/testimonials', function () {
        return view('frontend.landing_page', ['scrollTo' => 'testimonials']);
    })->name('testimonials');
    
    Route::get('/cart', function () {
        return view('frontend.landing_page', ['showCart' => true]);
    })->name('cart');
    
    //view untuk users login
    Route::get('/auth/login', function () {
        return view('users.auth.login');
    })->name('login');
    
    //view untuk users register
    Route::get('/auth/register', function () {
        return view('users.auth.register');
    })->name('register');
    
    Route::get('/privacy-policy', function () {
        return view('frontend.landing_page', ['showPrivacyPolicy' => true]);
    })->name('privacy-policy');
    
    Route::get('/terms-and-conditions', function () {
        return view('frontend.landing_page', ['showTermsAndConditions' => true]);
    })->name('terms-and-conditions');
    
    // Dashboard route - langsung pakai users.blade.php
    Route::get('/dashboard', function () {
        return view('users.users');
    })->name('dashboard');
    
    // Hosting Routes
    Route::get('/hosting/plans', function () {
        return view('users.users', ['section' => 'hosting-plans']);
    })->name('hosting.plans');
    
    Route::get('/hosting/subscriptions', function () {
        return view('users.users', ['section' => 'my-subscriptions']);
    })->name('hosting.subscriptions');
    
    Route::get('/hosting/manage', function () {
        return view('users.users', ['section' => 'manage-hosting']);
    })->name('hosting.manage');
    
    // Domains Routes
    Route::get('/domains/subdomains', function () {
        return view('users.users', ['section' => 'my-subdomains']);
    })->name('domains.subdomains');
    
    Route::get('/domains/dns', function () {
        return view('users.users', ['section' => 'dns-settings']);
    })->name('domains.dns');
    
    // Billing Routes
    Route::get('/billing/invoices', function () {
        return view('users.users', ['section' => 'invoices']);
    })->name('billing.invoices');
    
    Route::get('/billing/history', function () {
        return view('users.users', ['section' => 'transaction-history']);
    })->name('billing.history');
    
    // User Routes
    Route::get('/user/profile', function () {
        return view('users.users', ['section' => 'my-profile']);
    })->name('user.profile');
    
    Route::get('/user/settings', function () {
        return view('users.users', ['section' => 'account-settings']);
    })->name('user.settings');
    
    // Support Routes
    Route::get('/support/live-chat', function () {
        return view('users.users', ['section' => 'live-chat']);
    })->name('support.live_chat');
    
    // Volt::route('/register', 'auth.register')->name('register');
});

//ingin menambahkan file route lain
require __DIR__ . '/admin.php';