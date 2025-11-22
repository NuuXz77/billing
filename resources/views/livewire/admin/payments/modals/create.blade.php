{{-- Create Payment Modal --}}
<input type="checkbox" wire:model="showCreateModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-3xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold">Tambah Metode Pembayaran</h3>
                <p class="text-sm text-neutral mt-1">Isi informasi metode pembayaran baru</p>
            </div>
            <button @click="$wire.set('showCreateModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit="createPayment">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Informasi Dasar --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Dasar
                    </h4>
                </div>

                {{-- Payment Code --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                        <input wire:model="payment_code" type="text" placeholder="Kode pembayaran (ex: PAY-001)" disabled />
                    </label>
                    @error('payment_code')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Payment Method --}}
                <div class="form-control">
                    <select wire:model="payment_method" class="select w-full">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Virtual Account">Virtual Account</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Crypto">Cryptocurrency</option>
                    </select>
                    @error('payment_method')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Payment Bank --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <input wire:model="payment_bank" type="text" placeholder="Nama bank/provider" required />
                    </label>
                    @error('payment_bank')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Account Name --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input wire:model="payment_account_name" type="text" placeholder="Nama pemilik akun" required />
                    </label>
                    @error('payment_account_name')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Account Number --}}
                <div class="form-control col-span-2">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <input wire:model="payment_account_number" type="text" placeholder="Nomor rekening/akun" required />
                    </label>
                    @error('payment_account_number')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4">Status</h4>
                    <div class="flex gap-4">
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="radio" wire:model="status" value="active" class="radio radio-primary" />
                                <span class="label-text font-medium text-success">Aktif</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="radio" wire:model="status" value="inactive" class="radio radio-error" />
                                <span class="label-text font-medium text-error">Tidak Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action pt-6 border-t border-base-300">
                <button type="button" @click="$wire.set('showCreateModal', false)" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span wire:loading.remove>Simpan Metode</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showCreateModal', false)">Close</label>
</div>