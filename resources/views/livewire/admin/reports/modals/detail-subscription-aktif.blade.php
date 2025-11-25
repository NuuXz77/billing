{{-- Detail Subscription Aktif Modal --}}
<input type="checkbox" wire:model="showDetailSubscriptionAktifModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-info/15 text-info rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    Detail Subscription Aktif
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap subscription yang aktif untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailSubscriptionAktifModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Subscription Aktif</div>
                <div class="stat-value text-info text-2xl">
                    {{ $subscriptionData['active'] ?? 0 }}
                </div>
                <div class="stat-desc text-info">Total aktif</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Subscription Baru</div>
                <div class="stat-value text-success text-2xl">
                    {{ $subscriptionData['new'] ?? 0 }}
                </div>
                <div class="stat-desc text-success">Bulan ini</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">MRR</div>
                <div class="stat-value text-warning text-xl">
                    Rp {{ number_format($subscriptionData['mrr'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-warning">Monthly Recurring Revenue</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Retention Rate</div>
                <div class="stat-value text-primary text-2xl">
                    {{ number_format($subscriptionData['retention_rate'] ?? 0, 1) }}%
                </div>
                <div class="stat-desc text-primary">Tingkat retensi</div>
            </div>
        </div>

        {{-- Subscription Status Distribution --}}
        {{-- <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Distribusi Status Subscription</h4>
                <div class="h-64 flex items-center justify-center bg-base-200 rounded-lg">
                    <p class="text-base-content/60">Chart distribusi status subscription akan ditampilkan di sini</p>
                </div>
            </div>
        </div> --}}

        {{-- Active Subscriptions Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Subscription Aktif</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('subscription-aktif-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('subscription-aktif-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">Start Date</th>
                                <th class="font-semibold">Next Billing</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-right">Monthly Fee</th>
                                <th class="font-semibold text-center">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($subscriptionData && isset($subscriptionData['active_subscriptions']))
                                @forelse($subscriptionData['active_subscriptions'] as $index => $subscription)
                                    @php
                                        $user = $subscription->user ?? null;
                                        $product = $subscription->product ?? null;
                                        $startDate = $subscription->start_date ? \Carbon\Carbon::parse($subscription->start_date) : null;
                                        $duration = $startDate ? $startDate->diffInDays(now()) : 0;
                                        $foto = $user && $user->foto_profile ? asset('storage/' . $user->foto_profile) : null;
                                        $userInitial = $user && $user->full_name ? strtoupper(substr($user->full_name, 0, 2)) : 'N/A';
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-8 h-8 rounded-full ring-1 ring-offset-1">
                                                        @if($foto)
                                                            <img src="{{ $foto }}" alt="{{ $user->full_name ?? 'N/A' }}" class="w-8 h-8 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-8 h-8 rounded-full">
                                                                {{ $userInitial }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $product->name_product ?? 'N/A' }}</div>
                                            <div class="text-xs text-base-content/60">{{ $product->product_code ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm">{{ $startDate ? $startDate->format('d M Y') : 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm">
                                                @php
                                                    $nextBilling = $subscription->next_billing ?? $subscription->end_date ?? null;
                                                @endphp
                                                @if($nextBilling)
                                                    {{ \Carbon\Carbon::parse($nextBilling)->format('d M Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-success badge-soft badge-sm">Active</div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-info">
                                                @php
                                                    $fee = $subscription->monthly_fee ?? ($product->price_monthly ?? null);
                                                @endphp
                                                @if($fee && $fee > 0)
                                                    Rp {{ number_format($fee, 0, ',', '.') }}
                                                @else
                                                    <span class="text-base-content/60">N/A</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-sm">
                                                @php
                                                    $end = $subscription->next_billing ?? $subscription->end_date ?? null;
                                                    $now = now();
                                                    if ($end) {
                                                        $endDate = \Carbon\Carbon::parse($end);
                                                        if ($endDate->isPast()) {
                                                            $diffMonths = 0;
                                                            $diffDays = 0;
                                                        } else {
                                                            $diffMonths = $now->diffInMonths($endDate);
                                                            $daysClone = $now->copy()->addMonths($diffMonths);
                                                            $diffDays = $daysClone->diffInDays($endDate);
                                                        }
                                                        if ($diffMonths > 0) {
                                                            echo (int) $diffMonths . ' bulan ' . (int) $diffDays . ' hari';
                                                        } else {
                                                            echo (int) $diffDays . ' hari';
                                                        }
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada subscription aktif untuk periode ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="8" class="text-center py-8">
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
    <div class="modal-backdrop" @click="$wire.set('showDetailSubscriptionAktifModal', false)"></div>
</div>