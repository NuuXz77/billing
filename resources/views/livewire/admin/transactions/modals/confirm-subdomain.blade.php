{{-- Confirm Subdomain Modal --}}
<input type="checkbox" wire:model="showConfirmSubdomainModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold">Konfirmasi Subdomain</h3>
                <p class="text-sm text-neutral mt-1">Isi data subdomain untuk melanjutkan proses konfirmasi</p>
            </div>
            <button @click="$wire.set('showConfirmSubdomainModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Transaction Info Summary --}}
        @if($selectedTransaction)
        <div class="bg-base-200 rounded-lg p-4 mb-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
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
                    <p class="font-bold text-primary">Rp {{ number_format($selectedTransaction->total_payment, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Form Content --}}
        <form wire:submit.prevent="saveSubdomain">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Info Alert --}}
                <div class="col-span-2">
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Langkah 1 dari 2:</strong> Silakan isi data subdomain yang akan digunakan pelanggan. Data ini wajib diisi sebelum melanjutkan proses konfirmasi.
                        </div>
                    </div>
                </div>

                {{-- Subdomain Web Input --}}
                <div class="form-control">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5.25-5.25-12-5.25-12 0s6.75 5.25 12 0" />
                        </svg>
                        Subdomain Web
                    </h4>
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5.25-5.25-12-5.25-12 0s6.75 5.25 12 0"/>
                        </svg>
                        <input wire:model="subdomainWeb" type="text" placeholder="contoh: myclient.hosting.com" required />
                    </label>
                    @error('subdomainWeb') 
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Subdomain Server Input --}}
                <div class="form-control">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                        </svg>
                        Subdomain Server
                    </h4>
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                        <input wire:model="subdomainServer" type="text" placeholder="contoh: server01.datacenter.com" required />
                    </label>
                    @error('subdomainServer') 
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Warning Notice --}}
                <div class="col-span-2">
                    <div class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.083 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <div class="text-sm">
                            <strong>Perhatian:</strong> 
                            <ul class="list-disc list-inside mt-2 space-y-1">
                                <li>Pastikan subdomain yang diinputkan sudah tersedia dan valid</li>
                                <li>Data ini akan terlihat oleh pelanggan setelah transaksi dikonfirmasi</li>
                                <li>Setelah menyimpan, Anda akan lanjut ke tahap konfirmasi akhir</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showConfirmSubdomainModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <span wire:loading.remove>Simpan & Lanjutkan</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showConfirmSubdomainModal', false)">Close</label>
</div>