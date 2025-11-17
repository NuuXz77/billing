<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Masuk ke Akun Anda</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('img/logo/Hoci_Logo.svg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 h-full overflow-hidden">
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
                <form class="space-y-4">
                    <!-- Email Input -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="email">
                            Email
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200"
                            placeholder="example@example.com"
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
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200"
                            placeholder="********"
                            required
                        >
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="w-3.5 h-3.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
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

                <!-- Divider 
                <div class="relative my-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
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
</body>
</html>
