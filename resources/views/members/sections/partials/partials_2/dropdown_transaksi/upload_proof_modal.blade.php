{{-- Upload Payment Proof Modal --}}
<div id="uploadProofModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 backdrop-blur-sm z-[99999] flex items-center justify-center p-4 modal-backdrop-fade" onclick="if(event.target === this) closeModal('uploadProofModal-{{ $transaction->id }}')">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[85vh] overflow-hidden flex flex-col modal-slideup" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Upload Payment Proof
                </h3>
                <p class="text-sm text-blue-100 mt-1 font-mono">Transaction {{ $transaction->transaction_code }}</p>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-6 overflow-y-auto flex-1">
            <form id="uploadProofForm-{{ $transaction->id }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <input type="hidden" name="transfer_date" id="transferDate-{{ $transaction->id }}">
                <input type="hidden" name="transfer_time" id="transferTime-{{ $transaction->id }}">
            </form>

            {{-- Payment Summary --}}
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-6 text-white">
                <p class="text-sm opacity-90 mb-2">Total Amount</p>
                <p class="text-4xl font-bold">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</p>
                <p class="text-sm opacity-75 mt-3">{{ $transaction->product->name_product }}</p>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <button type="button" 
                            onclick="closeModal('uploadProofModal-{{ $transaction->id }}'); setTimeout(() => openModal('payNowModal-{{ $transaction->id }}'), 300);"
                            class="text-xs opacity-75 flex items-center gap-1 hover:opacity-100 transition-opacity hover:underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Lihat detail pembayaran lengkap di sini
                    </button>
                </div>
            </div>

            {{-- Upload Payment Proof --}}
            <div class="border border-gray-200 rounded-lg p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Bukti Transfer
                </h4>
                
                <div class="space-y-4">
                    {{-- File Upload Area --}}
                    <div>
                        <label class="text-sm text-gray-700 font-medium mb-2 block">Upload Bukti Pembayaran <span class="text-red-500">*</span></label>
                        <input type="file" 
                               id="paymentProofFile-{{ $transaction->id }}" 
                               name="payment_proof" 
                               accept="image/png,image/jpeg,image/jpg"
                               required
                               class="hidden" 
                               onchange="handleFileSelect(event, '{{ $transaction->id }}')">
                        
                        <label for="paymentProofFile-{{ $transaction->id }}" 
                               class="flex flex-col items-center justify-center w-full h-64 md:h-80 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 bg-white">
                            <div id="uploadPlaceholder-{{ $transaction->id }}" class="text-center p-4">
                                <svg class="w-14 h-14 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-gray-700 font-semibold mb-1">Klik untuk upload bukti transfer</p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maksimal 5MB)</p>
                            </div>
                            
                            <div id="uploadPreview-{{ $transaction->id }}" class="hidden w-full h-full p-4 relative">
                                <img id="previewImage-{{ $transaction->id }}" class="max-h-full max-w-full mx-auto rounded object-contain" alt="Preview">
                                <p id="previewFileName-{{ $transaction->id }}" class="text-center text-xs text-gray-600 mt-3 font-medium"></p>
                                <button type="button" onclick="document.getElementById('paymentProofFile-{{ $transaction->id }}').value=''; document.getElementById('uploadPreview-{{ $transaction->id }}').classList.add('hidden'); document.getElementById('uploadPlaceholder-{{ $transaction->id }}').classList.remove('hidden');" class="absolute top-3 right-3 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </label>
                    </div>

                    {{-- Sender Account Name --}}
                    <div>
                        <label class="text-sm text-gray-700 font-medium mb-2 block">Nama Pemilik Rekening Pengirim <span class="text-red-500">*</span></label>
                        <input type="text" 
                               name="sender_name" 
                               id="senderName-{{ $transaction->id }}"
                               required
                               placeholder="Masukkan nama sesuai rekening pengirim"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-semibold text-gray-900 placeholder-gray-400 outline-none">
                    </div>
                </div>
            </div>

            {{-- Upload Instructions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                <h5 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Petunjuk Upload
                </h5>
                <ol class="space-y-2 text-sm text-gray-700">
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">1.</span>
                        <span>Upload foto/screenshot bukti transfer yang jelas</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">2.</span>
                        <span>Pastikan detail transaksi terlihat jelas (nominal, tanggal, waktu)</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">3.</span>
                        <span>Masukkan nama pemilik rekening pengirim sesuai bank Anda</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">4.</span>
                        <span>Format file: PNG, JPG, atau JPEG (Maksimal 5MB)</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-bold text-blue-600">5.</span>
                        <span>Tanggal dan waktu transfer akan otomatis tercatat saat Anda submit</span>
                    </li>
                </ol>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-between gap-3 bg-gray-50 flex-shrink-0">
            <button type="button" onclick="closeModal('uploadProofModal-{{ $transaction->id }}')" class="px-6 py-2.5 border-2 border-gray-300 rounded-lg hover:bg-gray-100 transition-all duration-200 text-gray-900 font-semibold text-center whitespace-nowrap">
                Cancel
            </button>
            <button type="button" onclick="submitPaymentProof('{{ $transaction->id }}')" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 font-semibold text-center whitespace-nowrap flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Submit</span>
            </button>
        </div>
    </div>
</div>
