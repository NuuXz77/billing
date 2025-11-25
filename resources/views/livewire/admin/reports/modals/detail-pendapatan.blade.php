{{-- Detail Pendapatan Modal --}}
<input type="checkbox" wire:model="showDetailPendapatanModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-success/15 text-success rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    Detail Pendapatan Range
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap pendapatan untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailPendapatanModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Total Pendapatan Range</div>
                <div class="stat-value text-success text-2xl">
                    Rp {{ number_format($revenueData['monthly'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-success">Periode yang dipilih</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Pendapatan Harian</div>
                <div class="stat-value text-primary text-2xl">
                    Rp {{ number_format($revenueData['daily'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-primary">Hari ini</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Rata-rata Harian</div>
                <div class="stat-value text-info text-2xl">
                    @php
                        $daysDiff = $fromDate && $toDate ? 
                            \Carbon\Carbon::parse($fromDate)->diffInDays(\Carbon\Carbon::parse($toDate)) + 1 : 1;
                        $avgDaily = $daysDiff > 0 ? ($revenueData['monthly'] ?? 0) / $daysDiff : 0;
                    @endphp
                    Rp {{ number_format($avgDaily, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-info">Per hari</div>
            </div>
        </div>

        {{-- Revenue Detail Table --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Detail Transaksi Pendapatan</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('revenue-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('revenue-detail')" class="btn btn-outline btn-success btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-hover w-full">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="font-semibold">#</th>
                                <th class="font-semibold">Tanggal</th>
                                <th class="font-semibold">User</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold">Metode Pembayaran</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($revenueData && isset($revenueData['transactions']))
                                @forelse($revenueData['transactions'] as $index => $transaction)
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="text-sm font-medium">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-base-content/60">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3 py-2">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-10 h-10 rounded-full ring-1 ring-offset-1">
                                                        @if($transaction->user && $transaction->user->foto_profile)
                                                            <img src="{{ asset('storage/' . $transaction->user->foto_profile) }}" 
                                                                 alt="{{ $transaction->user->full_name }}" 
                                                                 class="w-10 h-10 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-10 h-10 rounded-full">
                                                                {{ $transaction->user ? strtoupper(substr($transaction->user->full_name, 0, 2)) : 'N/A' }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="font-bold text-sm truncate">{{ $transaction->user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60 truncate">{{ $transaction->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $transaction->product->name_product ?? 'N/A' }}</div>
                                            <div class="text-xs text-base-content/60">{{ $transaction->product->product_code ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                @if($transaction->payment && $transaction->payment->payment_method)
                                                    <div class="badge badge-soft badge-primary badge-sm">{{ $transaction->payment->payment_method }}</div>
                                                @else
                                                    <div class="badge badge-ghost badge-sm">N/A</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-soft
                                                @if(($transaction->status ?? $transaction->transaction_status ?? 'active') === 'active') badge-success
                                                @elseif(($transaction->status ?? $transaction->transaction_status ?? 'active') === 'pending') badge-warning
                                                @elseif(($transaction->status ?? $transaction->transaction_status ?? 'active') === 'cancelled') badge-error
                                                @else badge-ghost
                                                @endif badge-sm">
                                                {{ ucfirst($transaction->status ?? $transaction->transaction_status ?? 'active') }}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-success">
                                                Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-12">
                                            <div class="flex flex-col items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                </svg>
                                                <div>
                                                    <p class="font-semibold text-base-content/70">Tidak ada data transaksi</p>
                                                    <p class="text-sm text-base-content/50">untuk periode yang dipilih</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                            </svg>
                                            <div>
                                                <p class="font-semibold text-base-content/70">Data sedang dimuat</p>
                                                <p class="text-sm text-base-content/50">Silakan tunggu sebentar...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Revenue by Product Breakdown --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Pendapatan per Produk</h4>
                <div class="overflow-x-auto">
                    <table class="table table-hover w-full">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="font-semibold">#</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold text-center">Jumlah Transaksi</th>
                                <th class="font-semibold text-right">Total Pendapatan</th>
                                <th class="font-semibold text-right">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($revenueData && isset($revenueData['per_product']))
                                @forelse($revenueData['per_product'] as $index => $productRevenue)
                                    @php
                                        $percentage = ($revenueData['monthly'] > 0) ? 
                                            (($productRevenue->total_revenue / $revenueData['monthly']) * 100) : 0;
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $productRevenue->name_product }}</div>
                                            <div class="text-xs text-base-content/60">{{ $productRevenue->product_code }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-primary badge-soft badge-sm">
                                                {{ $productRevenue->transaction_count }}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-success">
                                                Rp {{ number_format($productRevenue->total_revenue, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex items-center gap-2 justify-end">
                                                <div class="badge badge-info badge-soft badge-sm">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                                <div class="w-16 bg-base-300 rounded-full h-2">
                                                    <div class="bg-info h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8">
                                            <p class="text-base-content/60">Tidak ada data produk untuk periode ini</p>
                                        </td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Actions --}}
        <div class="modal-action pt-6 border-t border-base-300">
            <button type="button" @click="$wire.set('showDetailPendapatanModal', false)" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Tutup
            </button>
            <button wire:click="exportPDF('revenue-comprehensive')" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Laporan Lengkap
            </button>
        </div>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showDetailPendapatanModal', false)">Close</label>
</div>
