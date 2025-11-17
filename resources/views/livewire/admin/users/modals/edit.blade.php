{{-- Edit User Modal --}}
<input type="checkbox" wire:model="showEditModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl">
        <h3 class="text-lg font-bold mb-4">Edit User</h3>
        
        <form wire:submit="updateUser">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Full Name --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Nama Lengkap *</span></label>
                    <input type="text" wire:model="full_name" class="input input-bordered @error('full_name') input-error @enderror">
                    @error('full_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Username --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Username *</span></label>
                    <input type="text" wire:model="username" class="input input-bordered @error('username') input-error @enderror">
                    @error('username') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="form-control md:col-span-2">
                    <label class="label"><span class="label-text">Email *</span></label>
                    <input type="email" wire:model="email" class="input input-bordered @error('email') input-error @enderror">
                    @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Password Baru (Kosongkan jika tidak diubah)</span></label>
                    <input type="password" wire:model="password" class="input input-bordered @error('password') input-error @enderror">
                    @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Password Confirmation --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Konfirmasi Password</span></label>
                    <input type="password" wire:model="password_confirmation" class="input input-bordered">
                </div>

                {{-- Role --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Role *</span></label>
                    <select wire:model="role" class="select select-bordered @error('role') select-error @enderror">
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Status *</span></label>
                    <select wire:model="status" class="select select-bordered @error('status') select-error @enderror">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                    @error('status') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Phone --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">No. Telepon</span></label>
                    <input type="text" wire:model="phone" class="input input-bordered">
                </div>

                {{-- Company Name --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Nama Perusahaan</span></label>
                    <input type="text" wire:model="company_name" class="input input-bordered">
                </div>

                {{-- District --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Kecamatan</span></label>
                    <input type="text" wire:model="district" class="input input-bordered">
                </div>

                {{-- City --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Kota</span></label>
                    <input type="text" wire:model="city" class="input input-bordered">
                </div>

                {{-- Province --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Provinsi</span></label>
                    <input type="text" wire:model="province" class="input input-bordered">
                </div>

                {{-- Pos Code --}}
                <div class="form-control">
                    <label class="label"><span class="label-text">Kode Pos</span></label>
                    <input type="text" wire:model="pos_code" class="input input-bordered">
                </div>

                {{-- Address --}}
                <div class="form-control md:col-span-2">
                    <label class="label"><span class="label-text">Alamat Lengkap</span></label>
                    <textarea wire:model="address" class="textarea textarea-bordered" rows="3"></textarea>
                </div>

                {{-- Foto Profile --}}
                <div class="form-control md:col-span-2">
                    <label class="label"><span class="label-text">Foto Profile</span></label>
                    @if ($currentFotoProfile)
                        <div class="mb-2">
                            <p class="text-sm text-base-content/60">Foto saat ini:</p>
                            <img src="{{ Storage::url($currentFotoProfile) }}" class="w-20 h-20 rounded-full object-cover">
                        </div>
                    @endif
                    <input type="file" wire:model="foto_profile" class="file-input file-input-bordered w-full" accept="image/*">
                    @error('foto_profile') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    @if ($foto_profile)
                        <div class="mt-2">
                            <p class="text-sm text-base-content/60">Preview foto baru:</p>
                            <img src="{{ $foto_profile->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover">
                        </div>
                    @endif
                </div>
            </div>

            <div class="modal-action">
                <button type="button" wire:click="closeModal" class="btn">Batal</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Perbarui</span>
                    <span wire:loading class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
    <label class="modal-backdrop" wire:click="closeModal"></label>
</div>
