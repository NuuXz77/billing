<div class="min-h-screen flex items-center justify-center bg-base-200">
    {{-- Toast Notification --}}
    @if($toastMessage)
        <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            @if($toastType === 'success')
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @else
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $toastMessage }}</span>
                </div>
            @endif
        </div>
    @endif

    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold text-center mb-6">Login</h2>
            
            <form wire:submit="login">
                {{-- Email --}}
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" 
                           wire:model="email" 
                           placeholder="your@email.com" 
                           class="input input-bordered w-full @error('email') input-error @enderror" 
                           autofocus>
                    @error('email') 
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" 
                           wire:model="password" 
                           placeholder="••••••••" 
                           class="input input-bordered w-full @error('password') input-error @enderror">
                    @error('password') 
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="form-control mb-6">
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="checkbox" wire:model="remember" class="checkbox checkbox-primary checkbox-sm">
                        <span class="label-text">Ingat saya</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove>Login</span>
                        <span wire:loading class="loading loading-spinner loading-sm"></span>
                        <span wire:loading>Loading...</span>
                    </button>
                </div>
            </form>

            {{-- Register Link --}}
            <div class="text-center mt-4">
                <p class="text-sm text-base-content/60">
                    Belum punya akun? 
                    <a href="/register" wire:navigate class="link link-primary">Daftar di sini</a>
                </p>
                <p class="text-sm text-base-content/60 mt-2">
                    <a href="/" wire:navigate class="link link-primary">Kembali ke beranda</a>
                </p>
            </div>
        </div>
    </div>
</div>
