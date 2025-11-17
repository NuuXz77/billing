{{-- Keranjang Section --}}
<section id="cart" class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-20 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-500 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        <!-- Logo di kiri atas -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 hover:opacity-80 transition-opacity duration-300">
                <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci" class="h-12 w-auto">
                <span class="font-['Source_Sans_Pro'] text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Hoci</span>
            </a>
        </div>
        
        <h1 class="text-4xl font-bold mb-10 text-gray-900">Keranjang Anda</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Premium Web Hosting Section -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Premium Web Hosting</h2>
                    
                    <!-- Durasi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-3 text-sm">Durasi</label>
                        <div class="flex items-start gap-6">
                            <div class="relative flex-shrink-0" style="width: 200px;">
                                <select class="w-full border border-gray-300 rounded-lg px-4 py-3 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 cursor-pointer">
                                    <option selected>Pilih Durasi</option>
                                    <option>1 Bulan</option>
                                    <option>6 Bulan</option>
                                    <option>12 Bulan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4 ml-auto">
                                <div class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-5 py-2.5 rounded-full font-semibold text-sm shadow-md">
                                    HEMAT RP4.608.000
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-900">Rp23.900<span class="text-lg">/bln</span></div>
                                    <div class="text-sm text-gray-400 line-through">Rp119.900/bln</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Info -->
                    <div class="mb-6 mt-3">
                        <p class="text-sm text-gray-500">Biaya perpanjangan Rp84.900/bln untuk 12 bulan. Bisa dibatalkan kapan saja.</p>
                    </div>

                    <!-- Free Domain Notice -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-4 rounded-lg">
                        <p class="text-gray-700 text-sm">
                            Selamat! Anda dapat domain <span class="font-semibold">GRATIS</span> dan 
                            <span class="font-semibold">3 bulan GRATIS</span> di paket ini. 
                            <span class="inline-flex items-center ml-1 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                    <path d="M12 16v-4M12 8h.01" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-fit sticky top-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800 pb-4 border-b border-gray-100">Daftar pesanan</h2>
                    
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-5 text-base">Premium Web Hosting</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 text-sm">Paket 48 bulan</span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs">Rp5.755.200</span>
                                        <span class="font-bold text-gray-900 ml-2">Rp1.147.200</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 text-sm">Gratis 3 Bulan</span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs">Rp359.700</span>
                                        <span class="font-bold text-gray-900 ml-2">Rp0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 text-sm inline-flex items-center">
                                    Nama Domain
                                    <span class="inline-flex items-center ml-1.5 cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                            <path d="M12 16v-4M12 8h.01" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </span>
                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-400 line-through text-xs">Rp259.900</span>
                                        <span class="font-bold text-gray-900 ml-2">Rp0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 text-sm">Proteksi Privasi Domain WHOIS</span>
                                <span class="font-bold text-gray-900">Rp0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Section -->
                    <div class="border-t border-gray-100 pt-5 mb-5">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-gray-600 text-sm">Pajak</span>
                            <span class="text-gray-600 font-medium">-</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">(Dihitung setelah informasi penagihan)</p>
                    </div>

                    <!-- Subtotal -->
                    <div class="border-t border-gray-100 pt-5 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800">Subtotal</span>
                            <div class="text-right">
                                <div>
                                    <span class="text-gray-400 line-through text-sm">Rp6.367.800</span>
                                    <span class="text-2xl font-bold text-gray-900 ml-2">Rp1.147.200</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('pricing') }}" class="flex-1 bg-transparent border-2 border-gray-900 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300 flex items-center justify-center min-h-[44px]">
                            Kembali
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl transition duration-200 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 flex items-center justify-center">
                            Lanjutkan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
