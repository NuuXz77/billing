<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Buat Akun Baru</title>
    
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
        <div class="w-full max-w-2xl">
            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Daftar Akun! 🚀</h1>
                    <p class="text-gray-500 text-xs">Buat akun baru untuk memulai</p>
                </div>

                <!-- Register Form -->
                <form class="space-y-4">
                    <!-- Grid Layout for Name & Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="name">
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                id="name"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200"
                                placeholder="John Doe"
                                required
                            >
                        </div>

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
                    </div>

                    <!-- Grid Layout for Passwords -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

                        <!-- Confirm Password Input -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1.5 text-xs" for="password_confirmation">
                                Konfirmasi Password
                            </label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 transition-all duration-200"
                                placeholder="********"
                                required
                            >
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" class="w-3.5 h-3.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-0.5" required>
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
</body>
</html>
