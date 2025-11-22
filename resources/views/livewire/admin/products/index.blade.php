<div>
    {{-- breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-">Manajemen Produk</h1>
            <p class="text-base-content/60">Kelola dan pantau produk hosting</p>
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
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                </path>
                            </svg>
                            Produk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if ($toastMessage)
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
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
                    <h2 class="card-title text-2xl">Daftar Produk</h2>
                    <p class="text-slate-600">Kelola paket hosting dan layanan</p>
                </div>
                <div class="badge badge-neutral badge-soft">{{ $products->total() }} Total</div>
            </div>

            {{-- Clean Filters & Actions Bar --}}
            <div class="card p-5 bg-base-100 border border-base-300">
                {{-- Main Controls Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
                    {{-- Search Field --}}
                    <div class="col-span-1 lg:col-span-6">
                        <label class="input w-full">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" class="grow" wire:model.live.debounce.300ms="search"
                                placeholder="Cari produk..." />
                        </label>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="statusFilter" class="select w-full">
                            <option value="">Semua Status</option>
                            <option value="1">Aktif (Public)</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>

                    {{-- Price Range Filter --}}
                    <div class="col-span-1 lg:col-span-2">
                        <select wire:model.live="priceRange" class="select w-full">
                            <option value="">Semua Harga</option>
                            <option value="0-50000">< Rp 50.000</option>
                            <option value="50000-100000">Rp 50.000 - 100.000</option>
                            <option value="100000-200000">Rp 100.000 - 200.000</option>
                            <option value="200000-up">> Rp 200.000</option>
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
                                    <li><a class="rounded-lg px-3 py-2 hover:text-warning hover:bg-warning/10 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Refresh Data
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if ($search || $statusFilter || $priceRange)
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
                                    {{ $statusFilter == '1' ? 'Aktif' : 'Draft' }}
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
                            @if ($priceRange)
                                <div
                                    class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @switch($priceRange)
                                        @case('0-50000')
                                            < Rp 50.000
                                            @break
                                        @case('50000-100000')
                                            Rp 50.000 - 100.000
                                            @break
                                        @case('100000-200000')
                                            Rp 100.000 - 200.000
                                            @break
                                        @case('200000-up')
                                            > Rp 200.000
                                            @break
                                    @endswitch
                                    <button wire:click="$set('priceRange', '')"
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
                <table class="table table-hover w-full overflow-auto">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-semibold">#</th>
                            <th class="font-semibold">Produk</th>
                            <th class="font-semibold">Fitur</th>
                            <th class="font-semibold">Harga</th>
                            <th class="font-semibold">Penjualan</th>
                            <th class="font-semibold">Status</th>
                            <th class="font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr class="hover transition-colors hover:bg-base-200">
                                {{-- Number --}}
                                <td class="font-mono text-sm">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                                </td>

                                {{-- Product Info --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="font-semibold truncate max-w-[200px] text-xl">
                                            {{ $product->name_product }}
                                        </div>
                                        <div class="text-xs text-neutral">{{ $product->product_code }}</div>
                                        <div class="text-xs text-base-content/60 line-clamp-2 max-w-[200px]">
                                            {{ Str::limit($product->description, 50) }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Features --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-1 text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                            </svg>
                                            <span class="font-medium">{{ $product->storage }}</span>
                                        </div>
                                        <div class="flex flex-wrap gap-1">
                                            @if($product->domain_included)
                                                <span class="badge badge-soft badge-success badge-xs">Domain</span>
                                            @endif
                                            @if($product->ssl_included)
                                                <span class="badge badge-soft badge-success badge-xs">SSL</span>
                                            @endif
                                            @if($product->ssh_access)
                                                <span class="badge badge-soft badge-info badge-xs">SSH</span>
                                            @endif
                                            @if($product->email_feature)
                                                <span class="badge badge-soft badge-warning badge-xs">Email</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="font-bold text-lg text-primary">
                                            Rp {{ number_format($product->price_monthly, 0, ',', '.') }}
                                        </div>
                                        <div class="text-xs text-base-content/60">/bulan</div>
                                    </div>
                                </td>

                                {{-- Sales Info --}}
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                            <span class="font-semibold">{{ $product->transactions_count ?? 0 }}</span>
                                            <span class="text-xs">terjual</span>
                                        </div>
                                        @if(isset($product->last_sale_date) && $product->last_sale_date)
                                            <div class="text-xs text-slate-400">
                                                Terakhir: {{ \Carbon\Carbon::parse($product->last_sale_date)->format('d M Y') }}
                                            </div>
                                        @else
                                            <div class="text-xs text-slate-400">Belum ada penjualan</div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($product->status)
                                        <div class="badge badge-soft badge-success">
                                            <div class="status status-success mr-1"></div>
                                            Aktif
                                        </div>
                                    @else
                                        <div class="badge badge-soft badge-warning">
                                            <div class="status status-warning mr-1"></div>
                                            Draft
                                        </div>
                                    @endif
                                </td>

                                {{-- Actions Dropdown --}}
                                <td>
                                    <div class="flex justify-center">
                                        @php
                                            $totalProducts = $products->count();
                                            $currentIndex = $loop->index;
                                            $isLastRows = $totalProducts - $currentIndex <= 3;
                                        @endphp
                                        <div class="dropdown dropdown-end {{ $isLastRows ? 'dropdown-top' : '' }}">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </div>
                                            <ul tabindex="0"
                                                class="dropdown-content menu rounded-box z-50 w-52 p-2 shadow-xl bg-base-100 border border-base-300 {{ $isLastRows ? 'mb-2' : 'mt-2' }}">
                                                <li>
                                                    <button wire:click="openDetailModal({{ $product->id }})"
                                                        class="text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Lihat Detail
                                                    </button>
                                                </li>
                                                <li>
                                                    <button wire:click="openEditModal({{ $product->id }})"
                                                        class="text-warning hover:bg-warning/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit Produk
                                                    </button>
                                                </li>
                                                <li>
                                                    <button wire:click="openDeleteModal({{ $product->id }})"
                                                        class="text-error hover:bg-error/10 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus Produk
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <div>
                                            <p class="font-semibold">Tidak ada produk ditemukan</p>
                                            <p class="text-sm">Coba ubah filter atau tambahkan produk baru</p>
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
                <x-pagination.custom :paginator="$products" :showingText="true"
                    showingFormat="Menampilkan {from} - {to} dari {total} produk" size="default" />
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('livewire.admin.products.modals.create')
    @include('livewire.admin.products.modals.edit')
    @include('livewire.admin.products.modals.detail')
    @include('livewire.admin.products.modals.delete')
</div>
