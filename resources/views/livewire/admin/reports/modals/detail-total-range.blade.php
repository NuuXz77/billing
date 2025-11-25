{{-- Detail Total Range Modal --}}
<input type="checkbox" wire:model="showDetailTotalRangeModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-primary/15 text-primary rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    Detail Total Range
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
            <button @click="$wire.set('showDetailTotalRangeModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Total Pendapatan</div>
                <div class="stat-value text-primary text-2xl">
                    Rp {{ number_format($revenueData['total_annual'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-primary">Periode ini</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Total Transaksi</div>
                <div class="stat-value text-success text-2xl">
                    {{ $revenueData['successful_transactions'] ?? 0 }}
                </div>
                <div class="stat-desc text-success">Berhasil</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">Rata-rata Transaksi</div>
                <div class="stat-value text-warning text-xl">
                    @php
                        $totalTransactions = $revenueData['successful_transactions'] ?? 1;
                        $avgPerTransaction = $totalTransactions > 0 ? ($revenueData['total_annual'] ?? 0) / $totalTransactions : 0;
                    @endphp
                    Rp {{ number_format($avgPerTransaction, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-warning">Per transaksi</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Pertumbuhan</div>
                <div class="stat-value text-info text-2xl">
                    {{ rand(5, 25) }}%
                </div>
                <div class="stat-desc text-info">Vs bulan lalu</div>
            </div>
        </div>

        {{-- Revenue Chart --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Tren Pendapatan Harian</h4>
                <div class="grid grid-cols-7 gap-2 h-32">
                    @for($i = 1; $i <= 7; $i++)
                        @php $height = rand(20, 100); @endphp
                        <div class="flex flex-col items-center justify-end">
                            <div class="bg-primary rounded-t w-full transition-all duration-300 hover:bg-primary-focus" 
                                 style="height: {{ $height }}%"></div>
                            <span class="text-xs mt-2">{{ \Carbon\Carbon::now()->subDays(7-$i)->format('d/m') }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Transactions Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Transaksi</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('total-range-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('total-range-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">User</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-right">Total</th>
                                <th class="font-semibold text-center">Tanggal</th>
                                <th class="font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($revenueData && isset($revenueData['transactions']))
                                @forelse($revenueData['transactions'] as $index => $transaction)
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-8 h-8 rounded-full ring-1 ring-offset-1">
                                                        @if($transaction->user && $transaction->user->foto_profile)
                                                            <img src="{{ asset('storage/' . $transaction->user->foto_profile) }}" 
                                                                 alt="{{ $transaction->user->full_name }}" 
                                                                 class="w-8 h-8 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-8 h-8 rounded-full">
                                                                {{ $transaction->user ? strtoupper(substr($transaction->user->full_name, 0, 2)) : 'N/A' }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $transaction->user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $transaction->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $transaction->product->name_product ?? 'N/A' }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-soft
                                                @if(($transaction->status ?? $transaction->transaction_status ?? 'active') === 'active') badge-success
                                                @elseif(($transaction->status ?? $transaction->transaction_status ?? 'active') === 'pending') badge-warning
                                                @else badge-error
                                                @endif badge-sm">
                                                {{ ucfirst($transaction->status ?? $transaction->transaction_status ?? 'active') }}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-primary">
                                                Rp {{ number_format($transaction->total_payment ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-sm">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</div>
                                            <div class="text-xs text-base-content/60">{{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i') }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="btn btn-ghost btn-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </div>
                                                <ul tabindex="0" class="dropdown-content menu rounded-box z-[1] w-32 shadow-xl bg-base-100 border border-base-300">
                                                    <li><a class="text-xs text-info hover:bg-info/10">View Detail</a></li>
                                                    <li><a class="text-xs text-success hover:bg-success/10">Download Invoice</a></li>
                                                    <li><a class="text-xs text-warning hover:bg-warning/10">Send Email</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada transaksi untuk periode ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-8">
                                        <p class="text-slate-500">Data tidak tersedia</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop" @click="$wire.set('showDetailTotalRangeModal', false)"></div>
</div>
