{{-- Transaction History Section --}}
<section id="transaction-history" class="min-h-screen bg-white py-16 px-6 relative overflow-hidden" style="padding-top: 88px;">
    <div class="container mx-auto max-w-7xl relative z-10">
        @if(config('app.debug'))
        <script>
            console.log('Filter Debug:', {
                date_from: '{{ request('date_from', 'not set') }}',
                date_to: '{{ request('date_to', 'not set') }}',
                type: '{{ request('type', 'not set') }}',
                status: '{{ request('status', 'not set') }}',
                total_results: {{ $transactions->total() }},
                first_3_transactions: @json($transactions->take(3)->map(function($t) { 
                    return ['code' => $t->transaction_code, 'type' => $t->transaction_type, 'status' => $t->status]; 
                }))
            });
        </script>
        @endif
        
        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-['Source_Sans_Pro'] text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Transaction History
            </h1>
            <p class="text-lg text-gray-600">
                View all your payment transactions, renewals, and purchases.
            </p>
        </div>

        {{-- Filter & Export Tools --}}
        <form method="GET" action="{{ route('billing.history') }}" class="bg-gray-50 rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4 flex-1">
                    {{-- Date Range Filter --}}
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-bold text-gray-900">From:</label>
                        <input type="date" name="date_from" value="{{ request('date_from', '2025-01-01') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-gray-400 focus:ring-1 focus:ring-gray-400 text-sm text-gray-900 font-bold hover:bg-gray-200 active:bg-gray-300 transition-all duration-200" style="color-scheme: light;">
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-bold text-gray-900">To:</label>
                        <input type="date" name="date_to" value="{{ request('date_to', date('Y-m-d')) }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-gray-400 focus:ring-1 focus:ring-gray-400 text-sm text-gray-900 font-bold hover:bg-gray-200 active:bg-gray-300 transition-all duration-200" style="color-scheme: light;">
                    </div>

                    {{-- Type Filter --}}
                    <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-gray-400 focus:ring-1 focus:ring-gray-400 text-sm text-gray-900 font-bold bg-white hover:bg-gray-200 active:bg-gray-300 transition-all duration-200">
                        <option value="all" {{ request('type', 'all') == 'all' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">All Types</option>
                        <option value="payment" {{ request('type') == 'payment' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Payment</option>
                        <option value="renewal" {{ request('type') == 'renewal' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Renewal</option>
                        <option value="purchase" {{ request('type') == 'purchase' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Purchase</option>
                        <option value="topup" {{ request('type') == 'topup' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Top Up</option>
                    </select>

                    {{-- Status Filter --}}
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-gray-400 focus:ring-1 focus:ring-gray-400 text-sm text-gray-900 font-bold bg-white hover:bg-gray-200 active:bg-gray-300 transition-all duration-200">
                        <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Success</option>
                        <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Pending Payment</option>
                        <option value="pending_confirm" {{ request('status') == 'pending_confirm' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Pending Confirm</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Canceled</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Rejected</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }} class="text-gray-900 font-semibold hover:bg-gray-200 active:bg-gray-300">Expired</option>
                    </select>

                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-6 rounded-lg transition-all text-sm">
                        Apply Filter
                    </button>
                </div>

                {{-- Export Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="button" onclick="window.location.href='{{ route('billing.history') }}?export=csv&date_from={{ request('date_from', '2025-01-01') }}&date_to={{ request('date_to', date('Y-m-d')) }}&type={{ request('type', 'all') }}&status={{ request('status', 'all') }}'" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export CSV
                    </button>
                    <button type="button" onclick="window.location.href='{{ route('billing.history') }}?export=pdf&date_from={{ request('date_from', '2025-01-01') }}&date_to={{ request('date_to', date('Y-m-d')) }}&type={{ request('type', 'all') }}&status={{ request('status', 'all') }}'" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export PDF
                    </button>
                </div>
            </div>
        </form>

        {{-- Transaction Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Transactions</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-gray-200 rounded-xl">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-green-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Success</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['success'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-green-200 rounded-xl">
                        <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-red-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Failed</p>
                        <p class="text-3xl font-bold text-red-600">{{ $stats['failed'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-red-200 rounded-xl">
                        <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format(($stats['total_amount'] ?? 0) / 1000, 1) }}K</p>
                    </div>
                    <div class="p-3 bg-gray-200 rounded-xl">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transactions Table --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200" style="overflow: visible;">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-['Source_Sans_Pro'] text-2xl font-bold text-gray-900">All Transactions</h2>
            </div>
            
            <div class="overflow-x-auto" style="overflow-y: visible;">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm font-semibold text-gray-700">{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="font-mono text-sm font-bold text-gray-900">{{ $transaction->transaction_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $typeIcons = [
                                        'payment' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
                                        'renewal' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                                        'purchase' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                                        'topup' => 'M12 6v6m0 0v6m0-6h6m-6 0H6'
                                    ];
                                    $typeIcon = $typeIcons[$transaction->transaction_type] ?? $typeIcons['payment'];
                                @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-200 text-gray-900 text-xs font-bold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $typeIcon }}"/>
                                    </svg>
                                    {{ ucfirst($transaction->transaction_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="font-bold {{ $transaction->transaction_type === 'topup' ? 'text-green-600' : 'text-gray-900' }}">
                                    {{ $transaction->transaction_type === 'topup' ? '+ ' : '' }}Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm text-gray-700 font-medium">Bank Transfer ({{ $transaction->payment_method }})</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusConfig = [
                                        'active' => ['bg' => 'bg-green-200', 'text' => 'text-green-800', 'label' => 'Success', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'pending_payment' => ['bg' => 'bg-yellow-200', 'text' => 'text-yellow-800', 'label' => 'Pending', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'pending_confirm' => ['bg' => 'bg-blue-200', 'text' => 'text-blue-800', 'label' => 'Confirming', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'expired' => ['bg' => 'bg-gray-200', 'text' => 'text-gray-800', 'label' => 'Expired', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'canceled' => ['bg' => 'bg-red-200', 'text' => 'text-red-800', 'label' => 'Canceled', 'icon' => 'M6 18L18 6M6 6l12 12'],
                                        'rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-800', 'label' => 'Rejected', 'icon' => 'M6 18L18 6M6 6l12 12']
                                    ];
                                    $status = $statusConfig[$transaction->status] ?? $statusConfig['pending_payment'];
                                @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 {{ $status['bg'] }} {{ $status['text'] }} text-xs font-bold rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $status['icon'] }}"/>
                                    </svg>
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                                <p>{{ $transaction->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $transaction->created_at->format('h:i A') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200" onclick="toggleDropdown(event, 'dropdown-trx-{{ $transaction->id }}')">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-trx-{{ $transaction->id }}" class="hidden fixed w-48 rounded-lg shadow-lg bg-white border border-gray-200" style="z-index: 9999;">
                                        <div class="py-1">
                                            <button onclick="openModal('viewDetailsModal-{{ $transaction->id }}')" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </button>
                                            @if(in_array($transaction->status, ['pending_payment', 'pending_confirm']))
                                            <button onclick="openModal('{{ $transaction->status === 'pending_payment' ? 'payNowModal' : 'uploadProofModal' }}-{{ $transaction->id }}')" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 transition-colors duration-200 font-semibold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                {{ $transaction->status === 'pending_payment' ? 'Pay Now' : 'Upload Proof' }}
                                            </button>
                                            @endif
                                            @if($transaction->status === 'active')
                                            <button onclick="openModal('downloadReceiptModal-{{ $transaction->id }}')" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download Receipt
                                            </button>
                                            @endif
                                            @if(in_array($transaction->status, ['pending_payment']))
                                            <button onclick="openModal('cancelTransactionModal-{{ $transaction->id }}')" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Cancel Transaction
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium">No transactions found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                        {{-- Include Modals for each transaction --}}
                        @foreach($transactions as $transaction)
                            @include('members.sections.partials.partials_2.dropdown_transaksi.view_details_modal')
                            @include('members.sections.partials.partials_2.dropdown_transaksi.pay_now_modal')
                            @include('members.sections.partials.partials_2.dropdown_transaksi.upload_proof_modal')
                            @include('members.sections.partials.partials_2.dropdown_transaksi.download_receipt_modal')
                            @include('members.sections.partials.partials_2.dropdown_transaksi.cancel_transaction_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($transactions->hasPages())
            <div class="p-6 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Showing {{ $transactions->firstItem() ?? 0 }} to {{ $transactions->lastItem() ?? 0 }} of {{ $transactions->total() }} transactions
                </p>
                <div class="flex items-center gap-2">
                    @if($transactions->onFirstPage())
                        <button disabled class="inline-flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </button>
                    @else
                        <a href="{{ $transactions->appends(request()->except('page'))->previousPageUrl() }}" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </a>
                    @endif
                    
                    @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                        @if($page == $transactions->currentPage())
                            <button class="px-4 py-2 bg-gray-900 text-white rounded-lg font-medium text-sm">{{ $page }}</button>
                        @else
                            <a href="{{ $transactions->appends(request()->except('page'))->url($page) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-900">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($transactions->hasMorePages())
                        <a href="{{ $transactions->appends(request()->except('page'))->nextPageUrl() }}" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-900">
                            Next
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @else
                        <button disabled class="inline-flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">
                            Next
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@push('scripts')
<script>
    function toggleDropdown(event, dropdownId) {
        event.stopPropagation();
        
        // Close all other dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            if (dropdown.id !== dropdownId) {
                dropdown.classList.add('hidden');
            }
        });
        
        const dropdown = document.getElementById(dropdownId);
        const button = event.currentTarget;
        
        if (dropdown.classList.contains('hidden')) {
            // Show dropdown
            dropdown.classList.remove('hidden');
            
            // Calculate position
            const buttonRect = button.getBoundingClientRect();
            const dropdownWidth = 192; // w-48 = 12rem = 192px
            
            // Position dropdown
            dropdown.style.top = (buttonRect.bottom + 5) + 'px';
            dropdown.style.left = (buttonRect.left - dropdownWidth + buttonRect.width) + 'px';
        } else {
            dropdown.classList.add('hidden');
        }
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
    
    // Close dropdown on scroll
    window.addEventListener('scroll', function() {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }, true);
</script>

{{-- Include Modal Informasi --}}
@include('members.sections.partials.partials_2.dropdown_transaksi.modal_informasi.modal_informasi')

{{-- Include Modal Scripts --}}
@include('members.sections.partials.partials_2.dropdown_transaksi.modal_scripts')
@endpush
