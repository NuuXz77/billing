{{-- Detail Total Invoice Modal --}}
<input type="checkbox" wire:model="showDetailTotalInvoiceModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-7xl max-h-[95vh] overflow-y-auto no-scrollbar w-11/12">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-2xl font-bold flex items-center gap-3">
                    <div class="p-3 bg-accent/15 text-accent rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    Detail Total Invoice
                </h3>
                <p class="text-sm text-neutral mt-2">
                    Data lengkap semua invoice untuk periode 
                    <span class="font-semibold text-success">
                        {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                    sampai
                    <span class="font-semibold text-error">
                        {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d F Y') : 'Belum dipilih' }}
                    </span>
                </p>
            </div>
            <button @click="$wire.set('showDetailTotalInvoiceModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Summary Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat bg-accent/10 rounded-lg border border-accent/20">
                <div class="stat-title text-accent">Total Invoice</div>
                <div class="stat-value text-accent text-2xl">
                    {{ $invoiceData['total'] ?? 0 }}
                </div>
                <div class="stat-desc text-accent">Semua invoice</div>
            </div>

            <div class="stat bg-success/10 rounded-lg border border-success/20">
                <div class="stat-title text-success">Invoice Dibayar</div>
                <div class="stat-value text-success text-2xl">
                    {{ $invoiceData['paid'] ?? 0 }}
                </div>
                <div class="stat-desc text-success">Sudah lunas</div>
            </div>

            <div class="stat bg-warning/10 rounded-lg border border-warning/20">
                <div class="stat-title text-warning">Invoice Pending</div>
                <div class="stat-value text-warning text-2xl">
                    {{ $invoiceData['unpaid'] ?? 0 }}
                </div>
                <div class="stat-desc text-warning">Belum dibayar</div>
            </div>

            <div class="stat bg-info/10 rounded-lg border border-info/20">
                <div class="stat-title text-info">Success Rate</div>
                <div class="stat-value text-info text-2xl">
                    @php
                        $total = $invoiceData['total'] ?? 1;
                        $successRate = $total > 0 ? (($invoiceData['paid'] ?? 0) / $total) * 100 : 0;
                    @endphp
                    {{ number_format($successRate, 1) }}%
                </div>
                <div class="stat-desc text-info">Payment rate</div>
            </div>
        </div>

        {{-- Invoice Status Chart --}}
        {{-- <div class="card bg-base-100 border border-base-300 mb-6">
            <div class="card-body">
                <h4 class="text-lg font-semibold mb-4">Distribusi Status Invoice</h4>
                <div class="h-64 flex items-center justify-center bg-base-200 rounded-lg">
                    <p class="text-base-content/60">Pie chart status invoice akan ditampilkan di sini</p>
                </div>
            </div>
        </div> --}}

        {{-- Invoice List Table --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Daftar Invoice</h4>
                    <div class="flex gap-2">
                        <button wire:click="exportPDF('total-invoice-detail')" class="btn btn-outline btn-error btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>
                        <button wire:click="exportExcel('total-invoice-detail')" class="btn btn-outline btn-success btn-sm">
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
                                <th class="font-semibold">Transaction Code</th>
                                <th class="font-semibold">Tanggal</th>
                                <th class="font-semibold">Customer</th>
                                <th class="font-semibold">Produk</th>
                                <th class="font-semibold text-center">Status</th>
                                <th class="font-semibold text-right">Total</th>
                                <th class="font-semibold text-center">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($invoiceData && isset($invoiceData['invoices']))
                                @forelse($invoiceData['invoices'] as $index => $invoice)
                                    <tr class="hover transition-colors">
                                        <td class="font-mono text-sm">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="font-mono text-sm font-bold">{{ $invoice->transaction_code ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm font-medium">
                                                {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-base-content/60">
                                                {{ \Carbon\Carbon::parse($invoice->created_at)->format('H:i') }}
                                            </div>
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
                                            <div class="text-xs text-base-content/60">{{ $invoice->product->product_code ?? '' }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($invoice->status === 'active')
                                                <div class="badge badge-success badge-soft badge-sm">Paid</div>
                                            @elseif(in_array($invoice->status, ['pending_payment', 'pending_confirm']))
                                                <div class="badge badge-warning badge-soft badge-sm">Pending</div>
                                            @elseif(in_array($invoice->status, ['expired', 'canceled', 'rejected']))
                                                <div class="badge badge-error badge-soft badge-sm">Failed</div>
                                            @else
                                                <div class="badge badge-ghost badge-sm">{{ ucfirst($invoice->status) }}</div>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-accent">
                                                Rp {{ number_format($invoice->total_payment ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-sm">
                                                {{ $invoice->end_date ? \Carbon\Carbon::parse($invoice->end_date)->format('d M Y') : 'N/A' }}
                                            </div>
                                            @if($invoice->end_date && \Carbon\Carbon::parse($invoice->end_date)->isPast() && $invoice->status !== 'active')
                                                <div class="text-xs text-error">Overdue</div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-slate-500">Tidak ada data invoice untuk periode ini</p>
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
    <div class="modal-backdrop" @click="$wire.set('showDetailTotalInvoiceModal', false)"></div>
</div>