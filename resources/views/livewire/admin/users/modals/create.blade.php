{{-- Create User Modal --}}
<input type="checkbox" wire:model="showCreateModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-3xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold d">Tambah User Baru</h3>
                <p class="text-sm text-neutral mt-1">Isi informasi user baru di bawah ini</p>
            </div>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit="createUser">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                {{-- Informasi Dasar --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold d mb-4">Informasi Dasar</h4>
                </div>

                {{-- Full Name --}}
                <div class="form-control">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input wire:model="full_name" type="text" placeholder="Masukkan nama lengkap" required />
                    </label>
                    <div class="validator-hint hidden">Nama lengkap wajin diisi!</div>
                </div>
                {{-- <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Nama Lengkap *</span>
                    </label>
                    <input type="text" wire:model="full_name"
                        class="input input-bordered w-full @error('full_name') input-error @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('full_name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div> --}}

                {{-- Username --}}
                <div class="form-control">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                            <path d="M12 1v6m0 6v6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                            <path d="m21 12-6 0m-6 0-6 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                        </svg>
                        <input wire:model="username" type="text" placeholder="Masukkan username" required />
                    </label>
                    <div class="validator-hint hidden">Username wajib diisi!</div>
                </div>
                {{-- <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Username *</span>
                    </label>
                    <input type="text" wire:model="username"
                        class="input input-bordered w-full @error('username') input-error @enderror"
                        placeholder="Masukkan username">
                    @error('username')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div> --}}

                {{-- Email --}}
                <div class="form-control col-span-2 md:col-span-2">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect width="20" height="16" x="2" y="4" rx="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                        </svg>
                        <input wire:model="email" type="email" placeholder="Masukkan email" required />
                    </label>
                    <div class="validator-hint hidden">Email tidak valid!</div>
                </div>
                {{-- <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text font-medium">Email *</span>
                    </label>
                    <input type="email" wire:model="email"
                        class="input input-bordered w-full @error('email') input-error @enderror"
                        placeholder="Masukkan alamat email">
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div> --}}

                {{-- Password --}}
                <div class="form-control col-span-2">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                            <path d="M7 11V7a5 5 0 0110 0v4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                        </svg>
                        <input wire:model="password" type="password" minlength="6" placeholder="Buat Password" required
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                            title="Must be more than 6 characters, including number, lowercase letter, uppercase letter" />
                    </label>
                    <div class="validator-hint hidden">
                        Wajib 6 karater atau lebih, termasuk:
                        <br />Terdapat angka
                        <br />Terdapat huruf kecil
                        <br />Terdapat huruf besar
                        </p>
                    </div>
                </div>

                {{-- <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Password *</span>
                    </label>
                    <input type="password" wire:model="password"
                        class="input input-bordered w-full @error('password') input-error @enderror"
                        placeholder="Buat password">
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div> --}}

                {{-- Auto Generate Password --}}
                <div class="form-control col-span-2">
                    <div class="flex gap-2">
                        <button type="button" wire:click="generatePassword" 
                                class="btn btn-outline btn-neutral flex-1 flex items-center gap-2"
                                wire:loading.attr="disabled"
                                wire:target="generatePassword">
                            <span wire:loading.remove wire:target="generatePassword" class="flex items-center gap-2">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <circle cx="12" cy="16" r="1" fill="currentColor"/>
                                </svg>
                                Generate Password
                            </span>
                            <span wire:loading wire:target="generatePassword" class="flex items-center gap-2">
                                <span class="loading loading-spinner loading-sm"></span>
                                Generating...
                            </span>
                        </button>
                        @if(!empty($password))
                            <button type="button" onclick="copyToClipboard('{{ $password }}')" 
                                    class="btn btn-outline btn-info flex items-center gap-2">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                                Copy
                            </button>
                        @endif
                    </div>
                    @if(!empty($password))
                        <div class="mt-2 p-2 bg-base-300 rounded text-sm font-mono text-center">
                            Generated: <span class="text-success font-bold">{{ $password }}</span>
                        </div>
                    @endif
                    <div class="text-sm text-gray-600 mt-2">
                        <span class="flex items-center gap-1">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                            Klik untuk generate password otomatis (12 karakter, aman)
                        </span>
                    </div>
                </div>

                <script>
                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(function() {
                        // Show success notification
                        const toast = document.createElement('div');
                        toast.className = 'alert alert-success fixed top-4 right-4 w-auto z-50';
                        toast.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Password copied to clipboard!</span>
                        `;
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 3000);
                    });
                }
                </script>

                {{-- Informasi Akun --}}
                <div class="col-span-2 mt-4">
                    <h4 class="text-lg font-semibold d mb-4">Informasi Akun</h4>
                </div>

                {{-- Role --}}
                <div class="form-control">
                    <select class="select validator w-full" wire:model="role" required>
                        <option disabled selected value="">Choose:</option>
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                    </select>
                    <p class="validator-hint">Role Perlu Di isi!</p>
                    {{-- <label class="label">
                        <span class="label-text font-medium">Role *</span>
                    </label>
                    <select wire:model="role"
                        class="select select-bordered w-full @error('role') select-error @enderror">
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror --}}
                </div>

                {{-- Status --}}
                <div class="form-control w-full">
                    <select class="select validator w-full" wire:model="status" required>
                        <option disabled selected value="">Choose:</option>
                        <option value="active">Active</option>
                        <option value="inactive">inactive</option>
                    </select>
                    <p class="validator-hint">Status Perlu Di Isi</p>
                    {{-- 
                    <label class="label">
                        <span class="label-text font-medium">Status *</span>
                    </label>
                    <select wire:model="status"
                        class="select select-bordered w-full @error('status') select-error @enderror">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                    @error('status')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror --}}
                </div>

                {{-- NOTE: Contact info and foto_profile fields removed because they are nullable in migration. --}}
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action mt-8 pt-6 border-t border-base-300">
                <button type="button" wire:click="closeModal"
                    class="btn btn-outline btn-neutral">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="createUser">
                    <span wire:loading.remove wire:target="createUser" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan User
                    </span>
                    <span wire:loading wire:target="createUser" class="flex items-center gap-2">
                        <span class="loading loading-spinner loading-sm"></span>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- Modal Backdrop --}}
    <label class="modal-backdrop" wire:click="closeModal">Close</label>
</div>
