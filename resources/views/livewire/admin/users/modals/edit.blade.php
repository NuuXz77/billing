{{-- Edit User Modal --}}
<input type="checkbox" wire:model="showEditModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-3xl max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-base-300">
            <div>
                <h3 class="text-xl font-bold">Edit User</h3>
                <p class="text-sm text-neutral mt-1">Update informasi user di bawah ini</p>
            </div>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit="updateUser">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                {{-- Informasi Dasar --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4">Informasi Dasar</h4>
                </div>

                {{-- Full Name --}}
                <div class="form-control">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input wire:model="full_name" type="text" placeholder="Masukkan nama lengkap" required />
                    </label>
                    <div class="validator-hint hidden">Nama lengkap wajib diisi!</div>
                    @error('full_name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

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
                    @error('username') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

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
                    @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="form-control col-span-2">
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                            <path d="M7 11V7a5 5 0 0110 0v4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                        </svg>
                        <input wire:model="password" type="password" placeholder="Password baru (kosongkan jika tidak diubah)" />
                    </label>
                    <div class="validator-hint hidden">Kosongkan jika tidak ingin mengubah password</div>
                    @error('password') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Role & Status Section --}}
                <div class="col-span-2">
                    <h4 class="text-lg font-semibold mb-4 mt-6">Pengaturan Akun</h4>
                </div>

                {{-- Role --}}
                <div class="form-control">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">Role *</span>
                        </div>
                        <select wire:model="role" class="select select-bordered w-full @error('role') select-error @enderror">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </label>
                    @error('role') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div class="form-control">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">Status *</span>
                        </div>
                        <select wire:model="status" class="select select-bordered w-full @error('status') select-error @enderror">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </label>
                    @error('status') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
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
                <button type="submit" class="btn btn-warning" wire:loading.attr="disabled" wire:target="updateUser">
                    <span wire:loading.remove wire:target="updateUser" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Update User
                    </span>
                    <span wire:loading wire:target="updateUser" class="flex items-center gap-2">
                        <span class="loading loading-spinner loading-sm"></span>
                        Memperbarui...
                    </span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
