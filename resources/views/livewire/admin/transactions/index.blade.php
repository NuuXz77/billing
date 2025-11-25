<div>
    {{-- breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-2xl">Manajemen Transaksi</h1>
            <p class="text-base-content/60">Kelola semua transaksi pelanggan</p>
        </div>
        <div>
            <div class="breadcrumbs text-sm">
                <ul>
                    <li>
                        <a href="/admin/dashboard" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-4 w-4 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Transaksi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if (session()->has('message'))
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition>
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total Transactions --}}
        <div class="card bg-base-100 border border-base-300 hover:shadow-lg transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-primary/10 text-primary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-base-content/60 font-medium">Total Transaksi</p>
                        <div class="flex items-end gap-2">
                            <h3 class="text-2xl font-bold text-base-content">{{ $totalTransactions }}</h3>
                            <span class="text-xs text-primary font-semibold">+{{ $newTransactionsToday }}</span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="card bg-base-100 border border-base-300 hover:shadow-lg transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-success/10 text-success rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-base-content/60 font-medium">Total Pendapatan</p>
                        <div class="flex items-end gap-2">
                            <h3 class="text-xl font-bold text-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                        <p class="text-xs text-base-content/50">Dari transaksi aktif</p>
                    </div>  
                </div>
            </div>
        </div>

        {{-- Pending Confirmations --}}
        <div class="card bg-base-100 border border-base-300 hover:shadow-lg transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-warning/10 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-base-content/60 font-medium">Pending Konfirmasi</p>
                        <div class="flex items-end gap-2">
                            <h3 class="text-2xl font-bold text-warning">{{ $pendingConfirmations }}</h3>
                            @if($pendingConfirmations > 0)
                                <span class="text-xs text-error font-semibold">Perlu aksi</span>
                            @else
                                <span class="text-xs text-success font-semibold">Semua clear</span>
                            @endif
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        {{-- Active Services --}}
        <div class="card bg-base-100 border border-base-300 hover:shadow-lg transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-info/10 text-info rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-base-content/60 font-medium">Layanan Aktif</p>
                        <div class="flex items-end gap-2">
                            <h3 class="text-2xl font-bold text-info">{{ $activeServices }}</h3>
                            <span class="text-xs text-base-content/50">Running</span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    {{-- Additional Stats Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        {{-- Today's Transactions --}}
        <div class="card bg-linear-to-br from-blue-50 to-blue-100 border border-blue-200">
            <div class="card-body p-4 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="p-2 bg-blue-500/20 text-blue-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-blue-700">{{ $todayTransactions }}</h4>
                        <p class="text-xs text-blue-600 font-medium">Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- This Month --}}
        <div class="card bg-linear-to-br from-green-50 to-green-100 border border-green-200">
            <div class="card-body p-4 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="p-2 bg-green-500/20 text-green-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-green-700">{{ $monthlyTransactions }}</h4>
                        <p class="text-xs text-green-600 font-medium">Bulan Ini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Payments --}}
        <div class="card bg-linear-to-br from-orange-50 to-orange-100 border border-orange-200">
            <div class="card-body p-4 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="p-2 bg-orange-500/20 text-orange-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-orange-700">{{ $pendingPayments }}</h4>
                        <p class="text-xs text-orange-600 font-medium">Pending Payment</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rejected/Canceled --}}
        <div class="card bg-linear-to-br from-red-50 to-red-100 border border-red-200">
            <div class="card-body p-4 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="p-2 bg-red-500/20 text-red-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-red-700">{{ $rejectedTransactions }}</h4>
                        <p class="text-xs text-red-600 font-medium">Ditolak/Dibatalkan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Rate --}}
        <div class="card bg-linear-to-br from-purple-50 to-purple-100 border border-purple-200">
            <div class="card-body p-4 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="p-2 bg-purple-500/20 text-purple-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-purple-700">{{ $successRate }}%</h4>
                        <p class="text-xs text-purple-600 font-medium">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modern Table Card --}}
    <div class="card bg-base-100 border border-base-300">
        <div class="card-body">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="card-title text-2xl">Daftar Transaksi</h2>
                    <p class="text-slate-600">Kelola semua transaksi pelanggan</p>
                </div>
                <div class="badge badge-neutral badge-soft">{{ $transactions->total() }} Total</div>
            </div>

            {{-- Clean Filters & Actions Bar --}}
            <div class="card p-5 bg-base-100 border border-base-300">
                {{-- Main Controls Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
                    {{-- Search Field --}}
                    <div class="col-span-1 lg:col-span-4">
                        <label class="input w-full">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" class="grow" wire:model.live.debounce.300ms="search"
                                placeholder="Cari kode, user, produk..." />
                        </label>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="statusFilter" class="select w-full">
                            <option value="">Semua Status</option>
                            <option value="pending_payment">Pending Pembayaran</option>
                            <option value="pending_confirm">Pending Konfirmasi</option>
                            <option value="active">Aktif</option>
                            <option value="expired">Kedaluwarsa</option>
                            <option value="canceled">Dibatalkan</option>
                            <option value="rejected">Ditolak</option>
                            <option value="refunded">Dikembalikan</option>
                        </select>
                    </div>

                    {{-- Product Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="productFilter" class="select w-full">
                            <option value="">Semua Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Payment Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="paymentFilter" class="select w-full">
                            <option value="">Semua Metode</option>
                            @foreach($payments as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->payment_method }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-span-1 lg:col-span-2 flex">
                        <div class="grid grid-cols-2 gap-2 w-full">
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </div>
                                <ul tabindex="0"
                                    class="dropdown-content menu rounded-box z-50 w-52 p-2 shadow-xl bg-base-100 border border-base-300">
                                    <li><a class="rounded-lg px-3 py-2 hover:text-neutral hover:bg-neutral/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Export Data
                                        </a></li>
                                    <li><a wire:click="clearFilters" class="rounded-lg px-3 py-2 hover:text-warning hover:bg-warning/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Refresh Data
                                        </a></li>
                                </ul>
                            </div>
                            {{-- Per Page Select --}}
                            <select wire:model.live="perPage" class="select select-bordered w-full">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if ($search || $statusFilter || $productFilter || $paymentFilter)
                    <div class="mt-4 pt-4 border-t border-base-300">
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-sm font-medium text-slate-600 mr-2">Filter aktif:</span>
                            @if ($search)
                                <div
                                    class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    "{{ $search }}"
                                    <button wire:click="$set('search', '')"
                                        class="hover:bg-blue-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if ($statusFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    @php
                                        $statusLabels = [
                                            'pending_payment' => 'Pending Pembayaran',
                                            'pending_confirm' => 'Pending Konfirmasi',
                                            'active' => 'Aktif',
                                            'expired' => 'Kedaluwarsa',
                                            'canceled' => 'Dibatalkan',
                                            'rejected' => 'Ditolak',
                                            'refunded' => 'Dikembalikan'
                                        ];
                                    @endphp
                                    {{ $statusLabels[$statusFilter] ?? ucfirst($statusFilter) }}
                                    <button wire:click="$set('statusFilter', '')"
                                        class="hover:bg-purple-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if ($productFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    {{ $products->find($productFilter)->name_product ?? '' }}
                                    <button wire:click="$set('productFilter', '')"
                                        class="hover:bg-green-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if ($paymentFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    {{ $payments->find($paymentFilter)->payment_method ?? '' }}
                                    <button wire:click="$set('paymentFilter', '')"
                                        class="hover:bg-orange-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <button wire:click="clearFilters"
                                class="inline-flex items-center gap-1 text-red-600 hover:bg-red-50 px-3 py-1 rounded-full text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset semua
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Modern Table --}}
            <div class="overflow-x-auto card p-5 bg-base-100 border border-base-300">
                <table class="table table-hover w-full">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-semibold text-center" style="width: 50px;">#</th>
                            <th class="font-semibold text-center" style="width: 160px;">Transaksi</th>
                            <th class="font-semibold text-center" style="width: 180px;">Pelanggan</th>
                            <th class="font-semibold text-center" style="width: 150px;">Produk</th>
                            <th class="font-semibold text-center" style="width: 120px;">Pembayaran</th>
                            <th class="font-semibold text-center" style="width: 120px;">Total</th>
                            <th class="font-semibold text-center" style="width: 130px;">Status</th>
                            <th class="font-semibold text-center" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $transaction)
                            <tr class="hover transition-colors hover:bg-base-200">
                                {{-- Number --}}
                                <td class="font-mono text-sm">
                                    {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $index + 1 }}
                                </td>

                                {{-- Transaction Info --}}
                                <td class="text-center py-2">
                                    <div class="flex flex-col gap-0.5 items-center">
                                        <div class="font-mono font-bold text-xs text-primary">
                                            {{ $transaction->transaction_code }}
                                        </div>
                                        <div class="text-xs text-base-content/60">
                                            {{ $transaction->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-base-content/60">
                                            {{ $transaction->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Customer Info --}}
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content w-8 h-8 rounded-full">
                                                <span class="text-xs font-semibold">{{ strtoupper(substr($transaction->user->full_name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <div class="font-semibold text-xs truncate">{{ $transaction->user->full_name }}</div>
                                            <div class="text-xs text-base-content/60 truncate">{{ $transaction->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Product Info --}}
                                <td class="text-center">
                                    <div class="flex flex-col gap-0.5 items-center">
                                        <div class="font-semibold text-xs truncate" style="max-width: 140px;" title="{{ $transaction->product->name_product }}">
                                            {{ $transaction->product->name_product }}
                                        </div>
                                        <div class="text-xs text-base-content/60">
                                            {{ ucfirst($transaction->billing_cycle) }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Payment Info --}}
                                <td class="text-center">
                                    <div class="flex flex-col gap-0.5 items-center">
                                        <div class="font-semibold text-xs">{{ $transaction->payment->payment_method }}</div>
                                        <div class="text-xs text-base-content/60">{{ $transaction->payment->payment_bank }}</div>
                                    </div>
                                </td>

                                {{-- Total --}}
                                <td class="text-center">
                                    <div class="font-bold text-xs text-primary">
                                        Rp {{ number_format($transaction->total_payment / 1000, 0) }}K
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @php
                                        $statusConfig = [
                                            'pending_payment' => ['class' => 'badge-soft badge-sm badge-warning', 'text' => 'Pending Pembayaran'],
                                            'pending_confirm' => ['class' => 'badge-soft badge-sm badge-info', 'text' => 'Pending Konfirmasi'],
                                            'active' => ['class' => 'badge-soft badge-sm badge-success', 'text' => 'Aktif'],
                                            'expired' => ['class' => 'badge-soft badge-sm badge-error', 'text' => 'Kedaluwarsa'],
                                            'canceled' => ['class' => 'badge-soft badge-sm badge-neutral', 'text' => 'Dibatalkan'],
                                            'rejected' => ['class' => 'badge-soft badge-sm badge-error', 'text' => 'Ditolak'],
                                            'refunded' => ['class' => 'badge-soft badge-sm badge-accent', 'text' => 'Dikembalikan']
                                        ];
                                        $status = $statusConfig[$transaction->status] ?? ['class' => 'badge-soft badge-ghost badge-sm', 'text' => ucfirst($transaction->status)];
                                    @endphp
                                    <div class="badge {{ $status['class'] }}">
                                        @if($transaction->status === 'active')
                                            <div class="status status-success mr-1"></div>
                                        @elseif($transaction->status === 'pending_confirm')
                                            <div class="status status-info mr-1"></div>
                                        @elseif($transaction->status === 'pending_payment')
                                            <div class="status status-warning mr-1"></div>
                                        @else
                                            <div class="status status-error mr-1"></div>
                                        @endif
                                        {{ $status['text'] }}
                                    </div>
                                </td>

                                {{-- Actions Dropdown --}}
                                <td>
                                    <div class="flex justify-center">
                                        <div class="relative inline-block text-left">
                                            <button type="button" 
                                                class="btn btn-ghost btn-circle" 
                                                onclick="toggleDropdown(event, 'dropdown-trx-{{ $transaction->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                            <ul id="dropdown-trx-{{ $transaction->id }}" 
                                                class="hidden fixed menu rounded-box w-52 p-2 shadow-xl bg-base-100 border border-base-300" 
                                                style="z-index: 9999;">
                                                {{-- Detail Button - Always Available --}}
                                                <li>
                                                    <a href="{{ route('admin.transactions.detail', $transaction->id) }}" wire:navigate
                                                        class="text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                
                                                {{-- Conditional Actions Based on Status --}}
                                                @if($transaction->status === 'pending_confirm')
                                                    {{-- Approve Button --}}
                                                    <li>
                                                        <button wire:click="openConfirmSubdomainModal({{ $transaction->id }})"
                                                            class="text-success hover:bg-success/10 rounded-lg transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            Konfirmasi Transaksi
                                                        </button>
                                                    </li>
                                                    {{-- Reject Button --}}
                                                    <li>
                                                        <button wire:click="openRejectModal({{ $transaction->id }})"
                                                            class="text-error hover:bg-error/10 rounded-lg transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            Tolak Transaksi
                                                        </button>
                                                    </li>
                                                @elseif($transaction->status === 'pending_payment' || $transaction->status === 'active')
                                                    {{-- Delete Button --}}
                                                    <li>
                                                        <button wire:click="deleteTransaction({{ $transaction->id }})"
                                                            wire:confirm="Apakah Anda yakin ingin menghapus transaksi ini?"
                                                            class="text-error hover:bg-error/10 rounded-lg transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Hapus Transaksi
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="font-semibold">Tidak ada transaksi ditemukan</p>
                                            <p class="text-sm">Data transaksi akan muncul di sini</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Custom Pagination --}}
            <div class="mt-6">
                <x-pagination.custom :paginator="$transactions" :showingText="true"
                    showingFormat="Menampilkan {from} - {to} dari {total} transaksi" size="default" />
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.transactions.modals.confirm-subdomain')
    @include('livewire.admin.transactions.modals.confirm-admin')
    @include('livewire.admin.transactions.modals.reject')
    
    {{-- Dropdown Script --}}
    <script>
        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            
            // Close all other dropdowns
            document.querySelectorAll('[id^="dropdown-trx-"]').forEach(dropdown => {
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
                const dropdownWidth = 208; // w-52 = 13rem = 208px
                
                // Position dropdown to the left of the button
                dropdown.style.top = (buttonRect.bottom + 5) + 'px';
                dropdown.style.left = (buttonRect.left - dropdownWidth + buttonRect.width) + 'px';
            } else {
                dropdown.classList.add('hidden');
            }
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-trx-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
        
        // Close dropdown on scroll
        window.addEventListener('scroll', function() {
            document.querySelectorAll('[id^="dropdown-trx-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }, true);
    </script>
</div>
