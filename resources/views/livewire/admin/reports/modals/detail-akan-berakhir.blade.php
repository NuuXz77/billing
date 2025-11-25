{{-- Detail Akan Berakhir Modal --}}
<input type="checkbox" wire:model="showDetailAkanBerakhirModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-accent/15 text-accent rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Detail Subscription Akan Berakhir
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap subscription yang akan berakhir dalam 30 hari ke depan
                </p>
            </div>
            <button @click="$wire.set('showDetailAkanBerakhirModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-accent/10 rounded-lg border border-accent/20">
                <div class="stat-title text-accent">Akan Berakhir</div>
                <div class="stat-value text-accent text-2xl">
                    {{ $subscriptionData['expiring'] ?? 0 }}
                </div>
                <div class="stat-desc text-accent">30 hari ke depan</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">Revenue at Risk</div>
                <div class="stat-value text-warning text-xl">
                    Rp {{ number_format($subscriptionData['revenue_at_risk'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-warning">Potensi kehilangan</div>
            </div>

            <div class="stat bg-error/10 rounded-lg border border-error/20">
                <div class="stat-title text-error">Critical (< 7 hari)</div>
                <div class="stat-value text-error text-2xl">
                    {{ $subscriptionData['critical_expiring'] ?? 0 }}
                </div>
                <div class="stat-desc text-error">Segera berakhir</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Renewal Rate</div>
                <div class="stat-value text-info text-2xl">
                    {{ number_format($subscriptionData['renewal_rate'] ?? 0, 1) }}%
                </div>
                <div class="stat-desc text-info">Tingkat perpanjangan</div>
            </div>
        </div>

        {{-- Expiry Timeline --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="card bg-red-50 border border-red-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-red-600">1-7 Hari</h5>
                    <p class="text-3xl font-bold text-red-600">{{ $subscriptionData['expiring_1_7'] ?? 0 }}</p>
                    <p class="text-sm text-red-600/80">Kritis</p>
                </div>
            </div>

            <div class="card bg-orange-50 border border-orange-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-orange-600">8-14 Hari</h5>
                    <p class="text-3xl font-bold text-orange-600">{{ $subscriptionData['expiring_8_14'] ?? 0 }}</p>
                    <p class="text-sm text-orange-600/80">Urgent</p>
                </div>
            </div>

            <div class="card bg-yellow-50 border border-yellow-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-yellow-600">15-21 Hari</h5>
                    <p class="text-3xl font-bold text-yellow-600">{{ $subscriptionData['expiring_15_21'] ?? 0 }}</p>
                    <p class="text-sm text-yellow-600/80">Warning</p>
                </div>
            </div>

            <div class="card bg-blue-50 border border-blue-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-blue-600">22-30 Hari</h5>
                    <p class="text-3xl font-bold text-blue-600">{{ $subscriptionData['expiring_22_30'] ?? 0 }}</p>
                    <p class="text-sm text-blue-600/80">Normal</p>
                </div>
            </div>
        </div>

        {{-- Expiring Subscriptions Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Subscription Akan Berakhir</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('akan-berakhir-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('akan-berakhir-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">Expiry Date</th>
                                <th class="font-semibold text-center">Days Left</th>
                                <th class="font-semibold text-center">Priority</th>
                                <th class="font-semibold text-right">Monthly Value</th>
                                <th class="font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($subscriptionData && isset($subscriptionData['expiring_subscriptions']))
                                @forelse($subscriptionData['expiring_subscriptions'] as $index => $subscription)
                                    @php
                                        $expiryDate = \Carbon\Carbon::parse($subscription->expiry_date);
                                        $daysLeft = now()->diffInDays($expiryDate, false);
                                        $priority = $daysLeft <= 7 ? 'Critical' : ($daysLeft <= 14 ? 'High' : ($daysLeft <= 21 ? 'Medium' : 'Low'));
                                        $priorityClass = $daysLeft <= 7 ? 'badge-error' : ($daysLeft <= 14 ? 'badge-warning' : ($daysLeft <= 21 ? 'badge-info' : 'badge-success'));
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-8 h-8 rounded-full ring-1 ring-offset-1">
                                                        @if($subscription->user && $subscription->user->foto_profile)
                                                            <img src="{{ asset('storage/' . $subscription->user->foto_profile) }}" 
                                                                 alt="{{ $subscription->user->full_name }}" 
                                                                 class="w-8 h-8 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-8 h-8 rounded-full">
                                                                {{ $subscription->user ? strtoupper(substr($subscription->user->full_name, 0, 2)) : 'N/A' }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $subscription->user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $subscription->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $subscription->product->name_product ?? 'N/A' }}</div>
                                            <div class="text-xs text-base-content/60">{{ $subscription->product->product_code ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm">{{ $expiryDate->format('d M Y') }}</div>
                                            <div class="text-xs text-base-content/60">{{ $expiryDate->format('H:i') }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($daysLeft >= 0)
                                                <div class="badge {{ $priorityClass }} badge-soft badge-sm">{{ $daysLeft }} hari</div>
                                            @else
                                                <div class="badge badge-error badge-soft badge-sm">Expired</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ $priorityClass }} badge-soft badge-sm">{{ $priority }}</div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-accent">
                                                Rp {{ number_format($subscription->monthly_fee ?? 0, 0, ',', '.') }}
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
                                                    <li><a class="text-xs text-success hover:bg-success/10">Send Reminder</a></li>
                                                    <li><a class="text-xs text-primary hover:bg-primary/10">Offer Renewal</a></li>
                                                    <li><a class="text-xs text-warning hover:bg-warning/10">Contact Customer</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada subscription yang akan berakhir</p>
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
    <div class="modal-backdrop" @click="$wire.set('showDetailAkanBerakhirModal', false)"></div>
</div>