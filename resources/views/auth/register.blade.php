<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Buat Akun Baru</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 h-full overflow-hidden" x-data="registerHandler()">
    
    {{-- Include Modal Notification --}}
    @include('auth.partials.modalregister')
    
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>

    <div class="container mx-auto px-6 h-full flex items-center justify-center relative z-10">
        <div class="w-full max-w-2xl">
            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Daftar Akun! 🚀</h1>
                    <p class="text-gray-500 text-xs">Buat akun baru untuk memulai</p>
                </div>

                <!-- Register Form -->
                <form @submit.prevent="handleRegister" class="space-y-4">
                    @csrf
                    
                    <!-- Grid Layout 2x3 untuk semua fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="full_name">
                                Nama Lengkap *
                            </label>
                            <input 
                                type="text" 
                                id="full_name"
                                name="full_name"
                                value="{{ old('full_name') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('full_name') border-red-500 @enderror"
                                placeholder="John Doe"
                                required
                            >
                            @error('full_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="username">
                                Username *
                            </label>
                            <input 
                                type="text" 
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('username') border-red-500 @enderror"
                                placeholder="johndoe"
                                required
                            >
                            <p class="text-xs text-gray-500 mt-1">Username untuk subdomain hosting</p>
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="email">
                                Email *
                            </label>
                            <input 
                                type="email" 
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('email') border-red-500 @enderror"
                                placeholder="example@example.com"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="phone">
                                No. Telepon *
                            </label>
                            <input 
                                type="text" 
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('phone') border-red-500 @enderror"
                                placeholder="08123456789"
                                required
                            >
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="password">
                                Password *
                            </label>
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="********"
                                required
                            >
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="password_confirmation">
                                Konfirmasi Password *
                            </label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200"
                                placeholder="********"
                                required
                            >
                        </div>
                    </div>

                    <!-- Address (Optional) -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="address">
                            Alamat (Opsional)
                        </label>
                        <textarea 
                            id="address"
                            name="address"
                            rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('address') border-red-500 @enderror"
                            placeholder="Alamat lengkap...">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" name="terms" id="terms" class="w-3.5 h-3.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-0.5" required>
                        <label for="terms" class="ml-2 text-xs text-gray-600">
                            Saya setuju dengan 
                            <a href="{{ route('terms-and-conditions') }}" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> 
                            dan 
                            <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 text-sm">
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-xs text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    @livewireScripts
    
    {{-- Alpine.js Register Handler --}}
    <script>
        function registerHandler() {
            return {
                showModal: false,
                modalType: '',
                modalMessage: '',
                validationErrors: [],
                
                handleRegister(event) {
                    const form = event.target;
                    const formData = new FormData(form);
                    
                    // Reset modal
                    this.showModal = false;
                    this.validationErrors = [];
                    
                    // Ensure CSRF token
                    if (!formData.has('_token')) {
                        const csrfInput = form.querySelector('input[name="_token"]');
                        if (csrfInput) {
                            formData.append('_token', csrfInput.value);
                        }
                    }
                    
                    // Send AJAX request
                    fetch('{{ route("register.ajax") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        credentials: 'same-origin'
                    })
                    .then(async response => {
                        const contentType = response.headers.get("content-type");
                        
                        if (!contentType || !contentType.includes("application/json")) {
                            throw new Error('Server error. Periksa koneksi Anda.');
                        }
                        
                        const data = await response.json();
                        
                        if (!response.ok) {
                            return { success: false, message: data.message || 'Registrasi gagal!', errors: data.errors || {} };
                        }
                        
                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            // Success
                            this.modalType = 'success';
                            this.modalMessage = data.message;
                            this.showModal = true;
                            
                            // Redirect after 2 seconds
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        } else {
                            // Error
                            this.modalType = 'error';
                            this.modalMessage = data.message;
                            this.validationErrors = data.errors ? Object.values(data.errors).flat() : [];
                            this.showModal = true;
                            
                            // Auto close after 7 seconds
                            setTimeout(() => {
                                this.showModal = false;
                            }, 7000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.modalType = 'error';
                        this.modalMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        this.showModal = true;
                    });
                }
            }
        }
    </script>
</body>
</html>
