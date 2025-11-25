{{-- Detail ARPU Modal --}}
<input type="checkbox" wire:model="showDetailArpuModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-warning/15 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    Detail ARPU (Average Revenue Per User)
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Analisis rata-rata pendapatan per user untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailArpuModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">ARPU</div>
                <div class="stat-value text-warning text-xl">
                    Rp {{ number_format($userData['arpu'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-warning">Per user</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Total Revenue</div>
                <div class="stat-value text-primary text-xl">
                    Rp {{ number_format($revenueData['total_annual'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-primary">Pendapatan total</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Active Users</div>
                <div class="stat-value text-info text-2xl">
                    {{ $userData['active'] ?? 0 }}
                </div>
                <div class="stat-desc text-info">User aktif</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Paying Users</div>
                <div class="stat-value text-success text-2xl">
                    {{ $userData['paying_users'] ?? 0 }}
                </div>
                <div class="stat-desc text-success">User berbayar</div>
            </div>
        </div>

        {{-- ARPU Analysis Chart --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Tren ARPU</h4>
                <div class="h-64 flex items-center justify-center bg-base-200 rounded-lg">
                    <p class="text-base-content/60">Grafik tren ARPU akan ditampilkan di sini</p>
                </div>
            </div>
        </div>

        {{-- User Revenue Breakdown --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Breakdown Pendapatan Per User</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('arpu-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('arpu-detail')" class="btn btn-outline btn-success btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                {{-- User Segmentation --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="card bg-success/5 border border-success/20">
                        <div class="card-body text-center">
                            <h5 class="font-bold text-success">High Value Users</h5>
                            <p class="text-3xl font-bold text-success">{{ $userData['high_value'] ?? 0 }}</p>
                            <p class="text-sm text-success/80">ARPU > Rp 500k</p>
                        </div>
                    </div>

                    <div class="card bg-warning/5 border border-warning/20">
                        <div class="card-body text-center">
                            <h5 class="font-bold text-warning">Medium Value Users</h5>
                            <p class="text-3xl font-bold text-warning">{{ $userData['medium_value'] ?? 0 }}</p>
                            <p class="text-sm text-warning/80">ARPU Rp 100k - 500k</p>
                        </div>
                    </div>

                    <div class="card bg-error/5 border border-error/20">
                        <div class="card-body text-center">
                            <h5 class="font-bold text-error">Low Value Users</h5>
                            <p class="text-3xl font-bold text-error">{{ $userData['low_value'] ?? 0 }}</p>
                            <p class="text-sm text-error/80">ARPU < Rp 100k</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-hover w-full">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="font-semibold">#</th>
                                <th class="font-semibold">User</th>
                                <th class="font-semibold text-center">Total Transaksi</th>
                                <th class="font-semibold text-center">Total Spending</th>
                                <th class="font-semibold text-center">ARPU Individual</th>
                                <th class="font-semibold text-center">Kategori</th>
                                <th class="font-semibold text-center">Last Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($userData && isset($userData['user_breakdown']))
                                @forelse($userData['user_breakdown'] as $index => $user)
                                    @php
                                        $userArpu = $user->total_spending ?? 0;
                                        $category = $userArpu > 500000 ? 'High' : ($userArpu > 100000 ? 'Medium' : 'Low');
                                        $categoryClass = $userArpu > 500000 ? 'badge-success' : ($userArpu > 100000 ? 'badge-warning' : 'badge-error');
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-10 h-10 rounded-full ring-1 ring-offset-1">
                                                        @if($user->foto_profile)
                                                            <img src="{{ asset('storage/' . $user->foto_profile) }}" 
                                                                 alt="{{ $user->full_name }}" 
                                                                 class="w-10 h-10 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-10 h-10 rounded-full">
                                                                {{ strtoupper(substr($user->full_name, 0, 2)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $user->full_name }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-primary badge-soft badge-sm">
                                                {{ $user->transaction_count ?? 0 }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="font-bold text-success">
                                                Rp {{ number_format($user->total_spending ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="font-bold text-warning">
                                                Rp {{ number_format($userArpu, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ $categoryClass }} badge-soft badge-sm">
                                                {{ $category }} Value
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-sm">
                                                {{ $user->last_transaction ? \Carbon\Carbon::parse($user->last_transaction)->format('d M Y') : 'N/A' }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada data user untuk periode ini</p>
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
    <div class="modal-backdrop" @click="$wire.set('showDetailArpuModal', false)"></div>
</div>