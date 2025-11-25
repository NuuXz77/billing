{{-- Detail User Baru Modal --}}
<input type="checkbox" wire:model="showDetailUserBaruModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-warning/15 text-warning rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    Detail User Baru
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap user baru yang mendaftar untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailUserBaruModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">User Baru</div>
                <div class="stat-value text-warning text-2xl">
                    {{ $userData['new'] ?? 0 }}
                </div>
                <div class="stat-desc text-warning">Periode ini</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Converted to Paid</div>
                <div class="stat-value text-success text-2xl">
                    {{ $userData['new_converted'] ?? 0 }}
                </div>
                <div class="stat-desc text-success">Menjadi customer</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Conversion Rate</div>
                <div class="stat-value text-info text-2xl">
                    @php
                        $newUsers = $userData['new'] ?? 1;
                        $conversionRate = $newUsers > 0 ? (($userData['new_converted'] ?? 0) / $newUsers) * 100 : 0;
                    @endphp
                    {{ number_format($conversionRate, 1) }}%
                </div>
                <div class="stat-desc text-info">Tingkat konversi</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Avg. Time to Convert</div>
                <div class="stat-value text-primary text-xl">
                    {{ $userData['avg_time_to_convert'] ?? 0 }}
                </div>
                <div class="stat-desc text-primary">Hari rata-rata</div>
            </div>
        </div>

        {{-- Registration Trend Chart --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Tren Registrasi Harian</h4>
                <div class="h-64 flex items-center justify-center bg-base-200 rounded-lg">
                    <p class="text-base-content/60">Grafik tren registrasi harian akan ditampilkan di sini</p>
                </div>
            </div>
        </div>

        {{-- User Conversion Funnel --}}
        <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Conversion Funnel</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-32 text-sm font-medium">Registrasi</div>
                        <div class="flex-1 bg-base-200 rounded-full h-6 relative">
                            <div class="bg-warning h-6 rounded-full" style="width: 100%"></div>
                            <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-warning-content">{{ $userData['new'] ?? 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-32 text-sm font-medium">Email Verified</div>
                        <div class="flex-1 bg-base-200 rounded-full h-6 relative">
                            @php
                                $verifiedRate = ($userData['new'] ?? 1) > 0 ? (($userData['verified'] ?? 0) / ($userData['new'] ?? 1)) * 100 : 0;
                            @endphp
                            <div class="bg-info h-6 rounded-full" style="width: {{ $verifiedRate }}%"></div>
                            <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-info-content">{{ $userData['verified'] ?? 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-32 text-sm font-medium">First Purchase</div>
                        <div class="flex-1 bg-base-200 rounded-full h-6 relative">
                            <div class="bg-success h-6 rounded-full" style="width: {{ $conversionRate }}%"></div>
                            <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-success-content">{{ $userData['new_converted'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- New Users Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar User Baru</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('user-baru-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('user-baru-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold text-center">Registration Date</th>
                                <th class="font-semibold text-center">Email Verified</th>
                                <th class="font-semibold text-center">First Purchase</th>
                                <th class="font-semibold text-center">Days to Convert</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-center">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($userData && isset($userData['new_users']))
                                @forelse($userData['new_users'] as $index => $user)
                                    @php
                                        $registrationDate = \Carbon\Carbon::parse($user->created_at);
                                        $firstPurchaseDate = $user->first_purchase_date ? \Carbon\Carbon::parse($user->first_purchase_date) : null;
                                        $daysToConvert = $firstPurchaseDate ? $registrationDate->diffInDays($firstPurchaseDate) : null;
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
                                                            <div class="bg-warning text-warning-content flex items-center justify-center text-xs font-bold w-10 h-10 rounded-full">
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
                                            <div class="text-sm">{{ $registrationDate->format('d M Y') }}</div>
                                            <div class="text-xs text-base-content/60">{{ $registrationDate->format('H:i') }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($user->email_verified_at)
                                                <div class="badge badge-success badge-soft badge-sm">✓ Verified</div>
                                            @else
                                                <div class="badge badge-error badge-soft badge-sm">✗ Not Verified</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($firstPurchaseDate)
                                                <div class="text-sm">{{ $firstPurchaseDate->format('d M Y') }}</div>
                                                <div class="badge badge-success badge-soft badge-xs">Converted</div>
                                            @else
                                                <div class="badge badge-warning badge-soft badge-sm">Pending</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($daysToConvert !== null)
                                                <div class="badge badge-info badge-soft badge-sm">{{ $daysToConvert }} hari</div>
                                            @else
                                                <div class="text-sm text-base-content/60">-</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ ($user->status ?? $user->is_active ?? 'active') == 'active' ? 'badge-success' : 'badge-error' }} badge-soft badge-sm">
                                                {{ ucfirst($user->status ?? $user->is_active ?? 'active') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-ghost badge-sm">
                                                {{ $user->registration_source ?? 'Direct' }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada user baru untuk periode ini</p>
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
    <div class="modal-backdrop" @click="$wire.set('showDetailUserBaruModal', false)"></div>
</div>