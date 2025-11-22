{{-- Delete User Modal --}}
<input type="checkbox" wire:model="showDeleteModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-lg">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold text-error">Konfirmasi Hapus</h3>
                <p class="text-sm text-neutral mt-1">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        {{-- Warning Content --}}
        <div class="space-y-6">
            {{-- Warning Icon & Message --}}
            <div class="flex items-start gap-4 p-6 bg-error/5 border border-error/20 rounded-xl">
                <div class="shrink-0 p-2 bg-error/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-lg text-error mb-2">Apakah Anda yakin ingin menghapus user ini?</h4>
                    <p class="text-base-content/70 text-sm">
                        Data user akan dihapus secara permanen dari sistem dan tidak dapat dipulihkan kembali.
                    </p>
                </div>
            </div>

            {{-- Consequences List --}}
            <div class="bg-warning/5 border border-warning/20 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium text-warning">Yang akan terhapus:</span>
                </div>
                <ul class="space-y-1 text-sm text-base-content/70 ml-7">
                    <li class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 bg-warning rounded-full"></div>
                        Semua informasi profil user
                    </li>
                    <li class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 bg-warning rounded-full"></div>
                        Riwayat transaksi yang terkait
                    </li>
                    <li class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 bg-warning rounded-full"></div>
                        Log aktivitas user
                    </li>
                </ul>
            </div>
        </div>

        {{-- Modal Actions --}}
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-base-300">
            <button type="button" wire:click="closeModal" class="btn btn-outline btn-neutral">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="button" wire:click="deleteUser" class="btn btn-error" wire:loading.attr="disabled" wire:target="deleteUser">
                <span wire:loading.remove wire:target="deleteUser" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Ya, Hapus User
                </span>
                <span wire:loading wire:target="deleteUser" class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    Menghapus...
                </span>
            </button>
        </div>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
