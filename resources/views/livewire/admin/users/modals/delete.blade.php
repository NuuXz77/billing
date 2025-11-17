{{-- Delete User Modal --}}
<input type="checkbox" wire:model="showDeleteModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Konfirmasi Hapus</h3>
        
        <div class="py-4">
            <div class="flex items-center gap-4 mb-4">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-lg">Apakah Anda yakin?</p>
                    <p class="text-base-content/60">Tindakan ini tidak dapat dibatalkan. Data user akan dihapus permanen dari sistem.</p>
                </div>
            </div>

            <div class="alert alert-warning">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Semua data terkait user ini akan ikut terhapus!</span>
            </div>
        </div>

        <div class="modal-action">
            <button type="button" wire:click="closeModal" class="btn">Batal</button>
            <button type="button" wire:click="deleteUser" class="btn btn-error" wire:loading.attr="disabled">
                <span wire:loading.remove>Hapus</span>
                <span wire:loading class="loading loading-spinner loading-sm"></span>
            </button>
        </div>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
