{{-- Create User Modal --}}
<input type="checkbox" wire:model="showCreateModal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box max-w-4xl max-h-[90vh] overflow-y-auto">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold d">Tambah User Baru</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Isi informasi user baru di bawah ini</p>
            </div>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form wire:submit="createUser">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                {{-- Informasi Dasar --}}
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold d mb-4">Informasi Dasar</h4>
                </div>

                {{-- Full Name --}}
                <div class="form-control">
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
                </div>

                {{-- Username --}}
                <div class="form-control">
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
                </div>

                {{-- Email --}}
                <div class="form-control md:col-span-2">
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
                </div>

                {{-- Password --}}
                <div class="form-control">
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
                </div>

                {{-- Password Confirmation --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Konfirmasi Password *</span>
                    </label>
                    <input type="password" wire:model="password_confirmation" 
                           class="input input-bordered w-full"
                           placeholder="Konfirmasi password">
                </div>

                {{-- Informasi Akun --}}
                <div class="md:col-span-2 mt-4">
                    <h4 class="text-lg font-semibold d mb-4">Informasi Akun</h4>
                </div>

                {{-- Role --}}
                <div class="form-control">
                    <label class="label">
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
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-control">
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
                    @enderror
                </div>

                {{-- Informasi Kontak --}}
                <div class="md:col-span-2 mt-4">
                    <h4 class="text-lg font-semibold d mb-4">Informasi Kontak</h4>
                </div>

                {{-- Phone --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">No. Telepon</span>
                    </label>
                    <input type="text" wire:model="phone" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan nomor telepon">
                </div>

                {{-- Company Name --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Nama Perusahaan</span>
                    </label>
                    <input type="text" wire:model="company_name" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan nama perusahaan">
                </div>

                {{-- District --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Kecamatan</span>
                    </label>
                    <input type="text" wire:model="district" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan kecamatan">
                </div>

                {{-- City --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Kota</span>
                    </label>
                    <input type="text" wire:model="city" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan kota">
                </div>

                {{-- Province --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Provinsi</span>
                    </label>
                    <input type="text" wire:model="province" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan provinsi">
                </div>

                {{-- Pos Code --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Kode Pos</span>
                    </label>
                    <input type="text" wire:model="pos_code" 
                           class="input input-bordered w-full"
                           placeholder="Masukkan kode pos">
                </div>

                {{-- Address --}}
                <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text font-medium">Alamat Lengkap</span>
                    </label>
                    <textarea wire:model="address" 
                              class="textarea textarea-bordered w-full"
                              rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                {{-- Foto Profile --}}
                <div class="md:col-span-2 mt-4">
                    <h4 class="text-lg font-semibold d mb-4">Foto Profile</h4>
                </div>

                <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text font-medium">Upload Foto Profile</span>
                    </label>
                    <input type="file" wire:model="foto_profile" 
                           class="file-input file-input-bordered w-full"
                           accept="image/*">
                    @error('foto_profile') 
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                    
                    {{-- Image Preview --}}
                    @if ($foto_profile)
                        <div class="mt-4 flex flex-col items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                            <div class="avatar">
                                <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                    <img src="{{ $foto_profile->temporaryUrl() }}" alt="Preview" class="object-cover">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Modal Actions --}}
            <div class="modal-action mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="button" wire:click="closeModal" 
                        class="btn btn-ghost border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit" 
                        class="btn btn-primary text-white bg-blue-600 hover:bg-blue-700 border-0"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan User
                    </span>
                    <span wire:loading class="flex items-center gap-2">
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