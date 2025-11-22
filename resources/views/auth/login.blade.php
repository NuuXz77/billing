<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Masuk ke Akun Anda</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 h-full overflow-hidden" x-data="loginHandler()">
    
    {{-- Include Modal Notification --}}
    @include('auth.partials.modallogin')
    
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>

    <div class="container mx-auto px-6 h-full flex items-center justify-center relative z-10">
        <div class="w-full max-w-sm">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Selamat Datang!👋</h1>
                    <p class="text-gray-500 text-xs">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <!-- Login Form -->
                <form @submit.prevent="handleLogin" class="space-y-4">
                    @csrf
                    
                    <!-- Email Input -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="email">
                            Email / Username
                        </label>
                        <input 
                            type="text" 
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('email') border-red-500 @enderror"
                            placeholder="Email atau Username"
                            autofocus
                            required
                        >
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="password">
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200 @error('password') border-red-500 @enderror"
                            placeholder="********"
                            required
                        >
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-xs text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-xs text-blue-600 hover:text-blue-700 font-medium hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 text-sm">
                        Masuk
                    </button>
                </form>

                <!-- Register Link -->
                <div class="text-center mt-6">
                    <p class="text-gray-600 text-xs">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium hover:underline">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="text-center mt-6">
                <p class="text-gray-500 text-xs">
                    &copy; 2024 Hoci. Hosting Ciamis dari Kota Ciamis Jawa Barat
                </p>
            </div>
        </div>
    </div>
</body>
</html>
                        <span class="px-3 bg-white text-gray-500">Atau lanjut dan dafar dengan</span>
                    </div>
                </div> -->

                <!-- Google Login Button
                <button 
                    type="button"
                    class="w-full bg-transparent border-2 border-gray-900 text-gray-900 py-2.5 px-4 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </button>
                -->

                <!-- Register Link -->
                <div class="text-center mt-4">
                    <p class="text-xs text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="text-center mt-4">
                <p class="text-xs text-gray-500">
                    Dengan masuk, Anda menyetujui 
                    <a href="{{ route('terms-and-conditions') }}" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> 
                    dan 
                    <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Kebijakan Privasi</a> kami
                </p>
            </div>
        </div>
    </div>
    
    @livewireScripts
    
    {{-- Alpine.js Login Handler --}}
    <script>
        function loginHandler() {
            return {
                showModal: false,
                modalType: '',
                modalMessage: '',
                validationErrors: [],
                
                handleLogin(event) {
                    const form = event.target;
                    const formData = new FormData(form);
                    
                    // Reset modal
                    this.showModal = false;
                    this.validationErrors = [];
                    
                    // Ensure CSRF token in FormData (dari hidden input @csrf)
                    if (!formData.has('_token')) {
                        const csrfInput = form.querySelector('input[name="_token"]');
                        if (csrfInput) {
                            formData.append('_token', csrfInput.value);
                        }
                    }
                    
                    // Add flag untuk force JSON response
                    formData.append('ajax', '1');
                    
                    // Send AJAX request
                    fetch('{{ route("login.ajax") }}', {
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
                        // Check if response is JSON
                        const contentType = response.headers.get("content-type");
                        
                        console.log('Response status:', response.status);
                        console.log('Content-Type:', contentType);
                        
                        if (!contentType || !contentType.includes("application/json")) {
                            // Not JSON - probably HTML error page
                            const htmlText = await response.text();
                            console.error('HTML Response:', htmlText.substring(0, 500));
                            
                            if (response.status === 419) {
                                throw new Error('CSRF token expired. Refresh halaman dan coba lagi.');
                            }
                            throw new Error('Server error. Periksa koneksi Anda.');
                        }
                        
                        const data = await response.json();
                        
                        if (!response.ok) {
                            // HTTP error status (401, 422, etc)
                            return { success: false, message: data.message || 'Login gagal!', errors: data.errors || {} };
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
                            
                            // Auto close after 5 seconds
                            setTimeout(() => {
                                this.showModal = false;
                            }, 5000);
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
