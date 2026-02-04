<div>
    {{-- breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-">Manajemen Pembayaran</h1>
            <p class="text-base-content/60">Kelola metode pembayaran dan gateway</p>
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
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Pembayaran
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if ($toastMessage)
        <div class="toast toast-top toast-end z-9999" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition>
            @if ($toastType === 'success')
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @else
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @endif
        </div>
    @endif

    {{-- Modern Table Card --}}
    <div class="card bg-base-100 border border-base-300">
        <div class="card-body">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="card-title text-2xl">Daftar Metode Pembayaran</h2>
                    <p class="text-slate-600">Kelola gateway dan metode pembayaran</p>
                </div>
                <div class="badge badge-neutral badge-soft">{{ $payments->total() }} Total</div>
            </div>

            {{-- Clean Filters & Actions Bar --}}
            <div class="card p-5 bg-base-100 border border-base-300">
                {{-- Main Controls Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
                    {{-- Search Field --}}
                    <div class="col-span-1 lg:col-span-5">
                        <label class="input w-full">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" class="grow" wire:model.live.debounce.300ms="search"
                                placeholder="Cari metode pembayaran..." />
                        </label>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="statusFilter" class="select w-full">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>

                    {{-- Method Filter --}}
                    <div class="col-span-1 lg:col-span-3">
                        <select wire:model.live="methodFilter" class="select w-full">
                            <option value="">Semua Metode</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Virtual Account">Virtual Account</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Crypto">Cryptocurrency</option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-span-1 lg:col-span-2 flex gap-2">
                        <div class="grid grid-cols-2 gap-2 w-full">
                            <button wire:click="openCreateModal" class="btn btn-primary w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <!--<div class="dropdown dropdown-end">
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
                                    <li><a class="rounded-lg px-3 py-2 hover:text-warning hover:bg-warning/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Refresh Data
                                        </a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if ($search || $statusFilter || $methodFilter)
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
                                    {{ $statusFilter == 'active' ? 'Aktif' : 'Tidak Aktif' }}
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
                            @if ($methodFilter)
                                <div
                                    class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    {{ $methodFilter }}
                                    <button wire:click="$set('methodFilter', '')"
                                        class="hover:bg-green-200 rounded-full p-0.5 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <button wire:click="resetFilters"
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
                            <th class="font-semibold">#</th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('payment_method')">
                                <div class="flex items-center gap-2">
                                    <span>Metode Pembayaran</span>
                                    @if($sortField === 'payment_method')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('payment_bank')">
                                <div class="flex items-center gap-2">
                                    <span>Bank</span>
                                    @if($sortField === 'payment_bank')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('payment_account_name')">
                                <div class="flex items-center gap-2">
                                    <span>Informasi Akun</span>
                                    @if($sortField === 'payment_account_name')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('transactions_count')">
                                <div class="flex items-center gap-2">
                                    <span>Transaksi</span>
                                    @if($sortField === 'transactions_count')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('status')">
                                <div class="flex items-center gap-2">
                                    <span>Status</span>
                                    @if($sortField === 'status')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold cursor-pointer hover:bg-base-300 transition-colors" 
                                wire:click="sortBy('created_at')">
                                <div class="flex items-center gap-2">
                                    <span>Dibuat</span>
                                    @if($sortField === 'created_at')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $index => $payment)
                            <tr class="hover transition-colors hover:bg-base-200">
                                {{-- Number --}}
                                <td class="font-mono text-sm">
                                    {{ ($payments->currentPage() - 1) * $payments->perPage() + $index + 1 }}
                                </td>

                                {{-- Payment Method Info --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="font-semibold truncate max-w-[200px] text-lg">
                                            {{ $payment->payment_method }}
                                        </div>
                                        <div class="text-xs text-neutral">{{ $payment->payment_code }}</div>
                                    </div>
                                </td>

                                {{-- Bank --}}
                                <td>
                                    <div class="flex items-center gap-1 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="font-medium text-slate-600">{{ $payment->payment_bank }}</span>
                                    </div>
                                </td>

                                {{-- Account Information --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="text-sm font-medium">{{ $payment->payment_account_name }}</div>
                                        <div class="text-xs text-slate-500 font-mono">{{ $payment->payment_account_number }}</div>
                                    </div>
                                </td>

                                {{-- Transaction Info --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                            <span class="font-semibold">{{ $payment->transactions_count ?? 0 }}</span>
                                            <span class="text-xs">transaksi</span>
                                        </div>
                                        @if(isset($payment->last_transaction_date) && $payment->last_transaction_date)
                                            <div class="text-xs text-slate-400">
                                                Terakhir: {{ \Carbon\Carbon::parse($payment->last_transaction_date)->format('d M Y') }}
                                            </div>
                                        @else
                                            <div class="text-xs text-slate-400">Belum ada transaksi</div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($payment->status === 'active')
                                        <div class="badge badge-soft badge-success">
                                            <div class="status status-success mr-1"></div>
                                            Aktif
                                        </div>
                                    @else
                                        <div class="badge badge-soft badge-error">
                                            <div class="status status-error mr-1"></div>
                                            Tidak Aktif
                                        </div>
                                    @endif
                                </td>

                                {{-- Created At --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="text-sm font-medium">
                                            {{ $payment->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-slate-400">
                                            {{ $payment->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Actions Dropdown --}}
                                <td>
                                    <div class="flex justify-center">
                                        @php
                                            $totalPayments = $payments->count();
                                            $currentIndex = $loop->index;
                                            $isLastRows = $totalPayments - $currentIndex <= 3;
                                        @endphp
                                        <div class="dropdown dropdown-end {{ $isLastRows ? 'dropdown-top' : '' }}">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle hover:bg-base-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </div>
                                            <ul tabindex="0"
                                                class="dropdown-content menu rounded-box z-50 w-52 p-2 shadow-2xl bg-base-100 border border-base-300 {{ $isLastRows ? 'mb-2' : 'mt-2' }}">
                                                <li>
                                                    <button wire:click="openDetailModal({{ $payment->id }})"
                                                        class="text-primary hover:bg-primary/10 rounded-lg transition-colors flex items-center gap-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        <span class="font-medium">Lihat Detail</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button wire:click="openEditModal({{ $payment->id }})"
                                                        class="text-warning hover:bg-warning/10 rounded-lg transition-colors flex items-center gap-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        <span class="font-medium">Edit Metode</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button wire:click="openDeleteModal({{ $payment->id }})"
                                                        class="text-error hover:bg-error/10 rounded-lg transition-colors flex items-center gap-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span class="font-medium">Hapus Metode</span>
                                                    </button>
                                                </li>
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
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <div>
                                            <p class="font-semibold">Tidak ada metode pembayaran ditemukan</p>
                                            <p class="text-sm">Coba ubah filter atau tambahkan metode pembayaran baru</p>
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
                <x-pagination.custom :paginator="$payments" :showingText="true"
                    showingFormat="Menampilkan {from} - {to} dari {total} metode pembayaran" size="default" />
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.payments.modals.create')
    @include('livewire.admin.payments.modals.edit')
    @include('livewire.admin.payments.modals.detail')
    @include('livewire.admin.payments.modals.delete')
</div>
