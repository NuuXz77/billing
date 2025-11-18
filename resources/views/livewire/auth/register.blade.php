<div class="min-h-screen flex items-center justify-center bg-base-200 py-12 px-4">
    <div class="card w-full max-w-2xl bg-base-100 shadow-xl">
        <div class="card-body">
            {{-- Header --}}
            <h2 class="card-title text-2xl font-bold text-center mb-2">Buat Akun</h2>
            <p class="text-center text-base-content/60 mb-6">Daftar untuk mulai menggunakan layanan kami</p>

            {{-- Error Message --}}
            @if (session()->has('error'))
                <div class="alert alert-error mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form wire:submit="register">
                <div class="grid grid-cols-12 gap-4">
                    {{-- full name + username --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 col-span-12">
                        {{-- Full Name --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Nama Lengkap</span>
                            </label>
                            <input type="text" wire:model.debounce.500ms="full_name"
                                placeholder="Masukkan nama lengkap"
                                class="input input-bordered w-full @error('full_name') input-error @enderror" autofocus>
                            @error('full_name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>
                            <input type="text" wire:model.debounce.500ms="username"
                                placeholder="Masukkan Username"
                                class="input input-bordered w-full @error('username') input-error @enderror" autofocus>
                            @error('username')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                    </div>
                    {{-- email --}}
                    <div class="col-span-12">
                        {{-- Email --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" wire:model.debounce.500ms="email" placeholder="nama@email.com"
                                class="input input-bordered w-full @error('email') input-error @enderror">
                            @error('email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    {{-- alamat --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 col-span-12">
                        {{-- Kecamatan --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Kecamatan</span>
                            </label>
                            <input type="input" wire:model.debounce.500ms="district" placeholder="Kecamatan"
                                class="input input-bordered w-full @error('district') input-error @enderror">
                            @error('district')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        {{-- kota --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Kota</span>
                            </label>
                            <input type="input" wire:model.debounce.500ms="city" placeholder="Kota"
                                class="input input-bordered w-full @error('city') input-error @enderror">
                            @error('city')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        {{-- provinsi --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Provinsi</span>
                            </label>
                            <input type="input" wire:model.debounce.500ms="province" placeholder="Provinsi"
                                class="input input-bordered w-full @error('province') input-error @enderror">
                            @error('province')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    {{-- alamat --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 col-span-12">
                       {{-- kode pos --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Kode Pos</span>
                            </label>
                            <input type="text" wire:model.debounce.500ms="pos_code" placeholder="Kode Pos"
                                class="input input-bordered w-full @error('pos_code') input-error @enderror">
                            @error('pos_code')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        
                        {{-- Perusahaan --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Nama Perusahaan</span>
                            </label>
                            <input type="input" wire:model.debounce.500ms="company_name" placeholder="Nama Perusahaan (Opsional)"
                                class="input input-bordered w-full @error('company_name') input-error @enderror">
                            @error('company_name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    {{-- alamat --}}
                    <div class="col-span-12">
                        {{-- Alamat --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Alamat</span>
                            </label>
                            
                            <textarea wire:model.debounce.500ms="address" placeholder="Alamat Lengkap"
                                class="textarea textarea-bordered w-full @error('address') input-error @enderror" rows="3"></textarea>
                            @error('address')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>


                {{-- Password --}}
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Kata Sandi</span>
                    </label>
                    <input type="password" wire:model.debounce.500ms="password" placeholder="••••••••"
                        class="input input-bordered w-full @error('password') input-error @enderror">
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                    <label class="label">
                        <span class="label-text-alt text-base-content/60">Minimal 8 karakter, kombinasi huruf besar,
                            kecil, dan angka</span>
                    </label>
                </div>

                {{-- Confirm Password --}}
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Konfirmasi Kata Sandi</span>
                    </label>
                    <input type="password" wire:model.debounce.500ms="password_confirmation" placeholder="••••••••"
                        class="input input-bordered w-full">
                </div>

                {{-- Terms --}}
                <div class="form-control mb-6">
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="checkbox" required class="checkbox checkbox-primary checkbox-sm">
                        <span class="label-text text-sm">
                            Saya setuju dengan <a href="#" class="link link-primary">Syarat & Ketentuan</a> dan <a
                                href="#" class="link link-primary">Kebijakan Privasi</a>
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="form-control mb-4">
                    <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove>Daftar</span>
                        <span wire:loading class="loading loading-spinner loading-sm"></span>
                        <span wire:loading>Mendaftar...</span>
                    </button>
                </div>
            </form>

            {{-- Login Link --}}
            <div class="text-center mt-6">
                <p class="text-sm text-base-content/60">
                    Sudah punya akun?
                    <a href="/login" wire:navigate class="link link-primary font-semibold">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
