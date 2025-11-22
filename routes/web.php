<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;

//Route bebas tanpa middleware
Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

// Landing page routes (accessible untuk guest DAN user yang sudah login)
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

Route::get('/privacy-policy', function () {
    return view('frontend.landing_page', ['showPrivacyPolicy' => true]);
})->name('privacy-policy');

Route::get('/terms-and-conditions', function () {
    return view('frontend.landing_page', ['showTermsAndConditions' => true]);
})->name('terms-and-conditions');

//Route untuk guest only (auth routes)
Route::middleware('guest')->group(function () {
    // Authentication Routes
    Route::get('/auth/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
    Route::post('/auth/login/ajax', [App\Http\Controllers\AuthController::class, 'loginAjax'])->name('login.ajax');
    Route::get('/auth/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/auth/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
    Route::post('/auth/register/ajax', [App\Http\Controllers\AuthController::class, 'registerAjax'])->name('register.ajax');
});

//Route untuk authenticated users
Route::middleware('auth')->group(function () {
    // Profile update route
    Route::post('/profile/update', [App\Http\Controllers\AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Password update route
    Route::post('/password/update', [App\Http\Controllers\AuthController::class, 'updatePassword'])->name('password.update');
	
Route::get('/kirimemail',[]);
// Route::get('/', function () {
//     return view('frontend.index');
// })->name('index');
});

//inikan menambahkan file route lain
require __DIR__ . '/auth.php';