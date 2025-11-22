{{-- Reject Transaction Modal --}}
<input type="checkbox" wire:model="showRejectModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold text-error">Tolak Transaksi</h3>
                <p class="text-sm text-neutral mt-1">Berikan alasan penolakan transaksi kepada pelanggan</p>
            </div>
            <button @click="$wire.set('showRejectModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Transaction Info Summary --}}
        @if($selectedTransaction)
        <div class="bg-error/10 rounded-lg p-4 mb-6 border border-error/20">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.083 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <span class="font-semibold text-error">Transaksi akan ditolak</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="font-medium text-base-content/70">Kode Transaksi:</span>
                    <p class="font-mono font-bold">{{ $selectedTransaction->transaction_code }}</p>
                </div>
                <div>
                    <span class="font-medium text-base-content/70">Pelanggan:</span>
                    <p class="font-semibold">{{ $selectedTransaction->user->full_name }}</p>
                </div>
                <div>
                    <span class="font-medium text-base-content/70">Email:</span>
                    <p class="font-semibold">{{ $selectedTransaction->user->email }}</p>
                </div>
                <div>
                    <span class="font-medium text-base-content/70">Total:</span>
                    <p class="font-bold text-error">Rp {{ number_format($selectedTransaction->total_payment, 0, ',', '.') }}</p>
                </div>
                <div class="md:col-span-2">
                    <span class="font-medium text-base-content/70">Produk:</span>
                    <p class="font-semibold">{{ $selectedTransaction->product->name_product }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Form Content --}}
        <form wire:submit.prevent="rejectTransaction">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Warning Alert --}}
                <div class="col-span-2">
                    <div class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.083 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Perhatian:</strong> Pastikan Anda telah mengecek bukti pembayaran dan yakin untuk menolak transaksi ini. Pelanggan akan menerima notifikasi penolakan.
                        </div>
                    </div>
                </div>

                {{-- Reject Reason Input --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Alasan Penolakan
                    </h4>
                    <textarea wire:model="rejectReason" 
                        placeholder="Jelaskan alasan penolakan transaksi ini..." 
                        class="textarea textarea-bordered w-full h-32 resize-none @error('rejectReason') textarea-error @enderror"
                        maxlength="1000" required></textarea>
                    @error('rejectReason') 
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Common Rejection Reasons --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Alasan Umum (Opsional)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <button type="button" @click="$wire.set('rejectReason', 'Bukti pembayaran tidak valid atau tidak dapat diverifikasi')" 
                            class="btn btn-outline btn-sm justify-start">
                            Bukti Pembayaran Tidak Valid
                        </button>
                        <button type="button" @click="$wire.set('rejectReason', 'Nominal pembayaran tidak sesuai dengan harga produk')" 
                            class="btn btn-outline btn-sm justify-start">
                            Nominal Tidak Sesuai
                        </button>
                        <button type="button" @click="$wire.set('rejectReason', 'Bukti pembayaran sudah kedaluwarsa atau terlalu lama')" 
                            class="btn btn-outline btn-sm justify-start">
                            Pembayaran Kedaluwarsa
                        </button>
                        <button type="button" @click="$wire.set('rejectReason', 'Metode pembayaran yang digunakan tidak sesuai')" 
                            class="btn btn-outline btn-sm justify-start">
                            Metode Pembayaran Salah
                        </button>
                    </div>
                </div>

                {{-- Consequence Notice --}}
                <div class="col-span-2">
                    <div class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <div class="text-sm">
                            <strong>Konsekuensi penolakan:</strong>
                            <ul class="list-disc list-inside mt-2 space-y-1">
                                <li>Status transaksi akan berubah menjadi "Ditolak"</li>
                                <li>Pelanggan akan menerima notifikasi dengan alasan penolakan</li>
                                <li>Pelanggan dapat melakukan pembayaran ulang jika diperlukan</li>
                                <li>Transaksi ini akan tercatat dalam riwayat sistem</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showRejectModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="btn btn-error" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span wire:loading.remove>Tolak Transaksi</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showRejectModal', false)">Close</label>
</div>
