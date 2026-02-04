<div>
    {{-- Breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-2xl">Laporan & Analitik</h1>
            <p class="text-base-content/60">Ringkasan pendapatan dan data bisnis</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Laporan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if (session()->has('message'))
        <div class="toast toast-top toast-end z-9999" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
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

    {{-- Filter Periode --}}
    <div class="card bg-base-100 border border-base-300 mb-6">
        <div class="card-body p-4">
            {{-- Date Range Selection --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- From Date --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-success">Dari:</label>
                    <input type="date" wire:model.live="fromDate" class="input input-bordered w-full input-sm" />
                </div>

                {{-- To Date --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-error">Sampai:</label>
                    <input type="date" wire:model.live="toDate" class="input input-bordered w-full input-sm" />
                </div>
            </div>

            {{-- Date Range Display --}}
            <div class="mt-4 p-3 bg-base-200 rounded-lg">
                <div class="text-sm">
                    <span class="font-medium">Periode dipilih: </span>
                    <span class="text-success font-semibold">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    <span class="mx-2">-</span>
                    <span class="text-error font-semibold">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 1. Laporan Pendapatan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div
            class="card bg-base-100 border border-success hover:shadow-xl hover:shadow-success/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-success/10 text-success rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailPendapatanModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li>
                                <a wire:click="exportPDF('revenue')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                        <path
                                            d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg> Export PDF
                                </a>
                            </li>
                            <li>
                                <a wire:click="exportExcel('revenue')"
                                    class="text-xs text-success hover:bg-success/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                        <path
                                            d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg> Export Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-success-content/90">Rp
                        {{ number_format($revenueData['monthly'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-success font-medium">Pendapatan Range</p>
                    <p class="text-xs text-success-content/95 mt-1">Hari ini: Rp
                        {{ number_format($revenueData['daily'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-primary hover:shadow-xl hover:shadow-primary/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-primary/20 text-primary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailTotalRangeModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('revenue')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('revenue')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-primary">Rp
                        {{ number_format($revenueData['total_annual'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-primary/80 font-medium">Total Range</p>
                    <p class="text-xs text-primary mt-1">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('M d') : '' }} -
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('M d, Y') : '' }}</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-secondary hover:shadow-xl hover:shadow-secondary/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-secondary/20 text-secondary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailProdukTerjualModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('product')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('product')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-secondary">{{ $revenueData['per_product']->count() }}</h3>
                    <p class="text-sm text-secondary/80 font-medium">Produk Terjual</p>
                    <p class="text-xs text-secondary mt-1">Periode ini</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-warning hover:shadow-xl hover:shadow-warning/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-warning/20 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailArpuModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('user')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('user')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-warning">Rp
                        {{ number_format($userData['arpu'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-sm text-warning/80 font-medium">ARPU</p>
                    <p class="text-xs text-warning mt-1">Rata-rata per user</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Laporan Invoice & Subscription --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div
            class="card bg-base-100 border border-accent hover:shadow-xl hover:shadow-accent/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-accent/10 text-accent rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailTotalInvoiceModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('invoice')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('invoice')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-accent-content">{{ $invoiceData['total'] }}</h3>
                    <p class="text-sm text-accent font-medium">Total Invoice</p>
                    <div class="flex gap-2 text-xs mt-1">
                        <span class="text-green-600">Dibayar: {{ $invoiceData['paid'] }}</span>
                        <span class="text-orange-600">Pending: {{ $invoiceData['unpaid'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-error hover:shadow-xl hover:shadow-error/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-error/20 text-error rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailOutstandingModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('outstanding')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('outstanding')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-error">Rp
                        {{ number_format($invoiceData['outstanding'], 0, ',', '.') }}</h3>
                    <p class="text-sm text-error/80 font-medium">Outstanding</p>
                    <p class="text-xs text-error mt-1">Piutang belum terbayar</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-info hover:shadow-xl hover:shadow-info/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-info/20 text-info rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailSubscriptionAktifModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('subscription')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('subscription')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-info">{{ $subscriptionData['active'] }}</h3>
                    <p class="text-sm text-info/80 font-medium">Subscription Aktif</p>
                    <p class="text-xs text-info mt-1">Baru: {{ $subscriptionData['new'] }}</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-accent hover:shadow-xl hover:shadow-accent/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-accent/20 text-accent rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailAkanBerakhirModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('expiring')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('expiring')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-accent">{{ $subscriptionData['expiring'] }}</h3>
                    <p class="text-sm text-accent/90 font-medium">Akan Berakhir</p>
                    <p class="text-xs text-accent mt-1">30 hari ke depan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Laporan User --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div
            class="card bg-base-100 border border-neutral hover:shadow-xl hover:shadow-neutral/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-indigo-500/20 text-indigo-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailUserAktifModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('users')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('users')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-neutral">{{ $userData['active'] }}</h3>
                    <p class="text-sm text-neutral/80 font-medium">User Aktif</p>
                    <p class="text-xs text-neutral mt-1">Total: {{ $userData['total'] }}</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-warning hover:shadow-xl hover:shadow-warning/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-warning/20 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailUserBaruModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('new-users')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('new-users')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-warning">{{ $userData['new'] }}</h3>
                    <p class="text-sm text-warning/80 font-medium">User Baru</p>
                    <p class="text-xs text-warning mt-1">Periode ini</p>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 border border-error hover:shadow-xl hover:shadow-error/20 transition-all duration-300">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-error/20 text-error rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </div>
                        <ul tabindex="0"
                            class="dropdown-content menu rounded-box z-50 w-48 shadow-xl bg-base-100 border border-base-300">
                            <li>
                                <a wire:click="$set('showDetailGagalPerpanjangModal', true)"
                                    class="text-xs text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg> Detail
                                </a>
                            </li>
                            <li><a wire:click="exportPDF('failed-renewals')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    PDF</a></li>
                            <li><a wire:click="exportExcel('failed-renewals')"
                                    class="text-xs text-error hover:bg-error/10 rounded-lg transition-colors">Export
                                    Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-error">{{ $subscriptionData['failed'] }}</h3>
                    <p class="text-sm text-error/80 font-medium">Gagal Perpanjang</p>
                    <p class="text-xs text-error mt-1">Periode ini</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Laporan Produk Detail --}}
    <div class="card bg-base-100 border border-base-300 mb-6">
        <div class="card-body">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="card-title text-2xl">Laporan Produk</h2>
                    <p class="text-slate-600">Performance setiap produk periode ini</p>
                </div>
                <!--<div class="flex gap-2">
                    <button wire:click="exportPDF('product-detail')" class="btn btn-outline btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export PDF
                    </button>
                    <button wire:click="exportExcel('product-detail')" class="btn btn-outline btn-success btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export Excel
                    </button>
                </div> -->
            </div>

            <div class="overflow-x-auto">
                <table class="table table-hover w-full">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-semibold">#</th>
                            <th class="font-semibold">Produk</th>
                            <th class="font-semibold text-center">Transaksi</th>
                            <th class="font-semibold text-center">Pendapatan</th>
                            <th class="font-semibold text-center">Harga</th>
                            <th class="font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productData as $index => $product)
                            <tr class="hover transition-colors">
                                <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                <td>
                                    <div>
                                        <div class="font-semibold text-sm">{{ $product->name_product }}</div>
                                        <div class="text-xs text-base-content/60">
                                            {{ Str::limit($product->description, 50) }}</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-primary badge-soft badge-sm">
                                        {{ $product->transactions_count ?? $product->total_transactions ?? $product->transaction_count ?? 0 }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="font-bold text-success">
                                        Rp {{ number_format($product->total_revenue ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="text-sm font-medium">
                                        Rp {{ number_format($product->price_monthly ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div
                                        class="badge {{ ($product->status ?? $product->is_active ?? 'active') == 'active' ? 'badge-success' : 'badge-error' }} badge-soft badge-sm">
                                        {{ ($product->status ?? $product->is_active ?? 'active') == 'active' ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <p class="text-slate-500">Tidak ada data produk untuk periode ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 5. Export Summary --}}
    <!-- <div class="card bg-base-100rom-slate-50 to-slate-100 border border-slate-300">
        <div class="card-body p-6">
            <div class="text-center">
                <h3 class="text-xl font-bold mb-2">Export Laporan Lengkap</h3>
                <p class="text-slate-600 mb-4">
                    Download laporan keuangan lengkap untuk periode
                    {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }} -
                    {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                </p>
                <div class="flex justify-center gap-4">
                    <button wire:click="exportPDF('financial-statement')" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Financial Statement (PDF)
                    </button>
                    <button wire:click="exportExcel('comprehensive')" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Comprehensive Report (Excel)
                    </button>
                </div>
            </div>
        </div>
    </div> -->

    {{-- Include All Modal Files --}}
    @include('livewire.admin.reports.modals.detail-pendapatan')
    @include('livewire.admin.reports.modals.detail-total-range')
    @include('livewire.admin.reports.modals.detail-produk-terjual')
    @include('livewire.admin.reports.modals.detail-arpu')
    @include('livewire.admin.reports.modals.detail-total-invoice')
    @include('livewire.admin.reports.modals.detail-outstanding')
    @include('livewire.admin.reports.modals.detail-subscription-aktif')
    @include('livewire.admin.reports.modals.detail-akan-berakhir')
    @include('livewire.admin.reports.modals.detail-user-aktif')
    @include('livewire.admin.reports.modals.detail-user-baru')
    @include('livewire.admin.reports.modals.detail-gagal-perpanjang')
</div>
