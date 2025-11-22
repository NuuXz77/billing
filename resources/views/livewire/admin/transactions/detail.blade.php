<div class="min-h-screen bg-base-200">
    {{-- Toast Notification --}}
    @if ($toastMessage)
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
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
            @elseif ($toastType === 'error')
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @else
                <div class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @endif
        </div>
    @endif

    {{-- Breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-2xl">Detail Transaksi</h1>
            <p class="text-base-content/60">Detail lengkap transaksi {{ $transaction->transaction_code }}</p>
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
                        <a href="{{ route('admin.transactions.index') }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-4 w-4 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Transaksi
                        </a>
                    </li>
                    <li>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-4 w-4 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-8 bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.transactions.index') }}" wire:navigate class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-base-content">Detail Transaksi</h1>
                <p class="text-base-content/70 mt-1">{{ $transaction->transaction_code }}</p>
            </div>
        </div>
        <div class="text-right">
            @php
                $statusConfig = [
                    'pending_payment' => ['class' => 'badge-warning', 'text' => 'Pending Pembayaran'],
                    'pending_confirm' => ['class' => 'badge-info', 'text' => 'Pending Konfirmasi'],
                    'active' => ['class' => 'badge-success', 'text' => 'Aktif'],
                    'expired' => ['class' => 'badge-error', 'text' => 'Kedaluwarsa'],
                    'canceled' => ['class' => 'badge-neutral', 'text' => 'Dibatalkan'],
                    'rejected' => ['class' => 'badge-error', 'text' => 'Ditolak'],
                    'refunded' => ['class' => 'badge-accent', 'text' => 'Dikembalikan']
                ];
                $status = $statusConfig[$transaction->status] ?? ['class' => 'badge-ghost', 'text' => ucfirst($transaction->status)];
            @endphp
            <div class="badge badge-soft {{ $status['class'] }} badge-lg">{{ $status['text'] }}</div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column - 2/3 Width --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Transaction Info Card --}}
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-primary/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">Informasi Transaksi</h2>
                        <p class="text-base-content/70">Detail lengkap transaksi</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Kode Transaksi</label>
                        <p class="text-lg font-mono font-bold">{{ $transaction->transaction_code }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Total Pembayaran</label>
                        <p class="text-2xl font-bold text-primary">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Siklus Tagihan</label>
                        <p class="text-lg font-semibold capitalize">{{ $transaction->billing_cycle }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Tanggal Transaksi</label>
                        <p class="text-lg font-semibold">{{ $transaction->created_at->format('d F Y H:i') }}</p>
                    </div>
                    @if($transaction->start_date)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Tanggal Mulai</label>
                        <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($transaction->start_date)->format('d F Y') }}</p>
                    </div>
                    @endif
                    @if($transaction->end_date)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Tanggal Berakhir</label>
                        <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($transaction->end_date)->format('d F Y') }}</p>
                    </div>
                    @endif
                    {{-- @if($transaction->subdomain_web)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Subdomain Web</label>
                        <p class="text-lg font-semibold text-info">{{ $transaction->subdomain_web }}</p>
                    </div>
                    @endif
                    @if($transaction->subdomain_server)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Subdomain Server</label>
                        <p class="text-lg font-semibold text-info">{{ $transaction->subdomain_server }}</p>
                    </div>
                    @endif --}}
                </div>
                @if($transaction->admin_notes)
                <div class="mt-6 p-4 bg-base-200 rounded-lg">
                    <label class="text-sm font-medium text-base-content/70">Catatan Admin</label>
                    <p class="text-base mt-2">{{ $transaction->admin_notes }}</p>
                </div>
                @endif
            </div>

            {{-- Customer Info Card --}}
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-info/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">Informasi Pelanggan</h2>
                        <p class="text-base-content/70">Data lengkap pelanggan yang melakukan transaksi</p>
                    </div>
                </div>

                {{-- Avatar dan Info Utama --}}
                <div class="flex flex-col lg:flex-row lg:items-start space-y-4 lg:space-y-0 lg:space-x-6 mb-6">
                    @if($transaction->user->foto_profile)
                        {{-- Jika ada foto profil --}}
                        <div class="avatar">
                            <div class="w-20 h-20 rounded-full ring ring-base-300 ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('storage/profile-photos/' . $transaction->user->foto_profile) }}" 
                                     alt="{{ $transaction->user->full_name }}" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                        </div>
                    @else
                        {{-- Jika tidak ada foto profil, tampilkan inisial --}}
                        <div class="avatar placeholder">
                            <div class="bg-neutral text-neutral-content w-20 h-20 rounded-full ring ring-base-300 ring-offset-base-100 ring-offset-2 flex items-center justify-center">
                                @php
                                    $nameParts = explode(' ', $transaction->user->full_name);
                                    if (count($nameParts) >= 2) {
                                        // Jika nama lengkap (ada spasi), ambil huruf pertama dari 2 kata pertama
                                        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                                    } else {
                                        // Jika hanya satu kata, ambil huruf pertama saja
                                        $initials = strtoupper(substr($transaction->user->full_name, 0, 1));
                                    }
                                @endphp
                                <span class="text-2xl font-bold">{{ $initials }}</span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-2xl font-bold text-base-content">{{ $transaction->user->full_name }}</h3>
                            <div class="badge badge-soft badge-{{ $transaction->user->status === 'active' ? 'success' : ($transaction->user->status === 'inactive' ? 'warning' : 'error') }} badge-sm">
                                {{ ucfirst($transaction->user->status) }}
                            </div>
                        </div>
                        <div class="space-y-1 text-base-content/70">
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                {{ $transaction->user->email }}
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $transaction->user->username }}
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5m-4 0V4a2 2 0 118 0v2m-4 4l2 2m0 0l2-2m-2 2V8" />
                                </svg>
                                <span class="font-mono text-sm">{{ $transaction->user->user_code }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Detail Informasi Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- Kontak --}}
                    @if($transaction->user->phone)
                    <div>
                        <label class="text-sm font-medium text-base-content/70 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            No. Telepon
                        </label>
                        <p class="text-base font-semibold">{{ $transaction->user->phone }}</p>
                    </div>
                    @endif

                    {{-- Role --}}
                    <div>
                        <label class="text-sm font-medium text-base-content/70 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Role
                        </label>
                        <p class="text-base font-semibold capitalize">{{ $transaction->user->role }}</p>
                    </div>

                    {{-- Perusahaan --}}
                    @if($transaction->user->company_name)
                    <div>
                        <label class="text-sm font-medium text-base-content/70 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Perusahaan
                        </label>
                        <p class="text-base font-semibold">{{ $transaction->user->company_name }}</p>
                    </div>
                    @endif

                    {{-- Last Active --}}
                    @if($transaction->user->last_active)
                    <div>
                        <label class="text-sm font-medium text-base-content/70 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Terakhir Aktif
                        </label>
                        <p class="text-base font-semibold">{{ \Carbon\Carbon::parse($transaction->user->last_active)->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                </div>

                {{-- Alamat Lengkap --}}
                @if($transaction->user->address || $transaction->user->city || $transaction->user->province)
                <div class="mt-6 pt-6 border-t border-base-300">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h4 class="font-semibold text-base-content">Alamat Lengkap</h4>
                    </div>
                    
                    <div class="bg-base-200 rounded-lg p-4">
                        @if($transaction->user->address)
                        <p class="text-base font-medium mb-2">{{ $transaction->user->address }}</p>
                        @endif
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                            @if($transaction->user->district)
                            <div>
                                <span class="text-base-content/60">Kecamatan:</span>
                                <p class="font-semibold">{{ $transaction->user->district }}</p>
                            </div>
                            @endif
                            
                            @if($transaction->user->city)
                            <div>
                                <span class="text-base-content/60">Kota:</span>
                                <p class="font-semibold">{{ $transaction->user->city }}</p>
                            </div>
                            @endif
                            
                            @if($transaction->user->province)
                            <div>
                                <span class="text-base-content/60">Provinsi:</span>
                                <p class="font-semibold">{{ $transaction->user->province }}</p>
                            </div>
                            @endif
                            
                            @if($transaction->user->pos_code)
                            <div>
                                <span class="text-base-content/60">Kode Pos:</span>
                                <p class="font-semibold">{{ $transaction->user->pos_code }}</p>
                            </div>
                            @endif
                        </div>
                        
                        @if($transaction->user->country)
                        <div class="mt-3 pt-3 border-t border-base-300/50">
                            <span class="text-base-content/60 text-sm">Negara:</span>
                            <p class="font-semibold">{{ $transaction->user->country }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            {{-- Product Info Card --}}
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-success/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">Informasi Produk</h2>
                        <p class="text-base-content/70">Detail produk yang dibeli</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Nama Produk</label>
                        <p class="text-lg font-bold">{{ $transaction->product->name_product }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Kode Produk</label>
                        <p class="text-lg font-mono">{{ $transaction->product->product_code }}</p>
                    </div>
                    @if($transaction->product->description)
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-base-content/70">Deskripsi</label>
                        <p class="text-base">{{ $transaction->product->description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Subdomain Info Card --}}
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-secondary/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5.25-5.25-12-5.25-12 0s6.75 5.25 12 0" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">Informasi Subdomain</h2>
                        <p class="text-base-content/70">Detail subdomain dan server hosting</p>
                    </div>
                </div>
                @if($transaction->subdomain_web || $transaction->subdomain_server)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($transaction->subdomain_web)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Subdomain Web</label>
                        <p class="text-lg font-bold text-secondary">{{ $transaction->subdomain_web }}</p>
                        <div class="mt-2">
                            <a href="https://{{ $transaction->subdomain_web }}" target="_blank" 
                                class="inline-flex items-center gap-2 text-sm text-primary hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Buka Website
                            </a>
                        </div>
                    </div>
                    @endif
                    @if($transaction->subdomain_server)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Subdomain Server</label>
                        <p class="text-lg font-bold text-secondary">{{ $transaction->subdomain_server }}</p>
                        <div class="text-sm text-base-content/60 mt-1">
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                </svg>
                                Server Hosting
                            </span>
                        </div>
                    </div>
                    @endif
                    @if($transaction->confirmed_at)
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-base-content/70">Tanggal Konfirmasi</label>
                        <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($transaction->confirmed_at)->format('d F Y H:i') }}</p>
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center py-8">
                    <div class="flex flex-col items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5.25-5.25-12-5.25-12 0s6.75 5.25 12 0" />
                        </svg>
                        <div>
                            <p class="font-semibold text-base-content/60">Subdomain belum dikonfigurasi</p>
                            <p class="text-sm text-base-content/40">Silakan konfigurasikan subdomain untuk melanjutkan</p>
                        </div>
                        @if($transaction->status === 'pending_confirm')
                        <button wire:click="openConfirmSubdomainModal({{ $transaction->id }})" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Konfigurasikan Subdomain
                        </button>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Right Column - 1/3 Width --}}
        <div class="space-y-6">
            {{-- Payment Info Card --}}
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-accent/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-base-content">Metode Pembayaran</h2>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Metode</label>
                        <p class="text-lg font-bold">{{ $transaction->payment->payment_method }} | {{ $transaction->payment->payment_bank }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-base-content/70">No. Rekening/E-Wallet</label>
                        <p class="text-lg font-mono">{{ $transaction->payment->payment_account_number }}</p>
                    </div>
                    @if($transaction->payment->payment_account_name)
                    <div>
                        <label class="text-sm font-medium text-base-content/70">Atas Nama</label>
                        <p class="text-lg">{{ $transaction->payment->payment_account_name }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Payment Proof Card --}}
            @if($transaction->payment_proof)
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-warning/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-base-content">Bukti Pembayaran</h2>
                    </div>
                </div>
                <div class="text-center">
                    <button onclick="payment_proof_modal.showModal()" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Bukti Pembayaran
                    </button>
                </div>
            </div>

            {{-- Payment Proof Modal --}}
            <dialog id="payment_proof_modal" class="modal">
                <div class="modal-box max-w-4xl">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold mb-4">Bukti Pembayaran - {{ $transaction->transaction_code }}</h3>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                            alt="Bukti Pembayaran" class="max-w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
            @endif

            {{-- Quick Actions Card --}}
            @if($transaction->status === 'pending_confirm')
            <div class="bg-base-100 rounded-lg p-6 shadow-sm border border-base-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-primary/10 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-base-content">Aksi Cepat</h2>
                    </div>
                </div>
                <div class="space-y-3">
                    @if(!$transaction->subdomain_web || !$transaction->subdomain_server)
                        {{-- Jika subdomain belum diisi, tampilkan tombol konfigurasikan --}}
                        <button wire:click="openConfirmSubdomainModal({{ $transaction->id }})" class="btn btn-primary btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Konfigurasikan Subdomain
                        </button>
                    @else
                        {{-- Jika subdomain sudah diisi, tampilkan tombol konfirmasi final --}}
                        <button wire:click="openConfirmAdminModal({{ $transaction->id }})" class="btn btn-success btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Final & Aktifkan
                        </button>
                    @endif
                    
                    {{-- Tombol tolak selalu tersedia --}}
                    <button wire:click="openRejectModal({{ $transaction->id }})" class="btn btn-error btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tolak Transaksi
                    </button>
                    
                    {{-- Tombol test email untuk debugging --}}
                    <div class="divider divider-sm text-xs">DEBUGGING</div>
                    <button wire:click="testEmail" class="btn btn-outline btn-warning btn-sm btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        🧪 Test Email ke {{ $transaction->user->email }}
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.transactions.modals.confirm-subdomain')
    @include('livewire.admin.transactions.modals.confirm-admin')
    @include('livewire.admin.transactions.modals.reject')
</div>
