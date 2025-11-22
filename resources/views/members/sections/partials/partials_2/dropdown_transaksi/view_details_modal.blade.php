{{-- View Transaction Details Modal --}}
<div id="viewDetailsModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4 modal-backdrop-fade" onclick="if(event.target === this) closeModal('viewDetailsModal-{{ $transaction->id }}')">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[85vh] overflow-hidden flex flex-col modal-slideup" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5 flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Detail Transaksi
                </h3>
                <p class="text-sm text-gray-300 mt-1 font-mono">{{ $transaction->transaction_code }}</p>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 overflow-y-auto flex-1 space-y-5">
            {{-- Detail Pembayaran Section --}}
            <div class="border border-gray-200 rounded-lg p-5">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Detail Pembayaran
                </h4>
                
                <div class="space-y-3">
                    {{-- Customer Name --}}
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Nama Customer</p>
                        <p class="font-semibold text-gray-900">{{ $transaction->user->username }}</p>
                    </div>

                    {{-- Email Address --}}
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Email Address</p>
                        <p class="font-semibold text-gray-900">{{ $transaction->user->email }}</p>
                    </div>

                    {{-- Product Name --}}
                    <div class="flex justify-between items-start py-2 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Paket</p>
                            <p class="font-semibold text-gray-900">{{ $transaction->product->name_product }}</p>
                        </div>
                    </div>

                    {{-- Billing Cycle --}}
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Periode Langganan</p>
                        <p class="font-semibold text-gray-900">
                            @if($transaction->billing_cycle === 'monthly')
                                1 Bulan
                            @elseif($transaction->billing_cycle === 'yearly')
                                1 Tahun
                            @else
                                {{ ucfirst($transaction->billing_cycle) }}
                            @endif
                        </p>
                    </div>

                    {{-- Duration --}}
                    @if($transaction->start_date && $transaction->end_date)
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Durasi Aktif</p>
                        <p class="font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($transaction->start_date)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($transaction->end_date)->format('d M Y') }}
                        </p>
                    </div>
                    @endif

                    {{-- Product Price --}}
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Harga Paket</p>
                        <p class="font-semibold text-gray-900">Rp {{ number_format($transaction->product->price_monthly, 0, ',', '.') }}</p>
                    </div>

                    {{-- Discount if any --}}
                    @if($transaction->product->discount_percentage > 0)
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Diskon</p>
                        <p class="font-semibold text-green-600">-{{ $transaction->product->discount_percentage }}%</p>
                    </div>
                    @endif

                    {{-- Total Payment --}}
                    <div class="flex justify-between items-center py-3 bg-gray-50 rounded-lg px-3 mt-2">
                        <p class="font-bold text-gray-900">Total Pembayaran</p>
                        <p class="font-bold text-gray-900 text-lg">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Transaction Info --}}
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1.5">Transaction ID</p>
                        <p class="text-lg font-mono font-bold text-gray-900">{{ $transaction->transaction_code }}</p>
                    </div>
                    @php
                        $statusConfig = [
                            'active' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Active'],
                            'pending_payment' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Pending Payment'],
                            'pending_confirm' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'label' => 'Confirming'],
                            'expired' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => 'Expired'],
                            'canceled' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Canceled'],
                            'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Rejected']
                        ];
                        $status = $statusConfig[$transaction->status] ?? $statusConfig['pending_payment'];
                    @endphp
                    <span class="px-3 py-1.5 {{ $status['bg'] }} {{ $status['text'] }} text-xs font-bold rounded-lg">
                        {{ $status['label'] }}
                    </span>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Tipe Transaksi</p>
                        <p class="text-sm font-semibold text-gray-900 capitalize">{{ $transaction->transaction_type }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Tanggal Dibuat</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $transaction->created_at->format('d M Y - H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Metode Pembayaran</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $transaction->payment->payment_bank ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Service Details & Admin Notes (if applicable) --}}
            @if(($transaction->subdomain_web || $transaction->subdomain_server) || $transaction->admin_notes)
            <div class="grid grid-cols-1 gap-4 mt-5">
                @if($transaction->subdomain_web || $transaction->subdomain_server)
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <h4 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                        Service Information
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        @if($transaction->subdomain_web)
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Web Domain</p>
                            <p class="font-mono text-xs font-semibold text-gray-900">{{ $transaction->subdomain_web }}</p>
                        </div>
                        @endif
                        @if($transaction->subdomain_server)
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Server Domain</p>
                            <p class="font-mono text-xs font-semibold text-gray-900">{{ $transaction->subdomain_server }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($transaction->admin_notes)
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <h4 class="text-sm font-bold text-gray-900 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Admin Notes
                    </h4>
                    <p class="text-xs text-gray-700">{{ $transaction->admin_notes }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Modal Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50 flex-shrink-0">
            <button onclick="closeModal('viewDetailsModal-{{ $transaction->id }}')" class="px-6 py-2.5 border-2 border-gray-300 rounded-lg hover:bg-gray-100 transition-all duration-200 text-gray-900 font-semibold">
                Close
            </button>
            @if($transaction->status === 'active')
            <button onclick="openModal('downloadReceiptModal-{{ $transaction->id }}'); closeModal('viewDetailsModal-{{ $transaction->id }}')" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg transition-all duration-200 font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Receipt
            </button>
            @endif
        </div>
    </div>
</div>
