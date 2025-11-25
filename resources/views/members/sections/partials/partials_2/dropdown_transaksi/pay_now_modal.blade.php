{{-- Pay Now Modal --}}
<div id="payNowModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 backdrop-blur-sm z-[99999] flex items-center justify-center p-4 modal-backdrop-fade" onclick="if(event.target === this) closeModal('payNowModal-{{ $transaction->id }}')">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[85vh] overflow-hidden flex flex-col modal-slideup" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-5 flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Payment Information
                </h3>
                <p class="text-sm text-green-100 mt-1 font-mono">Transaction {{ $transaction->transaction_code }}</p>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-6 overflow-y-auto flex-1">
            {{-- Payment Details --}}
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
                        <p class="font-semibold text-gray-900">{{ auth()->user()->username }}</p>
                    </div>

                    {{-- Email Address --}}
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <p class="text-sm text-gray-500">Email Address</p>
                        <p class="font-semibold text-gray-900">{{ auth()->user()->email }}</p>
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

            {{-- Payment Method Details --}}
            <div class="border border-gray-200 rounded-lg p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Transfer Details
                </h4>
                
                <div class="space-y-4 bg-gray-50 rounded-lg p-4">
                    <div>
                        <label class="text-sm text-gray-500">Bank Name</label>
                        <p class="font-bold text-gray-900 text-lg">{{ $transaction->payment->payment_bank }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Account Number</label>
                        <div class="flex items-center gap-3 mt-1">
                            <p class="font-mono font-bold text-gray-900 text-xl">{{ $transaction->payment->payment_account_number }}</p>
                            <button onclick="copyToClipboard('{{ $transaction->payment->payment_account_number }}')" class="p-2 hover:bg-gray-200 rounded-lg transition-colors" title="Copy account number">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Account Name</label>
                        <p class="font-semibold text-gray-900">{{ $transaction->payment->payment_account_name }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment Instructions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                <h5 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Payment Instructions
                </h5>
                <ol class="space-y-2 text-sm text-gray-700">
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">1.</span>
                        <span>Transfer jumlah yang tertera ke rekening di atas</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">2.</span>
                        <span>Simpan bukti transfer</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">3.</span>
                        <span>Upload bukti transfer di halaman berikutnya</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">4.</span>
                        <span>Tunggu konfirmasi admin</span>
                    </li>
                </ol>
            </div>

            {{-- Important Note --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="text-sm text-gray-700">
                        <p class="font-semibold text-gray-900 mb-1">Penting!</p>
                        <p>Transfer dengan <strong>nominal yang tepat</strong> untuk memastikan verifikasi lebih cepat. Nominal berbeda dapat menyebabkan keterlambatan konfirmasi.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50 flex-shrink-0">
            <button onclick="closeModal('payNowModal-{{ $transaction->id }}')" class="px-6 py-2.5 border-2 border-gray-300 rounded-lg hover:bg-gray-100 transition-all duration-200 text-gray-900 font-semibold">
                Cancel
            </button>
            <button onclick="openUploadProofModal('{{ $transaction->id }}')" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all duration-200 font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Payment
            </button>
        </div>
    </div>
</div>
