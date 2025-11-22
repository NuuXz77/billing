{{-- Confirm Admin Modal --}}
<input type="checkbox" wire:model="showConfirmAdminModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold text-success">Konfirmasi Akhir & Kirim Akun Server</h3>
                <p class="text-sm text-neutral mt-1">Lengkapi informasi server dan konfirmasi transaksi untuk mengaktifkan layanan</p>
            </div>
            <button @click="$wire.set('showConfirmAdminModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Transaction Info Summary --}}
        @if($selectedTransaction)
        <div class="bg-success/10 rounded-lg p-4 mb-6 border border-success/20">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold text-success">Subdomain berhasil disimpan!</span>
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
                    <span class="font-medium text-base-content/70">Produk:</span>
                    <p class="font-semibold">{{ $selectedTransaction->product->name_product }}</p>
                </div>
                <div>
                    <span class="font-medium text-base-content/70">Total:</span>
                    <p class="font-bold text-success">Rp {{ number_format($selectedTransaction->total_payment, 0, ',', '.') }}</p>
                </div>
                @if($subdomainWeb)
                <div>
                    <span class="font-medium text-base-content/70">Subdomain Web:</span>
                    <p class="font-mono text-info">{{ $subdomainWeb }}</p>
                </div>
                @endif
                @if($subdomainServer)
                <div>
                    <span class="font-medium text-base-content/70">Subdomain Server:</span>
                    <p class="font-mono text-info">{{ $subdomainServer }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Form Content --}}
        <form wire:submit.prevent="confirmTransaction">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Info Alert --}}
                <div class="col-span-2">
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Langkah 2 dari 2:</strong> Lengkapi informasi akun server yang akan dikirim ke pelanggan. Setelah konfirmasi, transaksi akan aktif dan email akun server akan dikirim otomatis.
                        </div>
                    </div>
                </div>

                {{-- Server Credentials Section --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                        </svg>
                        Informasi Akun Server
                    </h4>
                </div>

                {{-- Username Server --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input wire:model="serverUsername" type="text" placeholder="Username server untuk pelanggan" required />
                    </label>
                    @error('serverUsername')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Server --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input wire:model="serverPassword" type="text" placeholder="Password server untuk pelanggan" required />
                    </label>
                    @error('serverPassword')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Admin Notes Section --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pesan Tambahan (Opsional)
                    </h4>
                    <textarea wire:model="additionalMessage" 
                        placeholder="Tambahkan pesan khusus yang akan dikirim ke pelanggan..." 
                        class="textarea textarea-bordered w-full h-24 resize-none"
                        maxlength="1000"></textarea>
                </div>

                {{-- Confirmation Notice --}}
                <div class="col-span-2">
                    <div class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Konfirmasi akan melakukan:</strong>
                            <ul class="list-disc list-inside mt-2 space-y-1">
                                <li>Mengubah status transaksi menjadi "Aktif"</li>
                                <li>Menetapkan tanggal mulai dan berakhir layanan</li>
                                <li>Mencatat waktu konfirmasi transaksi</li>
                                <li>Mengirim email akun server ke pelanggan secara otomatis</li>
                                <li>Mengaktifkan akses layanan untuk pelanggan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Warning Notice --}}
                <div class="col-span-2">
                    <div class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.083 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Perhatian:</strong> Pastikan semua data sudah benar. Setelah dikonfirmasi, transaksi tidak dapat dibatalkan dan email akun server akan langsung dikirim ke pelanggan.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showConfirmAdminModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:click="confirmTransaction">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span wire:loading.remove>Konfirmasi & Kirim Email</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showConfirmAdminModal', false)">Close</label>
</div>
