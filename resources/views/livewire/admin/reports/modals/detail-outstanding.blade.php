{{-- Detail Outstanding Modal --}}
<div>
    <input type="checkbox" wire:model="showDetailOutstandingModal" class="modal-toggle" />
    <div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-error/15 text-error rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    Detail Outstanding
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap piutang yang belum terbayar untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailOutstandingModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-error/10 rounded-lg border border-error/20">
                <div class="stat-title text-error">Total Outstanding</div>
                <div class="stat-value text-error text-xl">
                    Rp {{ number_format($invoiceData['outstanding'] ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-error">Piutang belum bayar</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">Invoice Overdue</div>
                <div class="stat-value text-warning text-2xl">
                    {{ $invoiceData['overdue_count'] ?? 0 }}
                </div>
                <div class="stat-desc text-warning">Lewat jatuh tempo</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Rata-rata Piutang</div>
                <div class="stat-value text-info text-xl">
                    @php
                        $totalOutstanding = $invoiceData['unpaid'] ?? 1;
                        $avgOutstanding = $totalOutstanding > 0 ? ($invoiceData['outstanding'] ?? 0) / $totalOutstanding : 0;
                    @endphp
                    Rp {{ number_format($avgOutstanding, 0, ',', '.') }}
                </div>
                <div class="stat-desc text-info">Per invoice</div>
            </div>

            <div class="stat bg-primary/10 rounded-lg border border-primary/20">
                <div class="stat-title text-primary">Collection Rate</div>
                <div class="stat-value text-primary text-2xl">
                    @php
                        $totalInvoices = ($invoiceData['paid'] ?? 0) + ($invoiceData['unpaid'] ?? 0);
                        $collectionRate = $totalInvoices > 0 ? (($invoiceData['paid'] ?? 0) / $totalInvoices) * 100 : 0;
                    @endphp
                    {{ number_format($collectionRate, 1) }}%
                </div>
                <div class="stat-desc text-primary">Tingkat koleksi</div>
            </div>
        </div>

        {{-- Outstanding Aging Analysis --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="card bg-green-50 border border-green-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-green-600">0-30 Hari</h5>
                    <p class="text-2xl font-bold text-green-600">{{ $invoiceData['aging_0_30'] ?? 0 }}</p>
                    <p class="text-sm text-green-600/80">Rp {{ number_format($invoiceData['amount_0_30'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="card bg-yellow-50 border border-yellow-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-yellow-600">31-60 Hari</h5>
                    <p class="text-2xl font-bold text-yellow-600">{{ $invoiceData['aging_31_60'] ?? 0 }}</p>
                    <p class="text-sm text-yellow-600/80">Rp {{ number_format($invoiceData['amount_31_60'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="card bg-orange-50 border border-orange-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-orange-600">61-90 Hari</h5>
                    <p class="text-2xl font-bold text-orange-600">{{ $invoiceData['aging_61_90'] ?? 0 }}</p>
                    <p class="text-sm text-orange-600/80">Rp {{ number_format($invoiceData['amount_61_90'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="card bg-red-50 border border-red-200">
                <div class="card-body text-center">
                    <h5 class="font-bold text-red-600">> 90 Hari</h5>
                    <p class="text-2xl font-bold text-red-600">{{ $invoiceData['aging_90_plus'] ?? 0 }}</p>
                    <p class="text-sm text-red-600/80">Rp {{ number_format($invoiceData['amount_90_plus'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Outstanding List Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Invoice Outstanding</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('outstanding-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('outstanding-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">Invoice ID</th>
                                <th class="font-semibold">Customer</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold">Due Date</th>
                                <th class="font-semibold text-center">Days Overdue</th>
                                <th class="font-semibold text-center">Aging</th>
                                <th class="font-semibold text-right">Amount</th>
                                <th class="font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($invoiceData && isset($invoiceData['invoices']))
                                @forelse($invoiceData['invoices'] as $index => $invoice)
                                    @php
                                        // Calculate days since invoice created (aging)
                                        $createdDate = \Carbon\Carbon::parse($invoice->created_at);
                                        $daysSinceCreated = floor($createdDate->diffInDays(now()));
                                        
                                        // Calculate days overdue from end_date
                                        $dueDate = $invoice->end_date ? \Carbon\Carbon::parse($invoice->end_date) : \Carbon\Carbon::now()->addDays(30);
                                        $daysOverdue = $dueDate->isPast() ? $dueDate->diffInDays(now()) : 0;
                                        
                                        // Aging category based on days since created
                                        $agingCategory = $daysSinceCreated <= 30 ? '0-30' : ($daysSinceCreated <= 60 ? '31-60' : ($daysSinceCreated <= 90 ? '61-90' : '90+'));
                                        $agingClass = $daysSinceCreated <= 30 ? 'badge-success' : ($daysSinceCreated <= 60 ? 'badge-warning' : ($daysSinceCreated <= 90 ? 'badge-error' : 'badge-error'));
                                    @endphp
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="font-mono text-sm font-bold">{{ $invoice->transaction_code ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="ring-primary ring-offset-base-100 w-8 h-8 rounded-full ring-1 ring-offset-1">
                                                        @if($invoice->user && $invoice->user->foto_profile)
                                                            <img src="{{ asset('storage/' . $invoice->user->foto_profile) }}" 
                                                                 alt="{{ $invoice->user->full_name }}" 
                                                                 class="w-8 h-8 rounded-full object-cover" />
                                                        @else
                                                            <div class="bg-primary text-primary-content flex items-center justify-center text-xs font-bold w-8 h-8 rounded-full">
                                                                {{ $invoice->user ? strtoupper(substr($invoice->user->full_name, 0, 2)) : 'N/A' }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-sm">{{ $invoice->user->full_name ?? 'N/A' }}</div>
                                                    <div class="text-xs text-base-content/60">{{ $invoice->user->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-sm">{{ $invoice->product->name_product ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm">{{ $dueDate->format('d M Y') }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($daysOverdue > 0)
                                                <div class="badge badge-error badge-soft badge-sm">{{ $daysOverdue }} hari</div>
                                            @else
                                                <div class="badge badge-success badge-soft badge-sm">Belum jatuh tempo</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="badge {{ $agingClass }} badge-soft badge-sm">
                                                {{ $agingCategory }}
                                            </div>
                                            <div class="text-xs text-base-content/60 mt-1">
                                                {{ (int) $daysSinceCreated }} hari
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-error">
                                                Rp {{ number_format($invoice->total_payment ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="btn btn-ghost btn-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </div>
                                                <ul tabindex="0" class="dropdown-content menu rounded-box z-10 w-32 shadow-xl bg-base-100 border border-base-300">
                                                    <li><a class="text-xs text-primary hover:bg-primary/10">Send Reminder</a></li>
                                                    <li><a class="text-xs text-warning hover:bg-warning/10">Mark Partial</a></li>
                                                    <li><a class="text-xs text-error hover:bg-error/10">Write Off</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada outstanding untuk periode ini</p>
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
        <div class="modal-backdrop" @click="$wire.set('showDetailOutstandingModal', false)"></div>
    </div>
</div>