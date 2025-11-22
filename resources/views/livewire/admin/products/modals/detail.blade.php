{{-- Detail Product Modal --}}
<input type="checkbox" wire:model="showDetailModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        @if ($detailProduct)
            {{-- Modal Header --}}
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
                <div>
                    <h3 class="text-xl font-bold">Detail Produk</h3>
                    <p class="text-sm text-neutral mt-1">Informasi lengkap produk hosting</p>
                </div>
                <button @click="$wire.set('showDetailModal', false)" class="btn btn-sm btn-circle btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Product Info Card --}}
                <div class="col-span-2">
                    <div class="card bg-gradient-to-r from-primary/10 to-primary/5 border border-primary/20">
                        <div class="card-body">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-2xl font-bold text-primary mb-1">{{ $detailProduct->name_product }}
                                    </h4>
                                    <p class="text-sm text-neutral mb-3">{{ $detailProduct->product_code }}</p>

                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                            </svg>
                                            <span class="font-medium">{{ $detailProduct->storage }}</span>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-bold text-lg">Rp
                                                {{ number_format($detailProduct->price_monthly, 0, ',', '.') }}/bulan</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($detailProduct->status)
                                    <div class="badge badge-success badge-soft">
                                        <div class="status status-success animate-bounce"></div> Aktif (Public)
                                    </div>
                                    @else
                                    <div class="badge badge-warning badge-soft">
                                        <div class="status status-warning animate-bounce"></div> Draft
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Features Section --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Fitur yang Tersedia
                    </h4>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <div
                            class="flex items-center gap-3 p-3 {{ $detailProduct->domain_included ? 'bg-success/10 border border-success/20 rounded-lg' : 'bg-base-200 rounded-lg opacity-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 {{ $detailProduct->domain_included ? 'text-success' : 'text-base-content/50' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9a9 9 0 01-9-9m9 9c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10 10 4.477 10 10z" />
                            </svg>
                            <span class="font-medium">Domain Gratis</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 {{ $detailProduct->ssl_included ? 'bg-success/10 border border-success/20 rounded-lg' : 'bg-base-200 rounded-lg opacity-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 {{ $detailProduct->ssl_included ? 'text-success' : 'text-base-content/50' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="font-medium">SSL Certificate</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 {{ $detailProduct->ssh_access ? 'bg-success/10 border border-success/20 rounded-lg' : 'bg-base-200 rounded-lg opacity-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 {{ $detailProduct->ssh_access ? 'text-success' : 'text-base-content/50' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">SSH Access</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 {{ $detailProduct->email_feature ? 'bg-success/10 border border-success/20 rounded-lg' : 'bg-base-200 rounded-lg opacity-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 {{ $detailProduct->email_feature ? 'text-success' : 'text-base-content/50' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">Email Hosting</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 {{ $detailProduct->database_feature ? 'bg-success/10 border border-success/20 rounded-lg' : 'bg-base-200 rounded-lg opacity-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 {{ $detailProduct->database_feature ? 'text-success' : 'text-base-content/50' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                            <span class="font-medium">Database MySQL</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if ($detailProduct->description)
                    <div class="col-span-2">
                        <h4 class="text-lg font-semibold mb-4">Deskripsi</h4>
                        <div class="bg-base-200 rounded-lg p-4">
                            <p class="text-base-content/80">{{ $detailProduct->description }}</p>
                        </div>
                    </div>
                @endif

                {{-- Sales Statistics --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Statistik Penjualan
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                            <div class="stat-title">Total Terjual</div>
                            <div class="stat-value text-primary text-2xl">
                                {{ $detailProduct->transactions_count ?? 0 }}</div>
                            <div class="stat-desc">Transaksi berhasil</div>
                        </div>

                        <div class="stat bg-success/10 rounded-lg border border-success/20">
                            <div class="stat-title">Total Pendapatan</div>
                            <div class="stat-value text-success text-lg">Rp
                                {{ number_format(($detailProduct->transactions_count ?? 0) * $detailProduct->price_monthly, 0, ',', '.') }}
                            </div>
                            <div class="stat-desc">Estimasi pendapatan</div>
                        </div>

                        <div class="stat bg-info/10 rounded-lg border border-info/20">
                            <div class="stat-title">Dibuat</div>
                            <div class="stat-value text-info text-lg">
                                {{ $detailProduct->created_at->format('d M Y') }}</div>
                            <div class="stat-desc">{{ $detailProduct->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

                {{-- Recent Transactions --}}
                @if ($detailProduct->transactions && count($detailProduct->transactions) > 0)
                    <div class="col-span-2">
                        <h4 class="text-lg font-semibold mb-4">Transaksi Terbaru</h4>
                        <div class="overflow-x-auto">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailProduct->transactions->take(5) as $transaction)
                                        <tr class="hover">
                                            <td>{{ $transaction->user->full_name ?? 'N/A' }}</td>
                                            <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-sm
                                                    @if ($transaction->status === 'active') badge-success
                                                    @elseif($transaction->status === 'pending') badge-warning
                                                    @else badge-error @endif">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td class="font-mono">Rp
                                                {{ number_format($transaction->total_payment, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showDetailModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Tutup
                </button>
                <button wire:click="openEditModal({{ $detailProduct->id }})" class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Produk
                </button>
            </div>
        @endif
    </div>
    <label class="modal-backdrop" @click="$wire.set('showDetailModal', false)">Close</label>
</div>
