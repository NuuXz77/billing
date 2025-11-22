{{-- Download Receipt Modal --}}
<div id="downloadReceiptModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4 modal-backdrop-fade" onclick="if(event.target === this) closeModal('downloadReceiptModal-{{ $transaction->id }}')">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[85vh] overflow-hidden flex flex-col modal-slideup" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-5 flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Receipt
                </h3>
                <p class="text-sm text-purple-100 mt-1 font-mono">Transaction {{ $transaction->transaction_code }}</p>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-6 overflow-y-auto flex-1">
            {{-- Receipt Preview --}}
            <div class="border-2 border-gray-300 rounded-lg p-6 bg-gray-50">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">Payment Successful</h4>
                    <p class="text-sm text-gray-600">Thank you for your payment</p>
                </div>

                <div class="bg-white rounded-lg p-5 space-y-4">
                    <div class="flex justify-between border-b border-gray-200 pb-3">
                        <span class="text-gray-600">Transaction ID</span>
                        <span class="font-mono font-bold text-gray-900">{{ $transaction->transaction_code }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-3">
                        <span class="text-gray-600">Product/Service</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->product->name_product }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-3">
                        <span class="text-gray-600">Payment Date</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->confirmed_at ? $transaction->confirmed_at->format('M d, Y') : $transaction->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-3">
                        <span class="text-gray-600">Payment Method</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->payment_method }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-3">
                        <span class="text-gray-600">Service Period</span>
                        <span class="font-semibold text-gray-900">
                            {{ $transaction->start_date ? $transaction->start_date->format('M d, Y') : '-' }} - 
                            {{ $transaction->end_date ? $transaction->end_date->format('M d, Y') : '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between pt-3">
                        <span class="text-lg font-bold text-gray-900">Total Amount</span>
                        <span class="text-2xl font-bold text-green-600">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Download Options --}}
            <div class="space-y-3">
                <h5 class="font-bold text-gray-900">Download Format</h5>
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="downloadReceipt('{{ $transaction->id }}', 'pdf')" class="flex items-center gap-3 p-4 border-2 border-gray-300 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all">
                        <div class="p-2 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-gray-900">PDF Format</p>
                            <p class="text-xs text-gray-500">Best for printing</p>
                        </div>
                    </button>
                    <button onclick="downloadReceipt('{{ $transaction->id }}', 'image')" class="flex items-center gap-3 p-4 border-2 border-gray-300 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-gray-900">Image (PNG)</p>
                            <p class="text-xs text-gray-500">Easy to share</p>
                        </div>
                    </button>
                </div>
            </div>

            {{-- Additional Actions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-gray-700">
                        <p class="font-semibold text-gray-900 mb-1">Need Help?</p>
                        <p>If you have any questions about this transaction, please contact our support team.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50 flex-shrink-0">
            <button onclick="closeModal('downloadReceiptModal-{{ $transaction->id }}')" class="px-6 py-2.5 border-2 border-gray-300 rounded-lg hover:bg-gray-100 transition-all duration-200 text-gray-900 font-semibold">
                Close
            </button>
            <button onclick="emailReceipt('{{ $transaction->id }}')" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg transition-all duration-200 font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Email Receipt
            </button>
        </div>
    </div>
</div>
