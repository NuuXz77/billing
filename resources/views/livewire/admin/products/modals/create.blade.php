{{-- Create Product Modal --}}
<input type="checkbox" wire:model="showCreateModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold">Tambah Produk Baru</h3>
                <p class="text-sm text-neutral mt-1">Isi informasi produk hosting baru di bawah ini</p>
            </div>
            <button @click="$wire.set('showCreateModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit="createProduct">
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

                {{-- Product Code --}}
                <div class="form-control">
                    <div class="flex gap-2">
                        <label class="input w-full">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                            <input wire:model="product_code" type="text" placeholder="Masukkan kode produk (ex: HST-001)" disabled />
                        </label>
                        {{-- <button type="button" wire:click="generateProductCode" class="btn btn-outline btn-square" title="Generate kode produk baru">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button> --}}
                    </div>
                    @error('product_code')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <input wire:model="name_product" type="text" placeholder="Masukkan nama produk" required />
                    </label>
                    @error('name_product')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Storage --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                        <input wire:model="storage" type="text" placeholder="Masukkan kapasitas storage (ex: 10GB SSD)" required />
                    </label>
                    @error('storage')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price Monthly --}}
                <div class="form-control">
                    <label class="input w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input wire:model="price_monthly" type="number" min="0" step="1000" placeholder="Masukkan harga per bulan" required />
                    </label>
                    @error('price_monthly')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Features Section --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Fitur Produk
                    </h4>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- Domain Included --}}
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="checkbox" wire:model="domain_included" class="checkbox checkbox-primary" />
                                <span class="label-text font-medium">Domain Gratis</span>
                            </label>
                        </div>

                        {{-- SSL Included --}}
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="checkbox" wire:model="ssl_included" class="checkbox checkbox-primary" />
                                <span class="label-text font-medium">SSL Certificate</span>
                            </label>
                        </div>

                        {{-- SSH Access --}}
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="checkbox" wire:model="ssh_access" class="checkbox checkbox-primary" />
                                <span class="label-text font-medium">SSH Access</span>
                            </label>
                        </div>

                        {{-- Email Feature --}}
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="checkbox" wire:model="email_feature" class="checkbox checkbox-primary" />
                                <span class="label-text font-medium">Email Hosting</span>
                            </label>
                        </div>

                        {{-- Database Feature --}}
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="checkbox" wire:model="database_feature" class="checkbox checkbox-primary" />
                                <span class="label-text font-medium">Database MySQL</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4">Deskripsi</h4>
                    <textarea wire:model="description" 
                        class="textarea textarea-bordered w-full h-24" 
                        placeholder="Masukkan deskripsi produk..."></textarea>
                    @error('description')
                        <div class="text-error text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4">Status</h4>
                    <div class="flex gap-4">
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="radio" wire:model="status" value="1" class="radio radio-success" checked />
                                <span class="label-text font-medium text-success">Aktif (Public)</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-3">
                                <input type="radio" wire:model="status" value="0" class="radio radio-error" />
                                <span class="label-text font-medium text-error">Tidak Aktif (Draft)</span>
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
                    <span wire:loading.remove>Simpan Produk</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" @click="$wire.set('showCreateModal', false)">Close</label>
</div>