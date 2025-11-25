{{-- Detail Gagal Perpanjang Modal --}}
<input type="checkbox" wire:model="showDetailGagalPerpanjangModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-error/15 text-error rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    Detail Gagal Perpanjang
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap subscription yang gagal diperpanjang untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailGagalPerpanjangModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-error/10 rounded-lg border border-error/20">
                <div class="stat-title text-error">Gagal Perpanjang</div>
                <div class="stat-value text-error text-2xl">
                    {{ $subscriptionData['failed'] ?? 0 }}
                </div>
                <div class="stat-desc text-error">Total failures</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">Revenue Lost</div>
                <div class="stat-value text-warning text-xl">
                    Rp {{ number_format($subscriptionData['revenue_lost'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-warning">Pendapatan hilang</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Churn Rate</div>
                <div class="stat-value text-info text-2xl">
                    @php
                        $totalSubscriptions = ($subscriptionData['active'] ?? 0) + ($subscriptionData['failed'] ?? 0);
                        $churnRate = $totalSubscriptions > 0 ? (($subscriptionData['failed'] ?? 0) / $totalSubscriptions) * 100 : 0;
                    @endphp
                    {{ number_format($churnRate, 1) }}%
                </div>
                <div class="stat-desc text-info">Tingkat churn</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Recoverable</div>
                <div class="stat-value text-primary text-2xl">
                    {{ $subscriptionData['recoverable'] ?? 0 }}
                </div>
                <div class="stat-desc text-primary">Dapat dipulihkan</div>
            </div>
        </div>

        {{-- Failure Reasons Chart --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Alasan Gagal Perpanjang</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-error">{{ $subscriptionData['payment_failed'] ?? 0 }}</div>
                        <div class="text-sm text-error/80">Payment Failed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-warning">{{ $subscriptionData['card_expired'] ?? 0 }}</div>
                        <div class="text-sm text-warning/80">Card Expired</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-info">{{ $subscriptionData['insufficient_funds'] ?? 0 }}</div>
                        <div class="text-sm text-info/80">Insufficient Funds</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-neutral">{{ $subscriptionData['other_reasons'] ?? 0 }}</div>
                        <div class="text-sm text-neutral/80">Other Reasons</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Failed Renewals Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Gagal Perpanjang</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('gagal-perpanjang-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('gagal-perpanjang-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">Failed Date</th>
                                <th class="font-semibold text-center">Failure Reason</th>
                                <th class="font-semibold text-center">Retry Attempts</th>
                                <th class="font-semibold text-right">Lost Revenue</th>
                                <th class="font-semibold text-center">Recovery Status</th>
                                <th class="font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($subscriptionData && isset($subscriptionData['failed_renewals']))
                                @forelse($subscriptionData['failed_renewals'] as $index => $failure)
                                    @php
                                        $failureReasonClass = match($failure->failure_reason ?? 'other') {
                                            'payment_failed' => 'badge-error',
                                            'card_expired' => 'badge-warning',
                                            'insufficient_funds' => 'badge-info',
                                            default => 'badge-neutral'
                                        };
                                        $recoveryClass = ($failure->is_recoverable ?? false) ? 'badge-success' : 'badge-error';
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-8 h-8 rounded-full ring-1 ring-offset-1">
                                                        @if($failure->user && $failure->user->foto_profile)
                                                            <img src="{{ asset('storage/' . $failure->user->foto_profile) }}" 
                                                                 alt="{{ $failure->user->full_name }}" 
                                                                 class="w-8 h-8 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-error text-error-content flex items-center justify-center text-xs font-bold w-8 h-8 rounded-full">
                                                                {{ $failure->user ? strtoupper(substr($failure->user->full_name, 0, 2)) : 'N/A' }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $failure->user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $failure->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $failure->product->name_product ?? 'N/A' }}</div>
                                            <div class="text-xs text-base-content/60">{{ $failure->product->product_code ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm">{{ \Carbon\Carbon::parse($failure->failed_at)->format('d M Y') }}</div>
                                            <div class="text-xs text-base-content/60">{{ \Carbon\Carbon::parse($failure->failed_at)->format('H:i') }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ $failureReasonClass }} badge-soft badge-sm">
                                                {{ ucfirst(str_replace('_', ' ', $failure->failure_reason ?? 'Other')) }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-neutral badge-soft badge-sm">
                                                {{ $failure->retry_attempts ?? 0 }}/3
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-error">
                                                Rp {{ number_format($failure->lost_revenue ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ $recoveryClass }} badge-soft badge-sm">
                                                {{ ($failure->is_recoverable ?? false) ? 'Recoverable' : 'Lost' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="btn btn-ghost btn-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </div>
                                                <ul tabindex="0" class="dropdown-content menu rounded-box z-[1] w-36 shadow-xl bg-base-100 border border-base-300">
                                                    <li><a class="text-xs text-primary hover:bg-primary/10">Retry Payment</a></li>
                                                    <li><a class="text-xs text-info hover:bg-info/10">Contact Customer</a></li>
                                                    <li><a class="text-xs text-warning hover:bg-warning/10">Send Recovery Email</a></li>
                                                    <li><a class="text-xs text-error hover:bg-error/10">Mark as Churned</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada gagal perpanjang untuk periode ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="9" class="text-center py-8">
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
    <div class="modal-backdrop" @click="$wire.set('showDetailGagalPerpanjangModal', false)"></div>
</div>