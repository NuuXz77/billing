<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Chatbot routes
Route::prefix('chatbot')->group(function () {
    Route::post('/send', [ChatbotController::class, 'sendMessage']);
    Route::get('/test', [ChatbotController::class, 'testConnection']);
});

// Payment API routes
Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);           // GET /api/payments
    Route::post('/', [PaymentController::class, 'store']);          // POST /api/payments
    Route::get('/methods', [PaymentController::class, 'methods']);  // GET /api/payments/methods
    Route::get('/statistics', [PaymentController::class, 'statistics']); // GET /api/payments/statistics
    Route::get('/{id}', [PaymentController::class, 'show']);        // GET /api/payments/{id}
    Route::put('/{id}', [PaymentController::class, 'update']);      // PUT /api/payments/{id}
    Route::patch('/{id}', [PaymentController::class, 'update']);    // PATCH /api/payments/{id}
    Route::delete('/{id}', [PaymentController::class, 'destroy']);  // DELETE /api/payments/{id}
});

// Product API routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);           // GET /api/products
    Route::post('/', [ProductController::class, 'store']);          // POST /api/products
    Route::get('/statistics', [ProductController::class, 'statistics']); // GET /api/products/statistics
    Route::get('/popular', [ProductController::class, 'popular']);  // GET /api/products/popular
    Route::get('/{id}', [ProductController::class, 'show']);        // GET /api/products/{id}
    Route::put('/{id}', [ProductController::class, 'update']);      // PUT /api/products/{id}
    Route::patch('/{id}', [ProductController::class, 'update']);    // PATCH /api/products/{id}
    Route::delete('/{id}', [ProductController::class, 'destroy']);  // DELETE /api/products/{id}
});

// Transaction API routes - Complete Flow
Route::prefix('transactions')->group(function () {
    // Step 1: Get available products
    Route::get('/products', [TransactionController::class, 'getAvailableProducts']); // GET /api/transactions/products
    
    // Step 2: Get payment methods for product
    Route::get('/products/{productId}/payments', [TransactionController::class, 'getPaymentMethods']); // GET /api/transactions/products/{id}/payments
    
    // Step 3: Create transaction
    Route::post('/', [TransactionController::class, 'createTransaction']); // POST /api/transactions
    
    // Step 4: Upload payment proof
    Route::post('/{id}/upload-proof', [TransactionController::class, 'uploadPaymentProof']); // POST /api/transactions/{id}/upload-proof
    
    // Step 5: Admin confirm payment
    Route::post('/{id}/confirm', [TransactionController::class, 'confirmPayment']); // POST /api/transactions/{id}/confirm
    
    // General CRUD operations
    Route::get('/', [TransactionController::class, 'index']);       // GET /api/transactions
    Route::get('/{id}', [TransactionController::class, 'show']);    // GET /api/transactions/{id}
    Route::get('/user/{userId}', [TransactionController::class, 'getUserTransactions']); // GET /api/transactions/user/{userId}
});