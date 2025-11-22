{{-- Delete Product Modal --}}
<input type="checkbox" wire:model="showDeleteModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-md">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-error">Hapus Produk</h3>
            <button @click="$wire.set('showDeleteModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Warning Content --}}
        <div class="flex flex-col items-center text-center space-y-4">
            {{-- Warning Icon --}}
            <div class="p-4 bg-error/10 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-error" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.083 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>

            {{-- Warning Text --}}
            <div class="space-y-2">
                <h4 class="text-lg font-semibold text-error">Konfirmasi Penghapusan</h4>
                <p class="text-base-content/70">
                    Apakah Anda yakin ingin menghapus produk ini?
                </p>
                <div class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm">
                        <strong>Peringatan:</strong> Produk yang memiliki transaksi aktif tidak dapat dihapus. 
                        Sistem akan mengecek otomatis sebelum menghapus.
                    </div>
                </div>
            </div>

            {{-- Action Details --}}
            <div class="text-xs text-base-content/60 space-y-1">
                <p>• Data produk akan dihapus permanen</p>
                <p>• Riwayat transaksi akan tetap tersimpan</p>
                <p>• Aksi ini tidak dapat dibatalkan</p>
            </div>
        </div>

        {{-- Modal Actions --}}
        <div class="modal-action pt-6 border-t border-base-300">
            <button type="button" @click="$wire.set('showDeleteModal', false)" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button wire:click="deleteProduct" class="btn btn-error" wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span wire:loading.remove>Ya, Hapus</span>
                <span wire:loading class="loading loading-spinner loading-sm"></span>
            </button>
        </div>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showDeleteModal', false)">Close</label>
</div>