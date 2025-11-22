{{-- Modal Send Akun Server --}}
<input type="checkbox" wire:model="showSendAccountModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-2xl">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-primary">Kirim Akun Server</h3>
            <button @click="$wire.set('showSendAccountModal', false)" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit.prevent="sendAccountEmail">
            {{-- Modal Body --}}
            <div class="bg-base-100 px-6 py-4 space-y-6">

                {{-- Transaction Info Summary --}}
                @if ($selectedTransaction)
                    <div class="bg-base-200 rounded-lg p-4 mb-6">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-base-content/70">Kode Transaksi:</span>
                                <p class="font-mono font-bold">{{ $selectedTransaction->transaction_code }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-base-content/70">Pelanggan:</span>
                                <p class="font-semibold">{{ $selectedTransaction->user->name }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-base-content/70">Email:</span>
                                <p class="font-semibold">{{ $selectedTransaction->user->email }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-base-content/70">Produk:</span>
                                <p class="font-semibold">{{ $selectedTransaction->product->name_product }}</p>
                            </div>
                        </div>
                    </div>
                @endif {{-- Server Information Form --}}
                <div class="space-y-4">
                    <h4 class="font-semibold text-base-content flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                        </svg>
                        Informasi Server & Login
                    </h4>

                    {{-- Subdomain Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5.25-5.25-12-5.25-12 0s6.75 5.25 12 0" />
                                    </svg>
                                    Subdomain Web (Tampilan)
                                </span>
                            </label>
                            <input type="text" wire:model="subdomainWeb"
                                class="input input-bordered w-full @error('subdomainWeb') input-error @enderror"
                                placeholder="contoh.domain.com" readonly>
                            @error('subdomainWeb')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                    </svg>
                                    Subdomain Server
                                </span>
                            </label>
                            <input type="text" wire:model="subdomainServer"
                                class="input input-bordered w-full @error('subdomainServer') input-error @enderror"
                                placeholder="server.domain.com" readonly>
                            @error('subdomainServer')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    {{-- Login Credentials --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Username Server
                                </span>
                            </label>
                            <input type="text" wire:model="serverUsername"
                                class="input input-bordered w-full @error('serverUsername') input-error @enderror"
                                placeholder="username_server">
                            @error('serverUsername')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a3 3 0 11-6 0 3 3 0 016 0zM2.003 11.83a1.001 1.001 0 000-1.66C3.11 8.637 6.778 6 12 6c5.222 0 8.89 2.637 9.997 4.17a1.001 1.001 0 000 1.66C20.89 13.363 17.222 16 12 16c-5.222 0-8.89-2.637-9.997-4.17z" />
                                    </svg>
                                    Password Server
                                </span>
                            </label>
                            <div class="relative">
                                <input type="password" x-data="{ show: false }" :type="show ? 'text' : 'password'"
                                    wire:model="serverPassword"
                                    class="input input-bordered w-full pr-10 @error('serverPassword') input-error @enderror"
                                    placeholder="password_server">
                                <button type="button" x-data="{ show: false }" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-base-content/50" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-base-content/50" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('serverPassword')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    {{-- Additional Info --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z" />
                                </svg>
                                Pesan Tambahan (Opsional)
                            </span>
                        </label>
                        <textarea wire:model="additionalMessage" class="textarea textarea-bordered h-24"
                            placeholder="Tambahkan pesan khusus untuk pelanggan..."></textarea>
                    </div>
                </div>

                {{-- Email Preview --}}
                <div class="bg-base-200 rounded-lg p-4">
                    <h4 class="font-semibold text-base-content mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview Email
                    </h4>
                    <div class="text-sm text-base-content/70">
                        <p><strong>Kepada:</strong> {{ $selectedTransaction->user->email ?? '' }}</p>
                        <p><strong>Subjek:</strong> Akun Server Anda -
                            {{ $selectedTransaction->transaction_code ?? '' }}</p>
                        <p><strong>Konten:</strong> Informasi akses server, subdomain, dan credentials login</p>
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="bg-base-100 px-6 py-4 border-t border-base-300 flex items-center justify-end gap-3">
                <button type="button" @click="$wire.showSendAccountModal = false" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span wire:loading.remove>Kirim Email</span>
                    <span wire:loading class="loading loading-spinner loading-sm mr-2"></span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>
