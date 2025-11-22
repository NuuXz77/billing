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
Route::middleware(['auth', 'role:member'])->group(function () {
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
    
    Route::get('/billing/history', function (\Illuminate\Http\Request $request) {
        $userId = auth()->id();
        
        // Build query dengan filter
        $query = \App\Models\Transaction::where('user_id', $userId);
        
        // Get filter parameters
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $type = $request->input('type', 'all');
        $status = $request->input('status', 'all');
        
        // Apply filters
        if (!empty($dateFrom)) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if (!empty($dateTo)) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        if (!empty($type) && $type !== 'all') {
            $query->where('transaction_type', $type);
        }
        if (!empty($status) && $status !== 'all') {
            $query->where('status', $status);
        }
        
        // Add eager loading and ordering
        $query->with(['product', 'payment'])->orderBy('user_transaction_number', 'asc');
        
        // Handle export
        if ($request->has('export')) {
            $exportData = $query->get();
            
            if ($request->export == 'csv') {
                return \Response::streamDownload(function () use ($exportData) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, ['Transaction Code', 'Type', 'Amount', 'Status', 'Date']);
                    
                    foreach ($exportData as $transaction) {
                        fputcsv($file, [
                            $transaction->transaction_code,
                            ucfirst($transaction->transaction_type),
                            'Rp ' . number_format((float)$transaction->total_payment, 0, ',', '.'),
                            $transaction->status,
                            $transaction->created_at->format('Y-m-d H:i:s')
                        ]);
                    }
                    
                    fclose($file);
                }, 'transactions_' . date('Y-m-d') . '.csv');
            }
        }
        
        // Paginate
        $transactions = $query->paginate(5);
        
        // Calculate stats with same filters
        $statsQuery = \App\Models\Transaction::where('user_id', $userId);
        if (!empty($dateFrom)) $statsQuery->whereDate('created_at', '>=', $dateFrom);
        if (!empty($dateTo)) $statsQuery->whereDate('created_at', '<=', $dateTo);
        if (!empty($type) && $type !== 'all') $statsQuery->where('transaction_type', $type);
        if (!empty($status) && $status !== 'all') $statsQuery->where('status', $status);
        
        $allTransactions = $statsQuery->get();
        
        return view('members.members', [
            'section' => 'transaction-history',
            'transactions' => $transactions,
            'stats' => [
                'total' => $allTransactions->count(),
                'success' => $allTransactions->where('status', 'active')->count(),
                'failed' => $allTransactions->whereIn('status', ['canceled', 'rejected', 'expired'])->count(),
                'total_amount' => $allTransactions->where('status', 'active')->sum('total_payment')
            ]
        ]);
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
    
    // Cart Routes
    Route::get('/members/cart', function () {
        return view('members.members', ['section' => 'cart']);
    })->name('members.cart');
    
    Route::post('/members/checkout', function (\Illuminate\Http\Request $request) {
        // Log request untuk debugging
        \Log::info('Checkout Request:', $request->all());
        
        // Validasi input
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'duration' => 'required|integer|min:1',
                'total_payment' => 'required|numeric|min:0',
                'billing_cycle' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        }
        
        // Ambil data product
        $product = \App\Models\Product::findOrFail($validated['product_id']);
        
        // Ambil payment method BRI
        $payment = \App\Models\Payment::where('payment_bank', 'BRI')->first();
        
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Metode pembayaran BRI tidak tersedia'
            ], 400);
        }
        
        // Hitung tanggal mulai dan berakhir
        $startDate = now();
        $endDate = now()->addMonths($validated['duration']);
        
        // Tentukan billing cycle berdasarkan durasi
        $billingCycle = 'custom'; // default
        if ($validated['duration'] == 1) {
            $billingCycle = 'monthly';
        } elseif ($validated['duration'] == 12) {
            $billingCycle = 'yearly';
        }
        
        // Create transaction
        $transaction = \App\Models\Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'payment_id' => $payment->id,
            'transaction_type' => 'purchase',
            'description' => 'Pembelian ' . $product->name_product . ' - ' . $validated['duration'] . ' bulan',
            'status' => 'pending_payment',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_payment' => $validated['total_payment'],
            'billing_cycle' => $billingCycle,
            'payment_method' => $payment->payment_bank,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'transaction_id' => $transaction->id,
            'transaction' => $transaction->load(['product', 'payment', 'user']),
            'redirect' => route('billing.history')
        ]);
    })->name('members.checkout');
    
    // Get transaction modal HTML
    Route::get('/members/transaction-modal/{id}', function ($id) {
        $transaction = \App\Models\Transaction::with(['product', 'payment', 'user'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        // Return scripts first, then modals
        $modalScripts = view('members.sections.partials.partials_2.dropdown_transaksi.modal_scripts')->render();
        $modalInfo = view('members.sections.partials.partials_2.dropdown_transaksi.modal_informasi.modal_informasi')->render();
        $payNowModal = view('members.sections.partials.partials_2.dropdown_transaksi.pay_now_modal', ['transaction' => $transaction])->render();
        $uploadModal = view('members.sections.partials.partials_2.dropdown_transaksi.upload_proof_modal', ['transaction' => $transaction])->render();
        
        return $modalScripts . $modalInfo . $payNowModal . $uploadModal;
    })->name('members.transaction_modal');
    
    // Cancel transaction
    Route::post('/members/transactions/{id}/cancel', function (\Illuminate\Http\Request $request, $id) {
        try {
            $transaction = \App\Models\Transaction::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
            
            // Check if transaction can be cancelled
            if (in_array($transaction->status, ['canceled', 'active', 'rejected'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction cannot be cancelled at this status'
                ], 400);
            }
            
            // Update transaction status
            $transaction->status = 'canceled';
            
            // Store reason in admin_notes if provided
            if ($request->has('reason') && !empty($request->input('reason'))) {
                $transaction->admin_notes = 'User cancellation reason: ' . $request->input('reason');
            }
            
            $transaction->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Transaction has been cancelled successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Cancel transaction error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel transaction'
            ], 500);
        }
    })->name('members.transactions.cancel');
    
    // Upload payment proof
    Route::post('/members/transactions/{id}/upload-proof', function (\Illuminate\Http\Request $request, $id) {
        try {
            $transaction = \App\Models\Transaction::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
            
            // Check if transaction can receive payment proof
            if (!in_array($transaction->status, ['pending_payment', 'pending_confirm'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot upload payment proof for this transaction status'
                ], 400);
            }
            
            // Validate request
            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'sender_name' => 'required|string|max:255',
                'transfer_date' => 'nullable|date',
                'transfer_time' => 'nullable|string'
            ]);
            
            // Delete old payment proof if exists
            if ($transaction->payment_proof && \Storage::exists('public/' . $transaction->payment_proof)) {
                \Storage::delete('public/' . $transaction->payment_proof);
            }
            
            // Store new payment proof with payments_email_transactionCode format
            $file = $request->file('payment_proof');
            $userEmail = str_replace(['@', '.'], '_', auth()->user()->email); // Replace @ and . with _
            $extension = $file->getClientOriginalExtension();
            $filename = 'payments_' . $userEmail . '_' . $transaction->transaction_code . '.' . $extension;
            
            // Create directory if not exists
            if (!\Storage::exists('public/payment_proofs')) {
                \Storage::makeDirectory('public/payment_proofs');
            }
            
            $path = $file->storeAs('public/payment_proofs', $filename);
            
            // Build admin notes
            $notes = "Sender: {$request->sender_name}";
            if ($request->transfer_date) {
                $notes .= ", Transfer Date: {$request->transfer_date}";
            }
            if ($request->transfer_time) {
                $notes .= " {$request->transfer_time}";
            }
            $notes .= ", Amount: Rp " . number_format((float)$transaction->total_payment, 0, ',', '.');
            
            // Update transaction
            $transaction->payment_proof = 'payment_proofs/' . $filename;
            $transaction->status = 'pending_confirm';
            $transaction->admin_notes = $notes;
            $transaction->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Payment proof uploaded successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Upload payment proof error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload payment proof: ' . $e->getMessage()
            ], 500);
        }
    })->name('members.transactions.upload_proof');
});

// Volt::route('/register', 'auth.register')->name('register');